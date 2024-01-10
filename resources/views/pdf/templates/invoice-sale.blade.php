<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VENTA {{ $company->name ?? '' }}</title>
    <link href="{{ public_path('assets/css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="border-line">
        <div class="infoHeader">
            <div style="float: left; width: 20%; height: 10%; margin-right: 2mm; margin-left: 4mm; margin-bottom: 2mm;">
                @if (!empty($company->logo))
                    <img src="{{ public_path('storage/' . $company->logo) }}" class="logo_img">
                @else
                    <img src="https://knowledgehub.adeanet.org/themes/adea/images/no-logo.jpg" class="logo_img">
                @endif
            </div>
            <div style="float: left; width: 50%; height: 10%; text-align: center; padding-top: 2%;">
                <p class="fw-b m-0">{{ $company->name ?? 'SIN NOMBRE EMPRESA' }}</p>
                <p class="fw-sb m-0">{{ $company->address ?? '' }}</p>
                <p class="fw-sb m-0">Cel: {{ $company->phone ?? '' }}</p>
            </div>
            <div style="float: left; width: 30%; height: 10%;">
                <div style="border: 2px solid rgb(39, 39, 39); border-radius: 4px; width: 90%;">
                    <div class="text-center" style="padding: 1%">
                        <p style="margin-bottom: 0%;">R.U.C. N° {{ $company->ruc ?? '' }}</p>
                        <p style="margin-bottom: 0%;">VENTA</p>
                        <p>{{ $sale->code_sale }}</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="fs-2 fw-sb text-form" style="margin-bottom: 1%; margin-top: 2%">
            {{ $sale->type_sale === 'vehicular' ? 'Venta Vehicular' : 'Venta Comercial' }}</p>
        <table class="table-info" style="width: 60%; margin-right: 1%; height: 9%">
            <tbody>
                <tr>
                    <td class="border-td fw-sb"><strong>Señor(a):</strong> </td>
                    <td class="border-td fw-sb" style="width: 70%;">{{ strtolower($sale->customer->name) }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Celular:</strong> </td>
                    <td class="border-td fw-sb">{{ $sale->customer->phone }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Dni:</strong> </td>
                    <td class="border-td fw-sb">{{ $sale->customer->dni }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Ruc:</strong> </td>
                    <td class="border-td fw-sb">{{ $sale->customer->ruc }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Dirección:</strong> </td>
                    <td colspan="3" class="border-td fw-sb">{{ $sale->customer->address }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table-info" style="width: 39%">
            <tbody>
                <tr>
                    <td class="border-td fw-sb"><strong>Fecha y Hora:</strong></td>
                    <td class="border-td fw-sb" style="width: 60%;">
                        {{ \Carbon\Carbon::parse($sale->date_sale)->format('d-m-Y') .
                            ' , ' .
                            \Carbon\Carbon::parse($sale->created_at)->format('g:i a') }}
                    </td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Estado:</strong></td>
                    <td class="border-td fw-sb">{{ $sale->status }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Tipo de pago:</strong></td>
                    <td class="border-td fw-sb">
                        {{ $sale->type_payment }}
                    </td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Metodo de pago:</strong></td>
                    <td class="border-td fw-sb">{{ $sale->method_payment }}</td>
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb" style="margin-top:15%"></p>
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
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Subtotal</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($totalNoDiscount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Descuento</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/
                        {{ number_format($totalNoDiscount - $sale->total, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Total</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($sale->total, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Pagó con</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($sale->cash, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Vuelto</strong>
                    </td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/
                        {{ number_format($sale->cash - $sale->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <hr style="width: 97%; border: 0.1mm solid rgb(48, 48, 48);" />
    <div class="border-line">
        <div id="footer">
            <p class="fw-sb" style="width: 100%;">
                <strong>Observaciones:</strong> {{ $sale->observation }}
            </p>
            <table class="table-list" style="width: 100%;">
                <thead>
                    <tr>
                        <th>NRO CUOTA </th>
                        <th>FECHA</th>
                        <th>MONTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-sb fs-3 text-center">cuota1</td>
                        <td class="fw-sb fs-3 text-center">14/6/2023</td>
                        <td class="fw-sb fs-3 text-center">942.22</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-list" style="float: left; width: 100%; margin-top: 2%">
                <thead>
                    <tr>
                        <th>ENTIDAD FINANCIERA </th>
                        <th>CUENTA BANCARIA </th>
                        <th>CUENTA INTERBANCARIA </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bankacc as $bc)
                        <tr>
                            <td class="fw-sb fs-3 text-center">{{ $bc->name }}</td>
                            <td class="fw-sb fs-3 text-center">{{ $bc->cta_bank }}</td>
                            <td class="fw-sb fs-3 text-center">{{ $bc->cta_interbank }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="fw-sb text-center" colspan="3">No hay cuentas de bancos
                                registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top: 15%">
            <span class="text-footer fw-sb">
                <strong>Atención:</strong> Todo trabajo se realizará con un 50% de adelanto al costo de
                proforma, una vez terminado el trabajo tendrá 7 días hábiles a recoger su vehículo, luego de esto se
                sumarán costos de cochera
            </span>
            <p class="text-footer fw-sb">
                En caso de emergencias contactanos que estamos para ayudarlo, profesionalismo y servicio de calidad a
                todos nuestros clientes
            </p>
        </div>
    </div>

</body>

</html>
