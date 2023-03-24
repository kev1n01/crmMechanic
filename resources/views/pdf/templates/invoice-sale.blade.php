<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VENTA MECANICA FLOPACH</title>
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
                        <p style="margin-bottom: 0%;">R.U.C. N° 2023242423</p>
                        <p style="margin-bottom: 0%;">VENTA</p>
                        <p>{{ $sale->code_sale }}</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="fs-2 fw-b text-form">
            {{ $sale->type_sale === 'vehicular' ? 'Venta Vehicular' : 'Venta Comercial' }}</p>

        <p class="fs-3 fw-sb">Detalle de la venta</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Fecha y Hora</td>
                    <td class="border-td fw-sb" style="width: 26%;">
                        {{ \Carbon\Carbon::parse($sale->date_sale)->format('d-m-Y') .
                            ' , ' .
                            \Carbon\Carbon::parse($sale->created_at)->format('g:i a') }}
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

                    <td class="border-td border-th ps-2 fw-sb">Telófono</td>
                    <td class="border-td fw-sb">{{ $sale->customer->phone }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Dni</td>
                    <td class="border-td fw-sb">{{ $sale->customer->dni }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Ruc</td>
                    <td class="border-td fw-sb">{{ $sale->customer->ruc }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Dirección</td>
                    <td colspan="3" class="border-td fw-sb">{{ $sale->customer->address }}</td>
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
                {{-- <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total Ope. Gravadas</td>
                    <td class="fw-sb">S/ {{ number_format($totalOG, 2) }}</td>
                </tr> --}}
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total Descuentos</td>
                    <td class="fw-sb">S/ {{ number_format($totalNoDiscount - $sale->total, 2) }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total IGV 18%</td>
                    <td class="fw-sb">S/ {{ number_format($sale->total - $totalOG, 2) }}</td>
                </tr> --}}
                <tr>
                    <td colspan="2"></td>
                    <td class="text-black fw-sb"colspan="3">TOTAL</td>
                    <td class="fw-sb">S/ {{ number_format($sale->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div id="footer">
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb text-center">ENTIDAD FINANCIERA </td>
                    <td class="border-td border-th fw-sb text-center">CUENTA BANCARIA </td>
                    <td class="border-td border-th fw-sb text-center">CUENTA INTERBANCARIA </td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb text-center">BCP </td>
                    <td class="border-td border-th fw-sb text-center">CTA. Soles: 12421242236543</td>
                    <td class="border-td border-th fw-sb text-center">1242124223654312 </td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb text-center">BBVA </td>
                    <td class="border-td border-th fw-sb text-center">CTA. Soles: 12421242236543</td>
                    <td class="border-td border-th fw-sb text-center">1242124223654312 </td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb text-center">Interbank </td>
                    <td class="border-td border-th fw-sb text-center">CTA. Soles: 12421242236543</td>
                    <td class="border-td border-th fw-sb text-center">1242124223654312 </td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb text-center">La Nacion </td>
                    <td class="border-td border-th fw-sb text-center">CTA. Soles: 12421242236543</td>
                    <td class="border-td border-th fw-sb text-center">1242124223654312 </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
