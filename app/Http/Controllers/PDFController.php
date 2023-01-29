<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleDetail;
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
        $wod_service = $workOrder->workOrderDetail()->get();
        $wod_replacement = SaleDetail::where('sale_id', $workOrder->sale)->get();;

        $pdf = PDF::loadView('invoice', [
            'wo' => $workOrder, 'wod_service' => $wod_service,
            'wod_replacement' => $wod_replacement
        ]);
        return $pdf->setPaper('A4', 'portrait')
            ->stream();
    }

    public function download($id)
    {
        $workOrder = WorkOrder::where('id', $id)->first();
        $wod_service = $workOrder->workOrderDetail()->get();
        $wod_replacement = SaleDetail::where('sale_id', $workOrder->sale)->get();;

        $pdf = PDF::loadView('invoice', [
            'wo' => $workOrder, 'wod_service' => $wod_service,
            'wod_replacement' => $wod_replacement
        ]);
        return $pdf->download($workOrder->code . '/' . $workOrder->vehiclePlate->license_plate . '/' . $workOrder->customerUser->name . '.pdf');
    }
}
