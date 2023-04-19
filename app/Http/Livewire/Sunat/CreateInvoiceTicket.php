<?php

namespace App\Http\Livewire\Sunat;

use App\Models\Comprobant;
use App\Models\Sale;
use Livewire\Component;

class CreateInvoiceTicket extends Component
{
    //data for selects
    public $typescpe;
    public $sales = [];
    public $select_id;

    public Comprobant $comprobant;

    public function mount()
    {
        $this->comprobant = $this->makeBlankFields();
        $this->typescpe = Comprobant::TYPE_CPE;
        $this->sales = Sale::pluck('code_sale', 'id');
    }

    public function makeBlankFields()
    {
        return Comprobant::make(); /*para dejar v acios los inpust*/
    }

    public function rules()
    {
        return [
            'editing.name' => ['required', 'min:5'],
            'editing.phone' => 'required|min:9|max:9',
            'editing.ruc' => 'required|min:11|max:11',
            'editing.ubigeous' => 'required|min:6|max:6',
            'editing.address' => 'required',
            'editing.logo' => ['nullable'],
            'editing.department' => 'required',
            'editing.province' => 'required',
            'editing.district' => 'required',
        ];
    }
    
    public function render()
    {
        return view('livewire.sunat.create-invoice-ticket')
            ->extends('layouts.admin.app')->section('content');
    }
}
