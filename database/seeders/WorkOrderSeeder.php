<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workOrders = [
            [
                'code' =>  'OT-001',
                'odo' =>  '12341',
                'arrival_date' =>  '2023-01-13',
                'arrival_hour' =>  '12:00:00',
                'departure_date' =>  '2023-01-13',
                'departure_hour' =>  '12:00:00',
                'total' =>  120.00,
                'customer' =>  1,
                'status' =>  'en progreso',
                'vehicle' =>  4,
                'created_at' => now(),
            ],
            [
                'code' =>  'OT-038',
                'odo' =>  '13341',
                'arrival_date' =>  '2023-01-13',
                'arrival_hour' =>  '12:00:00',
                'departure_date' =>  '2023-01-13',
                'departure_hour' =>  '12:00:00',
                'total' =>  2302.00,
                'customer' =>  1,
                'status' =>  'finalizado',
                'vehicle' =>  1,
                'created_at' => now(),
            ],
            [
                'code' =>  'OT-018',
                'odo' =>  '32422',
                'arrival_date' =>  '2023-01-13',
                'arrival_hour' =>  '12:00:00',
                'departure_date' =>  '2023-01-13',
                'departure_hour' =>  '12:00:00',
                'total' =>  1102.00,
                'customer' =>  3,
                'status' =>  'cancelado',
                'vehicle' =>  2,
                'created_at' => now(),
            ],
        ];

        DB::table('work_orders')->insert($workOrders);

        $workOrderDetails = [
            [
                'work_order_id' => 1,
                'concept_id' => 1,
                'quantity' => 2,
                'price' => 322,
            ],
            [
                'work_order_id' => 1,
                'concept_id' => 2,
                'quantity' => 1,
                'price' => 120,
            ],
            [
                'work_order_id' => 2,
                'concept_id' => 3,
                'quantity' => 3,
                'price' => 22,
            ],
            [
                'work_order_id' => 2,
                'concept_id' => 3,
                'quantity' => 1,
                'price' => 220,
            ],
            [
                'work_order_id' => 3,
                'concept_id' => 4,
                'quantity' => 1,
                'price' => 644,
            ],
            [
                'work_order_id' => 3,
                'concept_id' => 2,
                'quantity' => 2,
                'price' => 440,
            ],
        ];

        DB::table('work_order_details')->insert($workOrderDetails);
    }
}
