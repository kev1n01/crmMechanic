<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMPROBANTE {{ $comprobant->serie . '-' . $comprobant->correlativo }}</title>
    <link href="{{ public_path('assets/css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="border-line">
        <div class="infoHeader">
            <div style="float: left; width: 18%; height: 10%; margin-right: 1mm; margin-left: 2mm; margin-bottom: 1mm;">
                @if (!empty($company->logo))
                    <img src="{{ public_path('storage/' . $company->logo) }}" class="logo_img">
                @else
                    <img src="https://knowledgehub.adeanet.org/themes/adea/images/no-logo.jpg" class="logo_img">
                @endif
            </div>
            <div style="float: left; width: 50%; height: 10%; text-align: center; padding-top: 2%; margin-right: 2mm">
                <p class="fw-b m-0">{{ $company->name ?? 'SIN NOMBRE' }}</p>
                <p class="fw-sb m-0">{{ $company->address ?? '' }}</p>
                <p class="fw-sb m-0">Cel: {{ $company->phone ?? '' }}</p>
            </div>
            <div style="float: left; width: 32%; height: 10%;">
                <div style="border: 2px solid rgb(39, 39, 39); border-radius: 4px; width: 90%;">
                    <div class="text-center" style="padding:0%">
                        <p style="margin-bottom: 0%; font-size: 15px;"><strong>
                                {{ $comprobant->tipoDoc == '01' ? 'FACTURA' : 'BOLETA' }}
                                ELECTRÓNICA
                            </strong>
                        </p>
                        <p style="margin-bottom: 0%;"><strong>R.U.C. {{ $company->ruc ?? '' }}</strong></p>
                        <p><strong>{{ $comprobant->serie . '-' . $comprobant->correlativo }}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <p class="fs-3 fw-sb" style="margin-top:1%">.</p>
        <table class="table-info" style="width: 60%; margin-right: 1%">
            <tbody>
                <tr>
                    <td class="border-td fw-sb"><strong>Señor(a):</strong> </td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ strtolower($customer['rznSocial']) }}</td>
                    <td class="border-td fw-sb"><strong>Ruc:</strong> </td>
                    <td class="border-td fw-sb">{{ $customer['numDoc'] }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Dirección:</strong> </td>
                    <td colspan="3" class="border-td fw-sb">{{ $customer['address']['direccion'] }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table-info" style="width: 39%">
            <tbody>
                <tr>
                    <td class="border-th fw-sb"><strong>Fecha emisión:</strong> </td>
                    <td class="border-td fw-sb">
                        {{ \Carbon\Carbon::parse($comprobant->fechaEmision)->format('d-m-Y') .
                            ' ' .
                            \Carbon\Carbon::parse($comprobant->created_at)->format('g:i a') }}
                    </td>
                </tr>
                <tr>
                    <td class="border-th fw-sb"><strong>Tipo de pago:</strong> </td>
                    <td class="border-td fw-sb">
                        {{ $comprobant->tipoPago }}
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb" style="margin-top:5%"></p>

        <table class="table-list" style="margin-top:4%">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripcion</th>
                    <th>V. unitario</th>
                    <th>Cant</th>
                    <th>igv %</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td class="fs-3 fw-sb">{{ $item['codProducto'] }}</td>
                        <td class="fs-3 fw-sb text-wrap w-45">{{ $item['descripcion'] }}</td>
                        <td class="fs-3 fw-sb">{{ $item['mtoValorUnitario'] }}</td>
                        <td class="fs-3 fw-sb">{{ $item['cantidad'] }}</td>
                        <td class="fs-3 fw-sb">{{ $item['porcentajeIgv'] }} </td>
                        <td class="fs-3 fw-sb">
                            {{ number_format($item['mtoPrecioUnitario'] * $item['cantidad'], 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">
                            No hay servicios y productos agredados
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Ope. Gravadas</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($totalOG, 2) }}</td>
                </tr>
                <tr>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"> <strong>Son:</strong> {{ $value }}
                    </td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Ope. Exoneradas</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($totalOE, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>IGV 18%</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($totaligvgrav, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Total</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/
                        {{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <hr style="width: 97%; border: 0.1mm solid rgb(48, 48, 48);" />
    <div class="border-line">
        <div id="footer">
            <img src="data:image/png;base64, {!! $qrcode !!}" style="float: right; margin-right: 2%;">
            <p class="fw-sb" style="width: 75%;">
                <strong>Observaciones:</strong> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis
                necessitatibus, aliquam ipsam reprehenderit maxime vel eum, beatae non amet quis consequatur obcaecati
                sit et cupiditate repellendus omnis doloribus nulla saepe.
            </p>
            <table class="table-list" style="width: 55%;">
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
            <table class="table-list" style="float: left; width: 75%; margin-top: 2%">
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
