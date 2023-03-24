<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Models\Customer;
use App\Models\DuePay;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Models\workOrderDetail;
use Illuminate\Validation\Rule;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class OtEdit extends Component
{
    public WorkOrder $editing;

    public $searchProductService = '';
    public $concepts = [];
    public $products = [];
    public $statuses = [];
    public $types = [];
    public $customers = [];
    public $vehicles = [];

    public $vf = [];
    public $cf = [];
    public $cart = [];
    public $dtw = [];

    public $productNotUpdateStockInEdit = [];

    public $totalCart = 0;
    public $totalOG = 0;
    public $total = 0;
    public $totalDiscount = 0;

    public $total_replacement = 0;
    public $total_service = 0;

    protected $listeners = ['refreshListModals'];

    public function rules()
    {
        return [
            'editing.code' => ['required', 'min:6', 'max:6', Rule::unique('work_orders', 'code')->ignore($this->editing)],
            'editing.odo' => 'required',
            'editing.customer' => 'required',
            'editing.vehicle' => 'required',
            'editing.type_atention' => 'required',
            'editing.observation' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code.min' => 'El código no debe tener menos de 6 chares',
        'editing.code.max' => 'El código no debe tener más de 6 caracteres',
        'editing.code.required' => 'El código es obligatorio',
        'editing.code.unique' => 'Ya existe un proforma con este código',
        'editing.odo.required' => 'El kilometraje es obligatorio',
        'editing.customer.required' => 'El cliente es obligatorio',
        'editing.type_atention.required' => 'El tipo de atención es obligatorio',
        'editing.vehicle.required' => 'El vehiculo es obligatorio',
    ];

    public function mount($code)
    {
        $wo = WorkOrder::where('code', $code)->first();
        $this->editing = $this->makeBlankFields();
        if ($this->editing->isNot($wo)) $this->editing = $wo; // para preservar cambios en los inputs for create
        $this->statuses = WorkOrder::STATUSES;
        $this->types  = WorkOrder::TYPES;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->cf = Customer::find($this->editing->customer);
        $this->vf = Vehicle::find($this->editing->vehicle);
    }

    public function code_random($lenght)
    {
        $countSale = Sale::count();
        $code = str_pad($countSale + 1, $lenght, "0", STR_PAD_LEFT);
        return 'V' . $code;
    }

    public function render()
    {
        if ($this->searchProductService) {
            $this->concepts = Concept::query()->when(
                $this->searchProductService,
                fn ($q, $searchProductService) =>
                $q->where('name', 'like', '%' . $searchProductService . '%')
            )->get();
            $this->products = Product::query()
                ->where('stock', '>', 0)
                ->when(
                    $this->searchProductService,
                    fn ($q, $searchProductService) =>
                    $q->where('name', 'like', '%' . $searchProductService . '%')
                        ->orwhere('code', 'like', '%' . $searchProductService . '%')
                )->get();
        } else {
            $this->concepts = [];
            $this->products = [];
        }

        $this->cart = Cart::session($this->editing->code)->getContent()->sortBy('id');
        if (count($this->cart) == 0) {
            $this->cart = [];
        }
        $wod = workOrderDetail::where('work_order_id', $this->editing->id)->select('id', 'item', 'price', 'discount', 'quantity')->get()->sortBy('item');
        // dd($wod->toArray());
        if (count($wod) == 0) {
            $this->dtw = [];
        } else {
            $this->dtw = $wod->map(function ($item, $key) {
                if (strlen(strval($item->item)) > 4)
                    $item->item = Product::where('code', strval($item->item))->select('name')->first();
                else
                    $item->item = Concept::where('code', str_pad($item->item, 3, "0", STR_PAD_LEFT))->select('name')->first();
                return $item;
            });
        }

        $this->vehicles = Vehicle::where('customer_id', $this->editing->customer)
            ->pluck('license_plate', 'id');

        $this->updateCartOptions();

        return view('livewire.ot.ot-edit')
            ->extends('layouts.admin.app')->section('content');
    }

    public function updatedEditingCustomer($value)
    {
        $this->editing->odo = '0';
        $this->editing->vehicle = '';
        $this->cf = Customer::find($value);
    }

    public function updatedEditingVehicle($value)
    {
        $this->vf = Vehicle::find($value);
        $this->editing->odo = $this->vf ? $this->vf->odo : 0;
    }

    public function updateCartOptions()
    {
        $this->totalCart = Cart::session($this->editing->code)->getTotal();
        $this->calculeTotal();
    }

    public function refreshListModals()
    {
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->products = Product::query()
            ->where('stock', '>', 0)->get();
        $this->concepts = Concept::query()->get();
        if ($this->editing->customer) {
            $this->vehicles = Vehicle::where('customer_id', $this->editing->customer)
                ->pluck('license_plate', 'id');
        } else {
            $this->vehicles = [];
        }
    }

    public function makeBlankFields()
    {
        return WorkOrder::make();
    } /*para dejar vacios los inpust*/

    public function addConcept(Concept $concept, $discount = 0)
    {
        Cart::session($this->editing->code)->add(intval($concept->code), $concept->name, 0, 1, array('discount' => $discount));
        $this->searchProductService = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Servicio agregado a la proforma');
    }

    public function addProduct(Product $product, $discount = 0)
    {
        if ($product->status == 'inactivo') {
            $this->emit('error_alert', 'Este producto está inactivo');
            return;
        }
        if ($product->stock <= 0) {
            $this->emit('error_alert', 'Este producto no tiene suficiento stock');
            return;
        }

        Cart::session($this->editing->code)->add(intval($product->code), $product->name, $product->sale_price, 1, array('discount' => $discount));
        $this->searchProductService = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la proforma');
    }

    public function updateQuantityCart($code_id, $cant, $discount = 0)
    {
        if (strlen($code_id) > 4) {
            $product = Product::where('code', $code_id)->first();
            if ($cant > $product->stock) {
                $this->emit('error_alert', 'No hay suficiente stock para este producto');
                return;
            }
        }
        $code = intval($code_id);
        $item = Cart::session($this->editing->code)->get($code);
        if ($cant > 0) {
            $this->removeItem($code);
            Cart::session($this->editing->code)->add($code, $item->name, $item->price, $cant, array('discount' => $discount));
        } else {
            $this->removeItem($code);
        }
        $this->updateCartOptions();
    }

    public function updateQuantityDot(workOrderDetail $dot, $cant = 0, $discount = 0)
    {
        if (strlen($dot->item) > 4) {
            $product = Product::where('code', $dot->item)->first();
            //new_stock_cant = (20+3)-23= 0
            $cant_pass = array($dot->quantity);//3
            $new_stock_cant = ($product->stock + $dot->quantity) - $cant;
            if ($new_stock_cant < 0) {
                $this->emit('error_alert', 'No hay suficiente stock para este producto');
                return;
            }

        }
        if ($cant > 0) {
            $dot->update(['quantity' => $cant, 'discount' => $discount, 'price' => $dot->price]);
        } else {
            $this->removeItemDot($dot->id);
        }
    }

    public function updatePriceCart($code_id, $price = 0)
    {
        $code = intval($code_id);
        if ($price > 0) {
            Cart::session($this->editing->code)->update($code, array('price' => $price));
        } else {
            Cart::session($this->editing->code)->update($code, array('price' => 0));
        }
        $this->updateCartOptions();
    }

    public function updatePriceDot(workOrderDetail $dot, $price = 0)
    {
        $dot->update(['price' => $price]);
    }

    public function updateDiscountCart($code_id, $discount = 0)
    {
        $code = intval($code_id);
        if ($discount > 0) {
            Cart::session($this->editing->code)->update($code, array('attributes' => array('discount' => $discount)));
        } else {
            Cart::session($this->editing->code)->update($code, array('attributes' => array('discount' => 0)));
        }
        $this->updateCartOptions();
    }

    public function updateDiscountDot(workOrderDetail $dot, $discount = 0)
    {
        if ($discount > 0) {
            $dot->update(['discount' => $discount]);
        } else {
            $dot->update(['discount' => 0]);
        }
    }

    public function removeItem($id)
    {
        Cart::session($this->editing->code)->remove($id);
        $this->updateCartOptions();
    }

    public function removeItemDot($id)
    {
        $dot = workOrderDetail::find($id);
        $dot->delete();
    }

    public function clearCart()
    {
        Cart::session($this->editing->code)->clear();
        foreach ($this->dtw as $do) {
            $do->delete();
        }
        $this->editing->update(['total' => 0]);
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de servicios y productos eliminados');
    }

    public function calculeTotal()
    {
        $this->totalDiscount = 0;
        $this->total_replacement = 0;
        $this->total_service = 0;
        $this->cart = Cart::session($this->editing->code)->getContent();
        $totalDiscountCart = 0;
        $totalDiscountDp = 0;
        $totalCartOG = 0;
        $totalDpOG = 0;
        $totalDp = 0;
        foreach ($this->cart as $c) {
            $totalDiscountCart += $c->price * $c->quantity - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        foreach ($this->dtw as $p) {
            $totalDiscountDp += $p->price * $p->quantity - (($p->quantity * $p->price) * ($p->discount / 100));
            $totalDp += $p->price * $p->quantity;
        }
        $totalCartOG = $totalDiscountCart / 1.18;
        $totalDpOG = $totalDiscountDp / 1.18;
        $this->totalOG = $totalCartOG + $totalDpOG;
        $this->total = $this->totalCart + $totalDp;
        $this->totalDiscount = $totalDiscountCart + $totalDiscountDp;

        $wod = workOrderDetail::where('work_order_id', $this->editing->id)->select('id', 'item', 'price', 'discount', 'quantity')->get();

        // Filtrar los items que son servicios
        $cart_replacement = $this->cart->filter(function ($i) {
            return strlen($i->id) > 4;
        });

        $dtw_replacement = $wod->filter(function ($i) {
            return strlen($i->item) > 4;
        });

        // Sumar el total de los items que son servicios
        foreach ($dtw_replacement as $dtw) {
            $this->total_replacement += ($dtw->price * $dtw->quantity) - (($dtw->quantity * $dtw->price) * ($dtw->discount / 100));
        }
        $dtw_service = $wod->filter(function ($i) {
            return strlen($i->item) < 4;
        });

        // Sumar el total de los items que son servicios
        foreach ($dtw_service as $dtw) {
            $this->total_service += ($dtw->price * $dtw->quantity) - (($dtw->quantity * $dtw->price) * ($dtw->discount / 100));
        }

        // Sumar el total de los items que son repuestos
        foreach ($cart_replacement as $cr) {
            $this->total_replacement += ($cr->price * $cr->quantity) - (($cr->quantity * $cr->price) * ($cr->attributes['discount'] / 100));
        }

        // Filtrar los items que son servicios
        $cart_service = $this->cart->filter(function ($i) {
            return strlen($i->id) < 4;
        });

        // Sumar el total de los items que son servicios
        foreach ($cart_service as $cs) {
            $this->total_service += ($cs->price * $cs->quantity) - (($cs->quantity * $cs->price) * ($cs->attributes['discount'] / 100));
        }
    }

    public function cancel()
    {
        Cart::session($this->editing->code)->clear();
        $this->updateCartOptions();
        return redirect()->route('proformas');
    }

    public function save()
    {
        if (count($this->cart) == 0 && count($this->dtw) == 0) {
            $this->emit('error_alert', 'No hay productos en la venta');
            return;
        } else {
            $this->saveLogic();
            return redirect()->route('proformas');
        }
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function saveLogic()
    {
        $this->validate();
        $this->calculeTotal();
        // update odo of vehicle to work order registeres
        $vehicle = Vehicle::find($this->editing->vehicle);
        $vehicle->odo = $this->editing->odo;
        $vehicle->save();
        $this->editing->total = $this->totalDiscount;
        $this->editing->save();

        //added items into work order detail
        foreach ($this->cart as $item) {
            workOrderDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'discount' => $item->attributes['discount'],
                'item' => $item->id,
                'work_order_id' => $this->editing->id,
            ]);
        }
        if ($this->editing->is_confirmed == 1) {
            //Updating a Sale and DuePay
            $saleOt = Sale::where('code_sale', 'like', '%' . $this->editing->code . '%')->get();
            if (count($saleOt->toArray()) > 0) {
                //update sale
                $saleOt->first()->update([
                    'total' => $this->total_replacement,
                    'customer_id' => $this->editing->customer,
                ]);

                $saleOt->first()->saleDetail()->get()->each(function ($item, $key) {
                    //update stock of product saled
                    $product = Product::find($item->product_id);
                    $product->stock += $item->quantity;
                    $product->save();
                });

                $saleOt->first()->saleDetail()->delete();

                // add new items to saleDetail - products
                $wod = workOrderDetail::where('work_order_id', $this->editing->id)->select('id', 'item', 'price', 'discount', 'quantity')->get();
                $dtw_replacement = $wod->filter(function ($i) {
                    return strlen($i->item) > 4;
                });

                foreach ($dtw_replacement as $cr) {
                    $productCodes = Product::where('code', $cr->item)->get();
                    foreach ($productCodes as $productCode) {
                        $product_id = $productCode->id;
                    }
                    SaleDetail::create([
                        'price' => $cr->price,
                        'quantity' => $cr->quantity,
                        'discount' => $cr->discount,
                        'product_id' => $product_id,
                        'sale_id' => $saleOt->first()->id,
                    ]);
                    //update stock of product saled
                    $product = Product::find($product_id);
                    $product->stock -= $cr->quantity;
                    $product->save();
                }

                // update amount_own duepay of ot
                DuePay::where('description', $saleOt->first()->code_sale)->update([
                    'amount_owed' => $this->totalDiscount,
                    'person_owed' => $this->editing->customer,
                ]);
            }
        }

        Cart::session($this->editing->code)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Proforma actualizado');
    }
}
