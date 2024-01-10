<?php

namespace App\Charts;

use App\Models\WorkOrder;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OTchart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->addData(
                [
                    WorkOrder::where('status', 'finalizado')->count(),
                    WorkOrder::where('status', 'retrasado')->count(),
                    WorkOrder::where('status', 'en progreso')->count(),
                ]
            )
            ->setColors(['#0acf97', '#fa5c7c', '#39afd1'])
            ->setLabels(['Finalizado', 'Retrasado', 'En progreso']);
    }
}
