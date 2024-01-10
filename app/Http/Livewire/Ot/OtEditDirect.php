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
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class OtEditDirect extends Component
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
            'editing.date_emission' => 'required',
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
        'editing.date_emission.required' => 'La fecha de emision es obligatorio',
    ];

    public function mount($code)
    {
        $wo = WorkOrder::where('code', $code)->first();
        $this->editing = $this->makeBlankFields();
        if ($this->editing->isNot($wo)) $this->editing = $wo; // para preservar cambios en los inputs for create
        $this->editing->date_emission = Carbon::parse($this->editing->date_emission)->format('d-m-Y');
        $this->statuses = WorkOrder::STATUSES;
        $this->types  = WorkOrder::TYPES;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->cf = Customer::find($this->editing->customer);
        $this->vf = Vehicle::find($this->editing->vehicle);


        $this->cart = Cart::session($this->editing->code)->getContent()->sortBy('name');

        $wod = workOrderDetail::where('work_order_id', $this->editing->id)->select('id', 'item', 'price', 'discount', 'quantity')->get()->sortBy('item.code');
        // dd($wod->toArray());
        if (count($wod) == 0) {
            $wod = [];
        } else {
            $wod = $wod->map(function ($item, $key) {
                if (strlen(strval($item->item)) > 4)
                    $item->item = Product::where('code', 'like', '%' . strval($item->item) . '%')->select('code', 'name')->first();
                else
                    $item->item = Concept::where('code',$item->item)->select('code', 'name')->first();
                return $item;
            });
            // dd($wod->toArray());
            foreach ($wod as $wodm) {
                // dd($wodm->item->code);
                Cart::session($this->editing->code)->add(intval($wodm->item->code), $wodm->item->name, $wodm->price, $wodm->quantity, ['discount' => $wodm->discount]);

                $id = Cart::session($this->editing->code)->get(intval($wodm->item->code))->id;

                $this->updateQuantityCart($id, $wodm->quantity, $wodm->discount);
            }
            // dd($this->cart->toArray());
        }
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

        $this->vehicles = Vehicle::where('customer_id', $this->editing->customer)
            ->pluck('license_plate', 'id');

        $this->updateCartOptions();

        return view('livewire.ot.ot-edit-direct')
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
        $this->total = Cart::session($this->editing->code)->getTotal();
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
        $item_exist = Cart::session($this->editing->code)->get(intval($concept->code));
        if ($item_exist != null) {
            Cart::session($this->editing->code)->add(intval($concept->code), $concept->name, $item_exist->price, 1, ['discount' => $item_exist->attributes['discount']]);
        } else {
            Cart::session($this->editing->code)->add(intval($concept->code), $concept->name, 0, 1, array('discount' => $discount));
        }

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
        $item_exist = Cart::session($this->editing->code)->get(intval($product->code));
        if ($item_exist != null) {
            Cart::session($this->editing->code)->add(intval($product->code), $product->name, $item_exist->price, 1, ['discount' => $item_exist->attributes['discount']]);
        } else {
            Cart::session($this->editing->code)->add(intval($product->code), $product->name, $product->sale_price, 1, array('discount' => $discount));
        }

        $this->searchProductService = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la proforma');
    }

    public function updateQuantityCart($code_id, $cant, $discount = 0)
    {
        // dd($code_id);
        if (strlen($code_id) > 4) {
            $product = Product::where('code', 'like', '%' . $code_id . '%')->first();
            if ($this->editing->is_confirmed == 1) {
                $saleOt = Sale::where('code_sale', 'like', '%' . $this->editing->code . '%')->first();
                $sale_detail_quantity = SaleDetail::where('sale_id', $saleOt->id)->where('product_id', $product->id)->first();
                // dd($sale_detail_quantity);
                $saleq = $sale_detail_quantity == null ? 0 : $sale_detail_quantity->quantity;
                // if ($sale_detail_quantity == null) {
                //     $saleq = 0;
                // } else {
                //     $saleq = $sale_detail_quantity->quantity;
                // }
                if ($cant > ($product->stock + $saleq)) {
                    $this->emit('info_alert', 'Este producto no tiene suficiento stock');
                    return;
                }
            } else {
                if ($cant > $product->stock) {
                    $this->emit('info_alert', 'Este producto no tiene suficiento stock');
                    return;
                }
            }
        }
        // $code = intval($code_id);

        $item = Cart::session($this->editing->code)->get($code_id);
        // dd($item);
        if ($cant > 0) {
            $this->removeItem($code_id);
            Cart::session($this->editing->code)->add($code_id, $item->name, $item->price, $cant, array('discount' => $discount));
        } else {
            $this->removeItem($code_id);
        }
        $this->updateCartOptions();
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

    public function removeItem($id)
    {
        // dd($id);
        Cart::session($this->editing->code)->remove($id);
        $this->updateCartOptions();
    }

    public function clearCart()
    {
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
        foreach ($this->cart as $c) {
            $this->totalDiscount += $c->price * $c->quantity - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        $this->totalOG = $this->totalDiscount / 1.18;

        // Filtrar los items que son repuestos
        $cart_replacement = $this->cart->filter(function ($i) {
            return strlen($i->id) > 4;
        });

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
        return redirect()->route('ordenes');
    }

    public function save()
    {
        if (count($this->cart) == 0) {
            $this->emit('error_alert', 'No hay productos en la proforma');
            return;
        } else {
            $this->saveLogic();
            return redirect()->route('ordenes');
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
        if ($this->editing->is_confirmed == 1) {
            // update odo of vehicle to work order registeres
            $vehicle = Vehicle::find($this->editing->vehicle);
            $vehicle->odo = $this->editing->odo;
            $vehicle->save();
        }
        $this->editing->date_emission = Carbon::parse($this->editing->date_emission)->format('Y-m-d');
        $this->editing->total = $this->totalDiscount;
        $this->editing->save();

        $this->editing->workOrderDetail()->delete();

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
                    $item->product->stock += $item->quantity;
                    $item->product->save();
                });

                $saleOt->first()->saleDetail()->delete();

                // add new items to saleDetail - products
                $this->cart = Cart::session($this->editing->code)->getContent();
                $cart_replacement = $this->cart->filter(function ($i) {
                    return strlen($i->id) > 4;
                });

                foreach ($cart_replacement as $cr) {
                    $productCodes = Product::where('code', 'like', '%' . $cr->id . '%')->get();
                    foreach ($productCodes as $productCode) {
                        $product_id = $productCode->id;
                    }
                    SaleDetail::create([
                        'price' => $cr->price,
                        'quantity' => $cr->quantity,
                        'discount' => $cr->attributes['discount'],
                        'product_id' => $product_id,
                        'sale_id' => $saleOt->first()->id,
                    ]);
                    //update stock of product saled
                    $product = Product::find($product_id);
                    $product->stock -= $cr->quantity;
                    if ($product->sale_price == 0) {
                        $product->sale_price = $cr->price;
                    }
                    $product->save();
                }
            }
            // update amount_own duepay of ot
            $due = DuePay::where('description', $saleOt->first()->code_sale)->first();
            // dd($due);
            if ($due->amount_paid >= $this->total_replacement) {
                $saleOt->first()->update([
                    'cash' => $this->total_replacement,
                    'status' => 'pagado',
                ]);
            }
            if ($due->amount_paid < $this->total_replacement) {
                $saleOt->first()->update([
                    'cash' => $due->amount_paid,
                    'status' => 'no pagado',
                ]);
            }
            $due->update([
                'amount_owed' => $this->totalDiscount,
                'person_owed' => $this->editing->customerUser->name,
            ]);
        }

        Cart::session($this->editing->code)->clear();
        $this->updateCartOptions();

        $this->emit('success_alert', 'Orden de trabajo actualizada');
    }
}
