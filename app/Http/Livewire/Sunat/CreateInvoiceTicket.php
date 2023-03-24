<?php

namespace App\Http\Livewire\Sunat;

use Livewire\Component;

class CreateInvoiceTicket extends Component
{
    public $tipoDoc;
    public $serie;
    public $correlativo;
    public $fechaEmision;
    public $moneda;
    public $tipo;

    public $tipoDocClient;
    public $numDoc;
    public $rznSocialClient;
    public $direccionClient;
    public $provinciaClient;
    public $departamentoClient;
    public $distritoClient;
    public $ubigueoClient;

    public $ruc;
    public $razonSocialCompany;
    public $nombreComercialCompany;
    public $direccionCompany;
    public $provinciaCompany;
    public $departamentoCompany;
    public $distritoCompany;
    public $ubigueoCompany;

    public $mtoOperGravadas;
    public $mtoOperExoneradas;
    public $mtoIGV;
    public $totalImpuestos;
    public $valorVenta;
    public $subTotal;
    public $mtoImpVenta;

    public $value;
    
    public function render()
    {
        return view('livewire.sunat.create-invoice-ticket');
    }
}
