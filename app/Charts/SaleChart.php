<?php

namespace App\Charts;

use App\Models\Sale;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;

class SaleChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $sale_month_comercial = Sale::select(
            DB::raw('month(date_sale) as month'),
            DB::raw('count(*) as count'),
        )
            ->where('type_sale', 'comercial')
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();

        $sale_month_vehicular = Sale::select(
            DB::raw('month(date_sale) as month'),
            DB::raw('count(*) as count'),
        )
            ->where('type_sale', 'vehicular')
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();

        $result_comercial = [];
        $qty_sale_month_comercial = [];
        foreach ($sale_month_comercial as $sale) {
            $result_comercial[$sale['month']] = $sale['count'];
        }
        for ($mc = 1; $mc <= 12; $mc++) {
            $qty_sale_month_comercial[$mc] = isset($result_comercial[$mc]) ? $result_comercial[$mc] : 0;
        }

        $result_vehicular = [];
        $qty_sale_month_vehicular = [];
        foreach ($sale_month_vehicular as $sale) {
            $result_vehicular[$sale['month']] = $sale['count'];
        }
        for ($mv = 1; $mv <= 12; $mv++) {
            $qty_sale_month_vehicular[$mv] = isset($result_vehicular[$mv]) ? $result_vehicular[$mv] : 0;
        }

        return $this->chart->areaChart()
            ->addData(
                'Venta comercial',
                array_values($qty_sale_month_comercial)
            )
            ->addData(
                'Venta vehicular',
                array_values($qty_sale_month_vehicular)
            )
            ->setColors([
                '#727cf5', '#ffbc00'
            ])
            ->setXAxis([
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julip', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ])
            ;
    }
}
