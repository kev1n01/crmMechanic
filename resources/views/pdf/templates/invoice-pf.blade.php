<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden de trabajo - {{ $wo->code ?? '' }}</title>
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
                        <p style="margin-bottom: 0%;"> {{ $wo->is_confirmed === 0 ? 'PROFORMA' : 'ORDEN TRABAJO' }}</p>
                        <p>{{ $wo->code }}</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="fs-2 fw-sb text-form" style="margin-bottom: 1%; margin-top: 2%">
            {{ $wo->is_confirmed === 0 ? 'Proforma de mantenimiento' : 'Orden de trabajo' }}
            - {{ $wo->type_atention }}</p>
        <table class="table-info" style="width: 65%; margin-right: 1%; height: 12%;">
            <tbody>
                <tr>
                    <td class="border-td fw-sb"><strong>Señor(a):</strong></td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ $wo->customerUser->name }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Celular:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->phone }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>N° documento:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->num_doc }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Dirección:</strong></td>
                    <td colspan="3" class="border-td fw-sb">{{ $wo->customerUser->address }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table-info" style="width: 34%; margin-right: 1%">
            <tbody>
                <tr>
                    <td class="border-td fw-sb"><strong>Marca:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->brand->name }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Color:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->color->name }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Tipo:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->type->name }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Modelo:</strong></td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ $wo->vehiclePlate->model->name }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Año:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->model_year }}</td>
                </tr>
                <tr>
                    <td class="border-td fw-sb"><strong>Kilometraje:</strong></td>
                    <td class="border-td fw-sb">{{ $wo->odo }}</td>
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb" style="margin-top:18%"> </p>
        @if ($wo->is_confirmed == 1)
            <table class="table-info" style="width: 100%">
                <tbody>
                    <tr>
                        <td class="border-td fw-sb"><strong>Fecha/Hora de llegada:</strong></td>
                        <td class="border-td fw-sb" style="width: 30%;">
                            {{ $wo->arrival_date != null
                                ? \Carbon\Carbon::parse($wo->arrival_date)->format('d-m-Y') .
                                    ' , ' .
                                    \Carbon\Carbon::parse($wo->arrival_hour)->format('g:i a')
                                : 'No especificado' }}
                        </td>
                        <td class="border-td fw-sb"><strong>Estado:</strong></td>
                        <td class="border-td fw-sb">{{ $wo->is_confirmed == 1 ? $wo->status : $wo->confirmation_name }}
                        </td>

                    </tr>
                    <tr>
                        <td class="border-td fw-sb"><strong>Fecha/Hora de salida:</strong></td>
                        <td class="border-td fw-sb">
                            {{ $wo->departure_date != null
                                ? \Carbon\Carbon::parse($wo->departure_date)->format('d-m-Y') .
                                    ' , ' .
                                    \Carbon\Carbon::parse($wo->departure_hour)->format('g:i a ')
                                : 'No especificado' }}
                        </td>
                        <td class="border-td fw-sb"><strong>Placa:</strong></td>
                        <td class="border-td fw-sb">{{ $wo->vehiclePlate->license_plate }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <table class="table-info" style="width: 100%">
                <tbody>
                    <tr>
                        <td class="border-td fw-sb"><strong>Fecha/Hora:</strong></td>
                        <td class="border-td fw-sb">
                            {{ \Carbon\Carbon::parse($wo->created_at)->format('d-m-Y') .
                                ' , ' .
                                \Carbon\Carbon::parse($wo->created_at)->format('g:i a ') }}
                        </td>
                        <td class="border-td fw-sb"><strong>Placa:</strong></td>
                        <td class="border-td fw-sb">{{ $wo->vehiclePlate->license_plate }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border-td fw-sb"><strong>Estado:</strong></td>
                        <td class="border-td fw-sb">{{ $wo->is_confirmed == 1 ? $wo->status : $wo->confirmation_name }}
                        </td>
                    </tr>
            </table>
        @endif

        <table class="table-list" style="margin-top:9%">
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
                @forelse ($dot as $w)
                    <tr>
                        <td class="fs-3 fw-sb">{{ $w->item->code }}</td>
                        <td class="fs-3 fw-sb text-wrap w-45">{{ $w->item->name }}</td>
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
                            No hay servicios o repuestos registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                @php
                    $totalNoDiscount = 0;
                    $totalOG = 0;
                    foreach ($dot as $c) {
                        $totalNoDiscount += $c->price * $c->quantity;
                    }
                    $totalOG = $wo->total / 1.18;
                @endphp
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Subtotal</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($totalNoDiscount, 2) }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="2">Total Ope. Gravadas</td>
                    <td class="fw-sb">S/ {{ number_format($totalOG, 2) }}</td>
                </tr> --}}
                <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb fs-3 text-wrap w-45" colspan="2"><strong>Descuento</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($totalNoDiscount - $wo->total, 2) }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="2">Total IGV 18%</td>
                    <td class="fw-sb">S/ {{ number_format($wo->total - $totalOG, 2) }}</td>
                </tr> --}}
                <tr>
                    <td colspan="2"></td>
                    <td class="text-black fw-sb  fs-3 text-wrap w-45"colspan="2"><strong>Total</strong></td>
                    <td class="fw-sb fs-3 td_underline" colspan="2">S/ {{ number_format($wo->total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr style="width: 97%; border: 0.1mm solid rgb(48, 48, 48);" />
    <div class="border-line">
        <div id="footer">
            <p class="fw-sb" style="width: 100%;">
                <strong>Observaciones:</strong> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis
                necessitatibus, aliquam ipsam reprehenderit maxime vel eum, beatae non amet quis consequatur obcaecati
                sit et cupiditate repellendus omnis doloribus nulla saepe.
            </p>
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
    </div>

</body>

</html>
