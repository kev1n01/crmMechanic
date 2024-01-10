<?php

namespace App\Charts;

use App\Models\WorkOrder;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class InformChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->addData([
                WorkOrder::where('is_confirmed', 1)->count(),
                WorkOrder::where('is_confirmed', 0)->count(),
            ])
            ->setColors(['#0acf97', '#fa5c7c'])
            ->setLabels(['Confirmado', 'No confirmado']);
    }
}
