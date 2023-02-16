<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Models\workOrderDetail;
use Carbon\Carbon;
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
    public $wo_sid = [];

    public $subtotal;
    public $total;
    public $itemsQuantity;

    public $another = false;

    public function rules()
    {
        return [
            'editing.code' => ['required', 'min:6', 'max:6', Rule::unique('work_orders', 'code')->ignore($this->editing)],
            'editing.odo' => 'required',
            'editing.arrival_date' => 'required',
            'editing.arrival_hour' => 'required',
            'editing.departure_date' => 'nullable',
            'editing.departure_hour' => 'nullable',
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
        'editing.arrival_date.required' => 'La fecha de llegada es obligatoria',
        'editing.arrival_hour.required' => 'La hora de llegada es obligatoria',
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
        $this->editing->odo = '0';
        $this->statuses = WorkOrder::STATUSES;
        $this->types  = WorkOrder::TYPES;
        $this->customers = Customer::pluck('name', 'id');
    }

    public function render()
    {
        if ($this->searchProductService) {
            $this->concepts = Concept::query()->when(
                $this->searchProductService,
                fn ($q, $searchProductService) =>
                $q->where('name', 'like', '%' . $searchProductService . '%')
            )->get();
            $this->products = Product::query()->when(
                $this->searchProductService,
                fn ($q, $searchProductService) =>
                $q->where('name', 'like', '%' . $searchProductService . '%')
            )->get();
        } else {
            $this->concepts = [];
            $this->products = [];
        }

        if ($this->editing->vehicle) {
            $cart = Cart::session($this->editing->vehicle)->getContent()->sortBy('name');
            $this->updateCartOptions();
        } else {
            $cart = [];
        }

        if ($this->editing->customer) {
            $this->vehicles = Vehicle::where('customer_id', $this->editing->customer)
                ->pluck('license_plate', 'id');
        } else {
            $this->vehicles = [];
        }

        return view('livewire.ot.ot-create', ['cart' => $cart])
            ->extends('layouts.admin.app')->section('content');
    }

    public function updatedEditingCustomer()
    {
        $this->editing->odo = '0';
        $this->editing->vehicle = '';
    }

    public function updatedEditingVehicle()
    {
        $vf = Vehicle::find($this->editing->vehicle);
        $this->editing->odo = $vf ? $vf->odo : 0;
    }

    public function updateCartOptions()
    {
        $this->total = Cart::session($this->editing->vehicle)->getTotal();
        $this->itemsQuantity = Cart::session($this->editing->vehicle)->getTotalQuantity();
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

    public function updateQuantityCart($code_id, $cant, $discount = 0)
    {
        if (strlen($code_id) == 1) {
            $product_or_concept = Concept::find($code_id);
            $code = intval($product_or_concept->code);
            $itemprice = Cart::session($this->editing->vehicle)->get($code);
        } else {
            $product_or_concept = Product::where('code', $code_id)->first();
            $code = intval($product_or_concept->code);
            $itemprice = Cart::session($this->editing->vehicle)->get($code);
        }
        if ($cant > 0) {
            $this->removeItem($code);
            Cart::session($this->editing->vehicle)->add($code, $product_or_concept->name, $itemprice->price, $cant, array('discount' => $discount));
        } else {
            $this->removeItem($code);
        }
        $this->updateCartOptions();
    }

    public function updatePriceCart($code_id, $price)
    {
        $concept = Concept::where('code', $code_id)->first();
        Cart::session($this->editing->vehicle)->update(intval($concept->code), array('price' => $price));
        $this->updateCartOptions();
    }

    public function updateDiscountCart($code_id, $discount)
    {
        if (strlen($code_id) == 1) {
            $concept = Concept::find($code_id);
            $code = intval($concept->code);
        } else {
            $product = Product::where('code', $code_id)->first();
            $code = intval($product->code);
        }
        if ($discount > 0) {
            Cart::session($this->editing->vehicle)->update($code, array('attributes' => array('discount' => $discount)));
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
        $this->saveLogic();
        if ($this->another) {
            return redirect()->route('proforma.orden.crear');
        } else {
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
        $cartItems = Cart::session($this->editing->vehicle)->getContent();
        $totalDiscount = 0;
        foreach ($cartItems as $c) {
            $totalDiscount += ($c->price * $c->quantity) - (($c->quantity * $c->price) * ($c->attributes['discount'] / 100));
        }
        $this->editing->total = $totalDiscount;
        $this->editing->status = 'en progreso';
        $this->editing->is_confirmed = 0;
        $this->editing->arrival_date = Carbon::parse($this->editing->arrival_date)->format('Y-m-d');
        $this->editing->arrival_hour = $this->editing->arrival_hour . ':00';
        if ($this->editing->departure_date != null) {
            $this->editing->departure_date = Carbon::parse($this->editing->departure_date)->format('Y-m-d');
        }
        if ($this->editing->departure_hour != null) {
            $this->editing->departure_hour = $this->editing->departure_hour . ':00';
        }
        $this->editing->save();

        foreach ($cartItems as $item) {
            workOrderDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'discount' => $item->attributes['discount'],
                'item' => $item->id,
                'work_order_id' => $this->editing->id,
            ]);
        }

        // update odo of vehicle to work order registeres
        $vehicle = Vehicle::find($this->editing->vehicle);
        $vehicle->odo = $this->editing->odo;
        $vehicle->save();

        Cart::session($this->editing->vehicle)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Proforma registrado');
    }
}
