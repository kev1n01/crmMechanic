<?php

namespace App\Http\Livewire\Ot;

use App\Models\DuePay;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Livewire\Component;

class OtConfModal extends Component
{
    public $idModal = 'otConfModal';
    public $nameModal;
    public $method_payment;
    public WorkOrder $editing;
    protected $listeners = ['addDateWo'];
    public $methods_payment = Sale::METHOD_PAYMENTS;


    public function rules()
    {
        return [
            'editing.arrival_date' => 'required|date',
            'editing.arrival_hour' => 'required',
            'editing.departure_date' => 'nullable|date',
            'editing.departure_hour' => 'nullable',
            'editing.odo' => 'required',
            'method_payment' => 'required|in:' . collect(Sale::METHOD_PAYMENTS)->keys()->implode(','),
        ];
    }
    protected $messages = [
        'editing.arrival_date.required' => 'La fecha de llegada es obligatoria',
        'editing.arrival_date.date' => 'No es una fecha valida',
        'editing.arrival_hour.required' => 'La hora de llegada es obligatoria',
        'editing.departure_date.date' => 'No es una fecha valida',
        'editing.arrival_hour.required' => 'La hora de llegada es obligatoria',
        'editing.odo.required' => 'El odometro es obligatorio',
        'method_payment.required' => 'El metodo de pago es obligatorio',
    ];

    public function code_random($lenght)
    {
        $countSale = Sale::count();
        $code = str_pad($countSale + 1, $lenght, "0", STR_PAD_LEFT);
        return 'V' . $code;
    }

    public function save()
    {
        $this->validate();
        $this->changeConfirmation();
        $this->dispatchBrowserEvent('close-modal-ot-conf');
        $this->emit('refreshList');
    }

    public function updated($label)
    {
        $this->validateOnly($label, $this->rules(), $this->messages);
    }

    public function addDateWo(WorkOrder $wo)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->nameModal = 'Configurar Orden de Trabajo';
        $this->dispatchBrowserEvent('open-modal-ot-conf');
        $this->editing = $wo;
        if ($this->editing->arrival_date != null) {
            $this->editing->arrival_date = Carbon::parse($this->editing->arrival_date)->format('d-m-Y');
        } else {
            $this->editing->arrival_date = Carbon::now()->format('d-m-Y');
        }

        if ($this->editing->arrival_hour != null) {
            $this->editing->arrival_hour = $this->editing->arrival_hour;
        } else {
            $this->editing->arrival_hour = Carbon::now()->format('H:i');
        }

        if ($this->editing->departure_date != null) {
            $this->editing->departure_date = Carbon::parse($this->editing->departure_date)->format('d-m-Y');
        }
        if ($this->editing->departure_hour != null) {
            $this->editing->departure_hour = $this->editing->departure_hour;
        }
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal-ot-conf');
    }


    public function changeConfirmation()
    {
        if ($this->editing->is_confirmed == 0) {
            // $total_service = 0;
            $total_replacement = 0;
            $totalwod = 0;
            $this->editing->is_confirmed = 1;
            $this->editing->status = 'en progreso';
            $this->editing->arrival_date = Carbon::parse($this->editing->arrival_date)->format('Y-m-d');
            $this->editing->arrival_hour = $this->editing->arrival_hour;

            if ($this->editing->departure_date != null) {
                $this->editing->departure_date = Carbon::parse($this->editing->departure_date)->format('Y-m-d');
            }
            if ($this->editing->departure_hour != null) {
                $this->editing->departure_hour = $this->editing->departure_hour;
            }

            // Filtrar los items que son repuestos
            $wod_replacement = $this->editing->workOrderDetail()->get()->filter(function ($i) {
                return strlen($i->item) > 4;
            });

            // Sumar el total de los items que son repuestos
            foreach ($wod_replacement as $wod) {
                $total_replacement += ($wod->price * $wod->quantity) - (($wod->quantity * $wod->price) * ($wod->discount / 100));
            }

            foreach ($this->editing->workOrderDetail()->get() as $wod) {
                $totalwod += ($wod->price * $wod->quantity) - (($wod->quantity * $wod->price) * ($wod->discount / 100));
            }

            $sale = Sale::create([
                'code_sale' => $this->code_random(5, 'V') . ' - ' . $this->editing->code,
                'customer_id' => $this->editing->customer,
                'total' => $total_replacement,
                'cash' => 0,
                'type_payment' => 'credito',
                'method_payment' => $this->method_payment,
                'type_sale' => 'vehicular',
                'date_sale' => Carbon::now()->format('Y-m-d'),
                'observation' => 'Venta de repuestos para la proforma ' . $this->editing->code,
                'status' => 'no pagado',
            ]);

            DuePay::create([
                'description' => $sale->code_sale,
                'person_owed' => $this->editing->customerUser->name,
                'amount_owed' => $totalwod,
                'amount_paid' => 0,
                'reason' => 'ot',
            ]);


            //falta filtrar los productos por su codigo
            foreach ($wod_replacement as $wod) {
                $productCodes = Product::where('code', 'like', '%' . $wod->item . '%')->get();
                foreach ($productCodes as $productCode) {
                    $product_id = $productCode->id;
                }

                SaleDetail::create([
                    'price' => $wod->price,
                    'quantity' => $wod->quantity,
                    'discount' => $wod->discount,
                    'product_id' => $product_id,
                    'sale_id' => $sale->id,
                ]);

                //update stock of product saled
                $product = Product::find($product_id);
                $product->stock -= $wod->quantity;
                $product->save();
            }
            // update odo of vehicle to work order registeres
            $vehicle = Vehicle::find($this->editing->vehicle);
            $vehicle->odo = $this->editing->odo;
            $vehicle->save();

            $this->editing->save();
            $this->emit('success_alert', 'Orden de trabajo configurada y en progreso');
        } else {
            $this->editing->arrival_date = Carbon::parse($this->editing->arrival_date)->format('Y-m-d');
            $this->editing->arrival_hour = $this->editing->arrival_hour;
            if ($this->editing->departure_date != null) {
                $this->editing->departure_date = Carbon::parse($this->editing->departure_date)->format('Y-m-d');
            } else {
                $this->editing->departure_date = null;
            }
            if ($this->editing->departure_hour != null) {
                $this->editing->departure_hour = $this->editing->departure_hour;
            }
            if ($this->editing->departure_hour == '00:00:00') {
                $this->editing->departure_hour = null;
            }
            $this->editing->save();

            // update odo of vehicle to work order registeres
            $vehicle = Vehicle::find($this->editing->vehicle);
            $vehicle->odo = $this->editing->odo;
            $vehicle->save();

            $this->emit('success_alert', 'Configuracion de orden de trabajo actualizada');
        }
    }

    public function render()
    {
        return view('livewire.ot.ot-conf-modal');
    }
}
