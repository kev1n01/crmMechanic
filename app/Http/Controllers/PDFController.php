<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\WorkOrder;
use App\Models\workOrderDetail;
use PDF;

class PDFController extends Controller
{
    public function viewPF($id)
    {
        return view('pdf.pdf-pf', ['id' => $id]);
    }

    public function previewPF($id)
    {
        $workOrder = WorkOrder::where('id', $id)->first();
        $wod = workOrderDetail::where('work_order_id', $workOrder->id)->select('id', 'item', 'price', 'discount', 'quantity')->get();

        $dot = $wod->each(function ($item, $key) {
            if (strlen(strval($item->item)) < 4) {
                $item->item = Concept::where('code', str_pad($item->item, 3, "0", STR_PAD_LEFT))->select('name', 'code')->first();
            } else {
                $item->item = Product::where('code', strval($item->item))->select('name', 'code')->first();
            }
        });

        $pdf = PDF::loadView('pdf.templates.invoice-pf', [
            'wo' => $workOrder, 'dot' => $dot->sortBy('item.code')
        ]);
        return $pdf->setPaper('A4', 'portrait')
            ->stream();
    }

    public function downloadPF($id)
    {
        $workOrder = WorkOrder::where('id', $id)->first();
        $wod = workOrderDetail::where('work_order_id', $workOrder->id)->select('id', 'item', 'price', 'discount', 'quantity')->get();

        $dot = $wod->each(function ($item, $key) {
            if (strlen(strval($item->item)) < 4) {
                $item->item = Concept::where('code', str_pad($item->item, 3, "0", STR_PAD_LEFT))->select('name', 'code')->first();
            } else {
                $item->item = Product::where('code', strval($item->item))->select('name', 'code')->first();
            }
        });

        $pdf = PDF::loadView('pdf.templates.invoice-pf', [
            'wo' => $workOrder, 'dot' => $dot->sortBy('item.code')
        ]);
        return $pdf->download($workOrder->code . '/' . $workOrder->vehiclePlate->license_plate . '/' . $workOrder->customerUser->name . '.pdf');
    }

    public function viewSale($id)
    {
        return view('pdf.pdf-sale', ['id' => $id]);
    }

    public function previewSale($id)
    {
        $sale = Sale::where('id', $id)->first();
        $dts = SaleDetail::where('sale_id', $sale->id)->select('id', 'product_id', 'price', 'discount', 'quantity')->get();

        $ds = $dts->each(function ($item, $key) {
            $item->product_id = Product::where('id', $item->product_id)->select('name', 'code')->first();
        });

        $pdf = PDF::loadView('pdf.templates.invoice-sale', [
            'sale' => $sale, 'dts' => $ds->sortBy('product_id.code')
        ]);
        return $pdf->setPaper('A4', 'portrait')
            ->stream();
    }

    public function downloadSale($id)
    {
        $sale = Sale::where('id', $id)->first();
        $dts = SaleDetail::where('sale_id', $sale->id)->select('id', 'product_id', 'price', 'discount', 'quantity')->get();

        $ds = $dts->each(function ($item, $key) {
            $item->product_id = Product::where('id', strval($item->product_id))->select('name', 'code')->first();
        });

        // dd($ds->toArray());
        $pdf = PDF::loadView('pdf.templates.invoice-sale', [
            'sale' => $sale, 'dts' => $ds->sortBy('product_id.code')
        ]);
        return $pdf->download($sale->code_sale . '/' . $sale->customer->name . '.pdf');
    }

    public function viewPurchase($id)
    {
        return view('pdf.pdf-purchase', ['id' => $id]);
    }

    public function previewPurchase($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $dtp = PurchaseDetail::where('purchase_id', $purchase->id)->select('id', 'product_id', 'price', 'discount', 'quantity')->get();

        $ds = $dtp->each(function ($item, $key) {
            $item->product_id = Product::where('id', $item->product_id)->select('name', 'code')->first();
        });

        $pdf = PDF::loadView('pdf.templates.invoice-purchase', [
            'purchase' => $purchase, 'dtp' => $ds->sortBy('product_id.code')
        ]);
        return $pdf->setPaper('A4', 'portrait')
            ->stream();
    }

    public function downloadPurchase($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $dtp = PurchaseDetail::where('purchase_id', $purchase->id)->select('id', 'product_id', 'price', 'discount', 'quantity')->get();

        $ds = $dtp->each(function ($item, $key) {
            $item->product_id = Product::where('id', $item->product_id)->select('name', 'code')->first();
        });

        $pdf = PDF::loadView('pdf.templates.invoice-purchase', [
            'purchase' => $purchase, 'dtp' => $ds->sortBy('product_id.code')
        ]);
        return $pdf->download($purchase->code_purchase . '/' . $purchase->provider->name . '.pdf');
    }
}
