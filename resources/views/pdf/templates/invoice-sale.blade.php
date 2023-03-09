<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OT MECANICA FLOPAC</title>
    <link href="{{ public_path('assets/css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="border-line">
        <div class="infoHeader">
            <div style="float: left; width: 20%; height: 14%; margin-right: 4mm; margin-bottom: 4mm;">
                <img src="{{ public_path('assets/images/newlogo.png') }}" class="logo_img">
            </div>
            <div style="float: left; width: 50%; height: 14%; text-align: center;">
                <p class="fw-b m-0">MECANICA AUTOMOTRIZ FLOPAC</p>
                <p class="fw-sb m-0">Sector Las Lomas - Chunapampa - Huanuco</p>
                <p class="fw-sb m-0">Cel: 957235173 / 978610524 / 933865935</p>
                <p class="fw-sb m-0">BBVA: 12312312324123</p>
                <p class="fw-sb m-0">BCP: 1231231312323</p>
                <p class="fw-sb m-0">INTERBANK: 1241241232312412</p>
            </div>
            <div style="float: left; width: 30%; height: 14%; text-align: center;">

            </div>
        </div>

        <p class="fs-2 fw-b text-form">Venta {{ $sale->type_sale }}</p>

        <p class="fs-3 fw-sb">Detalle de la venta</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Fecha/Hora de llegada</td>
                    <td class="border-td fw-sb" style="width: 26%;">
                        {{ \Carbon\Carbon::parse($sale->date_sale)->format('d-m-Y') .
                            ' | ' .
                            \Carbon\Carbon::parse($sale->created_at)->format('H:i') }}
                    </td>
                    <td class="border-td border-th fw-sb">Estado</td>
                    <td class="border-td fw-sb">{{ $sale->status }}</td>

                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Tipo de pago</td>
                    <td class="border-td fw-sb">
                        {{ $sale->type_payment }}
                    </td>
                    <td class="border-td border-th ps-2 fw-sb">Metodo de pago</td>
                    <td class="border-td fw-sb">{{ $sale->method_payment }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Tipo de venta</td>
                    <td class="border-td fw-sb">
                        {{ $sale->type_sale }}
                    </td>
                    <td class="border-td border-th ps-2 fw-sb">Código</td>
                    <td class="border-td fw-sb">{{ $sale->code_sale }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Observaciones</td>
                    <td class="border-td fw-sb" colspan="3">{{ $sale->observation ?? 'Ninguno' }}</td>
                </tr>

            </tbody>
        </table>

        <p class="fs-3 fw-sb">Informacion del cliente</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Señor(a)</td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ $sale->customer->name }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Dni</td>
                    <td class="border-td fw-sb">{{ $sale->customer->dni }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Estado</td>
                    <td class="border-td fw-sb">{{ $sale->customer->status }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Ruc</td>
                    <td class="border-td fw-sb">{{ $sale->customer->ruc }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Dirección</td>
                    <td class="border-td fw-sb">{{ $sale->customer->address }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Telófono</td>
                    <td class="border-td fw-sb">{{ $sale->customer->phone }}</td>
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
                @forelse ($dts as $w)
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
                    foreach ($dts as $c) {
                        $totalNoDiscount += $c->price * $c->quantity;
                    }
                    $totalOG = $sale->total / 1.18;
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
                    <td class="fw-sb">S/ {{ number_format($totalNoDiscount - $sale->total, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total IGV 18%</td>
                    <td class="fw-sb">S/ {{ number_format($sale->total - $totalOG, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-black fw-sb"colspan="3">TOTAL</td>
                    <td class="fw-sb">S/ {{ number_format($sale->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div id="footer">
        <p class="text-footer">
            En caso de emergencias contactanos que estamos para ayudarlo, profesionalismo y servicio de calidad a
            todos nuestros clientes
        </p>
        <p class="text-footer">
            <span class="fw-b">ATENCION:</span> Todo trabajo se realizará con un 50% de adelanto al costo de
            proforma,
            y tendrá 7 días hábiles a recoger su vehículo, luego de esto se sumarán costos de una cochera
        </p>
    </div>

</body>

</html>
