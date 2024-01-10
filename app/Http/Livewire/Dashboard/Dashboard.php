<?php

namespace App\Http\Livewire\Dashboard;

use App\Charts\InformChart;
use App\Charts\OTchart;
use App\Charts\PurchaseStatusChart;
use App\Charts\SaleChart;
use Livewire\Component;

class Dashboard extends Component
{
    protected $chart_purchase = [];
    protected $chart_sale = [];
    protected $chart_ot = [];
    protected $chart_i = [];

    public function mount(
        PurchaseStatusChart $psc,
        SaleChart $sc,
        OTchart $otc,
        InformChart $ic
    ) {
        $this->chart_purchase = $psc->build();
        $this->chart_sale = $sc->build();
        $this->chart_ot = $otc->build();
        $this->chart_i = $ic->build();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard', [
            'chart_purchase' => $this->chart_purchase, 'chart_sale' => $this->chart_sale, 'chart_ot' => $this->chart_ot, 'chart_i' => $this->chart_i
        ])
            ->extends('layouts.admin.app')->section('content');
    }
}
