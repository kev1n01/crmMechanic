<?php

namespace App\Charts;

use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PurchaseStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        return
            $this->chart->donutChart()
            ->addData([
                Purchase::where('status', 'recibido')->count(),
                Purchase::where('status', 'pendiente')->count(),
            ])
            ->setColors(['#0acf97', '#39afd1'])
            ->setLabels(['Recibido', 'Pendiente']);
    }
}
