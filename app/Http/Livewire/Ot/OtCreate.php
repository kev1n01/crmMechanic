<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Models\workOrderDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Validation\Rule;
use Livewire\Component;

class OtCreate extends Component
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

    public $total;
    public $totalDiscount = 0;
    public $totalOG = 0;

    public $total_replacement = 0;
    public $total_service = 0;

    public $another = false;
    protected $listeners = ['refreshListModals'];

    public function rules()
    {
        return [
            'editing.code' => ['required', 'min:6', 'max:6', Rule::unique('work_orders', 'code')->ignore($this->editing)],
            'editing.odo' => 'nullable',
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
        'editing.customer.required' => 'El cliente es obligatorio',
        'editing.type_atention.required' => 'El tipo de atención es obligatorio',
        'editing.vehicle.required' => 'El vehiculo es obligatorio',
    ];

    public function code_random($lenght, $letter = '')
    {
        $countWo = WorkOrder::count();
        $code = str_pad($countWo + 1, $lenght, "0", STR_PAD_LEFT);
        return $letter . '' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs for create
        $this->editing->code = $this->code_random(5, 'P');
        $this->statuses = WorkOrder::STATUSES;
        $this->types  = WorkOrder::TYPES;
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
    }

    public function render()
    {
        if ($this->searchProductService) {
            $this->concepts = Concept::query()->when(
                $this->searchProductService,
                fn ($q, $searchProductService) =>
                $q->where('name', 'like', '%' . $searchProductService . '%')
            )->get();
            $this->products = Product::query()->where('stock', '>', 0)->when(
                $this->searchProductService,
                fn ($q, $searchProductService) =>
                $q->where('name', 'like', '%' . $searchProductService . '%')
                    ->orwhere('code', 'like', '%' . $searchProductService . '%')
            )->get();
        } else {
            $this->concepts = [];
            $this->products = [];
        }

        if ($this->editing->vehicle) {
            $this->cart = Cart::session($this->editing->vehicle)->getContent()->sortBy('name');
            $this->updateCartOptions();
        } else {
            $this->cart = [];
        }

        if ($this->editing->customer) {
            $this->vehicles = Vehicle::where('customer_id', $this->editing->customer)
                ->pluck('license_plate', 'id');
        } else {
            $this->vehicles = [];
        }

        return view('livewire.ot.ot-create')
            ->extends('layouts.admin.app')->section('content');
    }

    public function updatedEditingCustomer($value)
    {
        $this->editing->vehicle = '';
        $this->cf = Customer::find($value);
    }

    public function updatedEditingVehicle($value)
    {
        $this->vf = Vehicle::find($value);
    }

    public function updateCartOptions()
    {
        $this->total = Cart::session($this->editing->vehicle)->getTotal();
        $this->calculeTotal();
    }

    public function refreshListModals()
    {
        $this->customers = Customer::where('status', 'activo')->pluck('name', 'id');
        $this->products = Product::query()->where('stock', '>', 0)->get();
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
        Cart::session($this->editing->vehicle)->add(intval($concept->code), $concept->name, 0, 1, array('discount' => $discount));
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

        Cart::session($this->editing->vehicle)->add(intval($product->code), $product->name, $product->sale_price, 1, array('discount' => $discount));
        $this->searchProductService = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Producto agregado a la proforma');
    }

    public function updateQuantityCart($id, $cant, $discount = 0)
    {
        if (strlen($id) > 4) {
            $product = Product::where('code', $id)->first();
            if ($cant > $product->stock) {
                $this->emit('error_alert', 'No hay suficiente stock para este producto');
                return;
            }
        }
        $code = intval($id);
        $item = Cart::session($this->editing->vehicle)->get($code);
        if ($cant > 0) {
            $this->removeItem($code);
            Cart::session($this->editing->vehicle)->add($code, $item->name, $item->price, $cant, array('discount' => $discount));
        } else {
            $this->removeItem($code);
        }
        $this->updateCartOptions();
    }

    public function updatePriceCart($id, $price = 0)
    {
        $code = intval($id);
        if ($price > 0) {
            Cart::session($this->editing->vehicle)->update(intval($code), array('price' => $price));
        } else {
            Cart::session($this->editing->vehicle)->update(intval($code), array('price' => 0));
        }
        $this->updateCartOptions();
    }

    public function updateDiscountCart($id, $discount = 0)
    {
        $code = intval($id);
        if ($discount > 0) {
            Cart::session($this->editing->vehicle)->update($code, array('attributes' => array('discount' => $discount)));
        } else {
            Cart::session($this->editing->vehicle)->update($code, array('attributes' => array('discount' => 0)));
        }
        $this->updateCartOptions();
    }

    public function removeItem($id)
    {
        Cart::session($this->editing->vehicle)->remove($id);
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->editing->vehicle)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de servicios y productos eliminados');
    }

    public function calculeTotal()
    {
        $this->totalDiscount = 0;
        $this->total_replacement = 0;
        $this->total_service = 0;
        $this->cart = Cart::session($this->editing->vehicle)->getContent();
        foreach ($this->cart as $c) {
            $this->totalDiscount += $c->price * $c->quantity - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        $this->totalOG = $this->totalDiscount / 1.18;

        // Filtrar los items que son servicios
        $cart_replacement = $this->cart->filter(function ($i) {
            return strlen($i->id) > 4;
        });

        // Sumar el total de los items que son servicios
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
        Cart::session($this->editing->vehicle)->clear();
        $this->updateCartOptions();
        return redirect()->route('proformas');
    }

    public function changeAnother()
    {
        $this->another = true;
    }

    public function save()
    {
        if (count($this->cart) == 0) {
            $this->emit('error_alert', 'No hay productos en la venta');
        } else {
            $this->saveLogic();
            if ($this->another) {
                return redirect()->route('proforma.orden.crear');
            } else {
                return redirect()->route('proformas');
            }
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
        $this->editing->total = $this->totalDiscount;
        $vehicle = Vehicle::find($this->editing->vehicle);
        $this->editing->odo = $vehicle->odo;
        $this->editing->is_confirmed = 0;
        $this->editing->save();

        foreach ($this->cart as $item) {
            workOrderDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'discount' => $item->attributes['discount'],
                'item' => $item->id,
                'work_order_id' => $this->editing->id,
            ]);
        }

        Cart::session($this->editing->vehicle)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Proforma registrado');
    }
}
