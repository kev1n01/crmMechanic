<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function view($id)
    {
        return view('pdf.pdf', ['id' => $id]);
    }
    
    public function preview($id)
    {
        $workOrder = WorkOrder::where('id', $id)->first();
        $wod = $workOrder->workOrderDetail()->get();
        // dd($wod);
        $pdf = PDF::loadView('invoice', ['wo' => $workOrder, 'wod' => $wod]);
        return $pdf->setPaper('a4', 'portrait')
            ->stream();
    }

    public function download($id)
    {
        $workOrder = WorkOrder::where('id', $id)->first();
        $wod = $workOrder->workOrderDetail()->get();
        $pdf = PDF::loadView('invoice', ['wo' => $workOrder, 'wod' => $wod]);
        return $pdf->download($workOrder->code . '/' . $workOrder->vehiclePlate->license_plate . '/' . $workOrder->customerUser->name . '.pdf');
    }
}
