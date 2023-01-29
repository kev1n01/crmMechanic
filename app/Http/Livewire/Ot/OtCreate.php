<?php

namespace App\Http\Livewire\Ot;

use App\Models\Concept;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale as ModelsSale;
use App\Models\SaleDetail;
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

    public $searchConcept = '';
    public $concepts = [];
    public $statuses = [];
    public $customers = [];
    public $vehicles = [];
    public $sales = [];
    public $wo_sid = [];

    public $subtotal;
    public $total;
    public $itemsQuantity;

    public $another = false;

    public function rules()
    {
        return [
            'editing.code' => ['required', 'min:5', 'max:5', Rule::unique('work_orders', 'code')->ignore($this->editing)],
            'editing.odo' => 'required',
            'editing.arrival_date' => 'required',
            'editing.arrival_hour' => 'required',
            'editing.departure_date' => 'nullable',
            'editing.departure_hour' => 'nullable',
            'editing.customer' => 'required',
            'editing.status' => 'required|in:' . collect(WorkOrder::STATUSES)->keys()->implode(','),
            'editing.vehicle' => 'required',
            'editing.sale' => 'nullable',
        ];
    }

    protected $messages = [
        'editing.code.min' => 'El código no debe tener menos de 5 chares',
        'editing.code.max' => 'El código no debe tener más de 5 caracteres',
        'editing.code.required' => 'El código es obligatorio',
        'editing.code.unique' => 'Ya existe un OT con este código',
        'editing.odo.required' => 'El kilometraje es obligatorio',
        'editing.arrival_date.required' => 'La fecha de llegada es obligatoria',
        'editing.arrival_hour.required' => 'La hora de llegada es obligatoria',
        'editing.customer.required' => 'El cliente es obligatorio',
        'editing.status.required' => 'El estado es obligatorio',
        'editing.status.in' => 'El valor es inválido',
        'editing.vehicle.required' => 'El vehiculo es obligatorio',
    ];

    public function code_random($lenght)
    {
        $code = "";
        $char = true;
        for ($i = 1; $i <= $lenght; $i++) {
            if ($char) {
                $string_random = chr(rand(ord("a"), ord("z")));
                $string_random = strtoupper($string_random);
                $code .= $string_random;
                $char = false;
            } else {
                $number_random = rand(0, 9);
                $code .= $number_random;
                $char = true;
            }
        }
        return 'OT' . $code;
    }

    public function mount()
    {
        $this->editing = $this->makeBlankFields();
        if ($this->editing->getKey()) $this->editing = $this->makeBlankFields(); // para preservar cambios en los inputs for create
        $this->editing->code = $this->code_random(3);
        $this->editing->odo = '0';
        $this->statuses = WorkOrder::STATUSES;
        $this->customers = Customer::pluck('name', 'id');
    }

    public function render()
    {
        if ($this->searchConcept) {
            $this->concepts = Concept::query()->when(
                $this->searchConcept,
                fn ($q, $searchConcept) =>
                $q->where('name', 'like', '%' . $searchConcept . '%')
            )->get();
        } else {
            $this->concepts = [];
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

            $ots = WorkOrder::where('customer', $this->editing->customer)->get();
            $ots->each(function ($sl) {
                array_push($this->wo_sid, $sl->sale);
            });
            $this->sales = ModelsSale::whereNotIn('id', $this->wo_sid)
                ->where('customer_id', $this->editing->customer)
                ->pluck('code_sale', 'id');
        } else {
            $this->vehicles = [];
            $this->sales = [];
        }

        return view('livewire.ot.ot-create', ['cart' => $cart])
            ->extends('layouts.admin.app')->section('content');
    }

    public function updatedEditingCustomer()
    {
        $this->editing->odo = '0';
        $this->editing->sale = 0;
        $this->editing->vehicle = '';
    }
    public function updatedEditingVehicle()
    {
        $vf = Vehicle::find($this->editing->vehicle);
        $this->editing->odo = $vf ? $vf->odo : 0;
    }

    public function updateCartOptions()
    {
        $this->subtotal = Cart::session($this->editing->vehicle)->getSubTotal();
        $this->total = Cart::session($this->editing->vehicle)->getTotal();
        $this->itemsQuantity = Cart::session($this->editing->vehicle)->getTotalQuantity();
    }

    public function makeBlankFields()
    {
        return WorkOrder::make(['status' => 'en progreso']);
    } /*para dejar vacios los inpust*/

    public function addConcept(Concept $concept)
    {
        Cart::session($this->editing->vehicle)->add($concept->id, $concept->name, 0, 1);
        $this->searchConcept = '';
        $this->updateCartOptions();
        $this->emit('success_alert', 'Servicio agregado al OT');
    }

    public function updateQuantityCart($code_id, $cant)
    {
        $concept = Concept::find($code_id);
        $itemprice = Cart::session($this->editing->vehicle)->get($concept->id);
        if ($cant > 0) {
            $this->removeItem($concept->id);
            Cart::session($this->editing->vehicle)->add($concept->id, $concept->name, $itemprice->price, $cant);
            $this->updateCartOptions();
        } else {
            $this->removeItem($concept->id);
        }
    }

    public function updatePriceCart(Concept $concept, $price)
    {
        Cart::session($this->editing->vehicle)->update($concept->id, array('price' => $price));
        $this->updateCartOptions();
    }

    public function removeItem($conceptId)
    {
        Cart::session($this->editing->vehicle)->remove($conceptId);
        $this->updateCartOptions();
    }

    public function clearCart()
    {
        Cart::session($this->editing->vehicle)->clear();
        $this->updateCartOptions();
        $this->emit('success_alert', 'Lista de servicios reiniciado');
    }

    public function cancel()
    {
        Cart::session($this->editing->vehicle)->clear();
        $this->updateCartOptions();
        return redirect()->route('ordenes');
    }

    public function changeAnother()
    {
        $this->another = true;
    }

    public function save()
    {
        $this->saveLogic();
        if ($this->another) {
            return redirect()->route('ordenes.crear');
        } else {
            return redirect()->route('ordenes');
        }
    }

    public function saveLogic()
    {
        $this->validate();

        $sale = ModelsSale::find($this->editing->sale);
        $this->editing->total = $this->total + $sale->total;
        $this->editing->arrival_date = Carbon::parse($this->editing->arrival_date)->format('Y-m-d');
        $this->editing->arrival_hour = $this->editing->arrival_hour . ':00';
        $this->editing->save();

        $cartItems = Cart::session($this->editing->vehicle)->getContent()->filter(function ($item) {
            return strlen($item->id) != 5;
        });

        foreach ($cartItems as $item) {
            workOrderDetail::create([
                'price' => $item->price,
                'quantity' => $item->quantity,
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
        $this->emit('success_alert', 'Orden de trabajo registrado');
    }
}
