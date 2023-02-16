<?php

namespace App\Http\Livewire\InvoiceForm;

use App\Models\Customer;
use App\Models\DuePay;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Traits\DataTable;
use Carbon\Carbon;
use Livewire\Component;

class IFTable extends Component
{
    use DataTable;

    public $confirmations = [];
    public $customers = [];
    public $vehicles = [];

    public $selected = [];
    public $selectedPage = false;

    public $showFilters = false;

    public $filters = [
        'fromDate' => null,
        'toDate' => null,
        'confirmation' => '',
        'customer' => '',
        'vehicle' => '',
    ];

    protected $listeners = ['delete', 'deleteSelected', 'refreshList' => '$refresh'];

    protected $queryString = ['search' => ['except' => '']];

    public function code_random($lenght, $letter = '')
    {
        $cc = Sale::count();
        $code = str_pad($cc + 1, $lenght, "0", STR_PAD_LEFT);
        return $letter . $code;
    }

    public function mount()
    {
        $this->sortField = 'code';
        $this->confirmations = WorkOrder::IS_CONFIRMED;
        $this->customers = Customer::pluck('name', 'id');
        $this->vehicles = Vehicle::pluck('license_plate', 'id');
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSelectedPage($value)
    {
        $this->selected = $value ? $this->works->pluck('id')->map(fn ($id) => (string) $id) : [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function showFilter()
    {
        $this->showFilters = $this->showFilters ? false : true;
    }

    public function getWorksProperty()
    {
        return WorkOrder::query()
            ->when($this->filters['fromDate'] && $this->filters['toDate'], fn ($q, $created_at) =>
            $q->whereBetween('arrival_date', [Carbon::parse($this->filters['fromDate'])->format('Y-m-d'), Carbon::parse($this->filters['toDate'])->format('Y-m-d')]))
            ->when(
                $this->search,
                fn ($q, $search) => $q->where('code', 'like', '%' . $search . '%')
                    ->orwhere('odo', 'like', '%' . $search . '%')
                    ->withWhereHas('customerUser', fn ($q2) => $q2->where('name', 'like', '%' . $search . '%'))
                    ->withWhereHas('vehiclePlate', fn ($q2) => $q2->where('license_plate', 'like', '%' . $search . '%'))
            )
            ->when($this->filters['confirmation'], fn ($q, $status) => $q->where('is_confirmed', $status))
            ->when($this->filters['customer'], fn ($q, $customer) => $q->where('customer', $customer))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        sleep(0.5); //se toma 2 seg para renderizar
        return view('livewire.invoice-form.i-f-table', [
            'works' => $this->works
        ])->extends('layouts.admin.app')->section('content');
    }

    public function delete(WorkOrder $wo)
    {
        $wo->workOrderDetail()->delete();
        $wo->delete();
        $this->emit('success_alert', 'La proforma fue eliminado');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo WorkOrder::whereKey($this->selected)->toCsv();
        }, 'proformas.csv');
        $this->emit('success_alert', 'Se exportaron los registros seleccionados');
    }

    public function deleteSelected()
    {
        $wo = WorkOrder::whereKey($this->selected);
        $wofind = WorkOrder::find($this->selected);
        foreach ($wofind as $wof) {
            $wof->workOrderDetail()->delete();
        }
        $wo->delete();
        $this->emit('success_alert', count($this->selected) . ' registros eliminados');
    }
    public function changeConfirmation(WorkOrder $wo)
    {
        $total_service = 0;
        $total_replacement = 0;
        if ($wo->is_confirmed == 1) { //1=confirmado 0=no confirmado
            $wo->is_confirmed = 0;
        } else {
            $wo->is_confirmed = 1;

            // Filtrar los items que son servicios
            $wod_service = $wo->workOrderDetail()->get()->filter(function ($i) {
                return strlen($i->item) <= 3;
            });
            // Sumar el total de los items que son servicios
            foreach ($wod_service as $wod) {
                $total_service += ($wod->price * $wod->quantity) - (($wod->quantity * $wod->price) * ($wod->discount / 100));
            }

            // Filtrar los items que son repuestos
            $wod_replacement = $wo->workOrderDetail()->get()->filter(function ($i) {
                return strlen($i->item) >= 4;
            });

            // Sumar el total de los items que son repuestos
            foreach ($wod_replacement as $wod) {
                $total_replacement += ($wod->price * $wod->quantity) - (($wod->quantity * $wod->price) * ($wod->discount / 100));
            }
            
            DuePay::create([
                'description' => $wo->code,
                'person_owed' => $wo->customerUser->name,
                'amount_owed' => $total_service,
                'amount_paid' => 0,
                'reason' => 'mano de obra',
            ]);

            $sale = Sale::create([
                'code_sale' => $this->code_random(5, 'V'),
                'customer_id' => $wo->customer,
                'total' => $total_replacement,
                'cash' => 0,
                'change' => 0,
                'date_sale' => Carbon::now()->format('Y-m-d'),
                'observation' => 'Venta de repuestos para la proforma ' . $wo->code,
                'status' => 'no pagado',
            ]);
            //falta filtrar los productos por su codigo

            foreach ($wod_replacement as $wod) {
                $productCodes = Product::where('code',$wod->item)->get();
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
                $product = Product::find($wod->id);
                $product->stock -= $wod->quantity;
                $product->save();
            }
    

            DuePay::create([
                'description' => $sale->code_sale,
                'person_owed' => $wo->customerUser->name,
                'amount_owed' => $total_replacement,
                'amount_paid' => 0,
                'reason' => 'venta',
            ]);
        }
        $wo->save();
        $this->emit('success_alert', 'Confirmacion actualizada');
    }
}
