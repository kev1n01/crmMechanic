<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT MECANICA FLOPACH</title>
    <link href="{{ public_path('assets/css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="border-line">
        <div class="infoHeader">
            <div style="float: left; width: 20%; height: 10%; margin-right: 2mm; margin-left: 4mm; margin-bottom: 2mm;">
                <img src="{{ public_path('assets/images/newlogo.png') }}" class="logo_img">
            </div>
            <div style="float: left; width: 50%; height: 10%; text-align: center; padding-top: 2%;">
                <p class="fw-b m-0">MECANICA AUTOMOTRIZ FLOPACH</p>
                <p class="fw-sb m-0">Sector Las Lomas - Chunapampa - Huanuco</p>
                <p class="fw-sb m-0">Cel: 957235173 / 978610524 / 933865935</p>
            </div>
            <div style="float: left; width: 30%; height: 10%;">
                <div style="border: 2px solid rgb(39, 39, 39); border-radius: 4px; width: 90%;">
                    <div class="text-center" style="padding: 1%">
                        <p style="margin-bottom: 0%;">RUC N 2023242423</p>
                        <p style="margin-bottom: 0%;">{{ strtoupper($purchase->type_cpe) }} ELECTRONICA</p>
                        <p>{{ $purchase->nro_cpe }}</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="fs-2 fw-b text-form">Compra {{ $purchase->code_purchase }}</p>

        <p class="fs-3 fw-sb">Detalle de la compra</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Fecha/Hora</td>
                    <td class="border-td fw-sb" style="width: 26%;">
                        {{ \Carbon\Carbon::parse($purchase->date_purchase)->format('d-m-Y') .
                            ' | ' .
                            \Carbon\Carbon::parse($purchase->created_at)->format('H:i') }}
                    </td>
                    <td class="border-td border-th ps-2 fw-sb">Estado</td>
                    <td class="border-td fw-sb">{{ $purchase->status }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Tipo de pago</td>
                    <td class="border-td fw-sb">
                        {{ $purchase->type_cpe }}
                    </td>
                    <td class="border-td border-th ps-2 fw-sb">Nro de CPE</td>
                    <td class="border-td fw-sb">{{ $purchase->nro_cpe }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Metodo de pago</td>
                    <td class="border-td fw-sb">{{ $purchase->method_payment }}</td>
                    <td class="border-td border-th ps-2 fw-sb">Código</td>
                    <td class="border-td fw-sb">{{ $purchase->code_purchase }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Observaciones</td>
                    <td class="border-td fw-sb" colspan="3">{{ $purchase->observation ?? 'Ninguno' }}</td>
                </tr>

            </tbody>
        </table>

        <p class="fs-3 fw-sb">Informacion del proveedor</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Señor(a)</td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ $purchase->provider->name }}</td>
                    <td class="border-td border-th ps-2 fw-sb">Telófono</td>
                    <td class="border-td fw-sb">{{ $purchase->provider->phone }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Estado</td>
                    <td class="border-td fw-sb">{{ $purchase->provider->status }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Ruc</td>
                    <td class="border-td fw-sb">{{ $purchase->provider->ruc }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Dirección</td>
                    <td class="border-td fw-sb" colspan="3">{{ $purchase->provider->address }}</td>
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb">Lista de repuestos y/o productos</p>

        <table class="table-list">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>P. unitario</th>
                    <th>Cant</th>
                    <th>Dto.</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dtp as $w)
                    <tr>
                        <td class="fs-3 fw-sb">{{ $w->product_id->code }}</td>
                        <td class="fs-3 fw-sb text-wrap w-45">{{ $w->product_id->name }}</td>
                        <td class="fs-3 fw-sb">{{ $w->price }}</td>
                        <td class="fs-3 fw-sb">{{ $w->quantity }}</td>
                        <td class="fs-3 fw-sb">{{ $w->discount }} </td>
                        <td class="fs-3 fw-sb">
                            {{ number_format($w->price * $w->quantity - $w->quantity * $w->price * ($w->discount / 100), 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">
                            No hay servicios agregados
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                @php
                    $totalNoDiscount = 0;
                    $totalOG = 0;
                    foreach ($dtp as $c) {
                        $totalNoDiscount += $c->price * $c->quantity;
                    }
                    $totalOG = $purchase->total / 1.18;
                @endphp
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Subtotal</td>
                    <td class="fw-sb">S/ {{ number_format($totalNoDiscount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total Ope. Gravadas</td>
                    <td class="fw-sb">S/ {{ number_format($totalOG, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total Descuentos</td>
                    <td class="fw-sb">S/ {{ number_format($totalNoDiscount - $purchase->total, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total IGV 18%</td>
                    <td class="fw-sb">S/ {{ number_format($purchase->total - $totalOG, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-black fw-sb"colspan="3">TOTAL</td>
                    <td class="fw-sb">S/ {{ number_format($purchase->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
