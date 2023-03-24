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
                <p class="fw-b m-0">MECANICA AUTOMOTRIZ FLOPAC</p>
                <p class="fw-sb m-0">Sector Las Lomas - Chunapampa - Huanuco</p>
                <p class="fw-sb m-0">Cel: 957235173 / 978610524 / 933865935</p>
            </div>
            <div style="float: left; width: 30%; height: 10%;">
                <div style="border: 2px solid rgb(39, 39, 39); border-radius: 4px; width: 90%;">
                    <div class="text-center" style="padding: 1%">
                        <p style="margin-bottom: 0%;">R.U.C. N° 20232424231</p>
                        <p style="margin-bottom: 0%;"> {{ $wo->is_confirmed === 0 ? 'PROFORMA' : 'ORDEN TRABAJO' }}</p>
                        <p >{{ $wo->code }}</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="fs-2 fw-b text-form">
            {{ $wo->is_confirmed === 0 ? 'Proforma de mantenimiento' : 'Orden de trabajo' }}
            - {{ $wo->type_atention }}</p>
        @if ($wo->is_confirmed == 1)
            <p class="fs-3 fw-sb">Detalle del orden de trabajo</p>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="border-td border-th fw-sb">Fecha/Hora de llegada</td>
                        <td class="border-td fw-sb" style="width: 26%;">
                            {{ $wo->arrival_date != null
                                ? \Carbon\Carbon::parse($wo->arrival_date)->format('d-m-Y') .
                                    ' , ' .
                                    \Carbon\Carbon::parse($wo->arrival_hour)->format('g:i a')
                                : 'No especificado' }}
                        </td>
                        <td class="border-td border-th fw-sb">Estado</td>
                        <td class="border-td fw-sb">{{ $wo->is_confirmed == 1 ? $wo->status : $wo->confirmation_name }}
                        </td>

                    </tr>
                    <tr>
                        <td class="border-td border-th ps-2 fw-sb">Fecha/Hora de salida</td>
                        <td class="border-td fw-sb">
                            {{ $wo->departure_date != null
                                ? \Carbon\Carbon::parse($wo->departure_date)->format('d-m-Y') .
                                    ' , ' .
                                    \Carbon\Carbon::parse($wo->departure_hour)->format('g:i a ')
                                : 'No especificado' }}
                        </td>
                        <td class="border-td border-th ps-2 fw-sb">Código</td>
                        <td class="border-td fw-sb">{{ $wo->code }}</td>
                    </tr>
                    <tr>
                        <td class="border-td border-th ps-2 fw-sb">Observaciones</td>
                        <td class="border-td fw-sb" colspan="3">{{ $wo->observation ?? 'Ninguno' }}</td>
                    </tr>

                </tbody>
            </table>
        @else
            <p class="fs-3 fw-sb">Detalle de la proforma </p>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="border-td border-th ps-2 fw-sb">Código</td>
                        <td class="border-td fw-sb">{{ $wo->code }}</td>
                        <td class="border-td border-th fw-sb">Estado</td>
                        <td class="border-td fw-sb">{{ $wo->is_confirmed == 1 ? $wo->status : $wo->confirmation_name }}
                        </td>
                        <td class="border-td border-th fw-sb">Fecha/Hora</td>
                        <td class="border-td fw-sb">
                            {{ \Carbon\Carbon::parse($wo->created_at)->format('d-m-Y') .
                                ' , ' .
                                \Carbon\Carbon::parse($wo->created_at)->format('g:i a ') }}
                        </td>

                    </tr>
                    <tr>
                        <td class="border-td border-th ps-2 fw-sb">Observaciones</td>
                        <td class="border-td fw-sb" colspan="5">{{ $wo->observation ?? 'Ninguno' }}</td>
                    </tr>
                </tbody>
            </table>
        @endif


        <p class="fs-3 fw-sb">Informacion del cliente</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Señor(a)</td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ $wo->customerUser->name }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Telófono</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->phone }}</td>
                </tr>
                <tr>

                    <td class="border-td border-th ps-2 fw-sb">Dni</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->dni }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Ruc</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->ruc }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Dirección</td>
                    <td colspan="3" class="border-td fw-sb">{{ $wo->customerUser->address }}</td>
                
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb">Informacion del vehiculo con placa <span
                class="fw-b">{{ $wo->vehiclePlate->license_plate }}</span></p>

        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb" style="width: 15%;">Marca</td>
                    <td class="border-td fw-sb" style="width: 20%;">{{ $wo->vehiclePlate->brand->name }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Color</td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->color->name }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Tipo</td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->type->name }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th ps-1 fw-sb" style="width: 15%;">Modelo</td>
                    <td class="border-td fw-sb" style="width: 20%;">{{ $wo->vehiclePlate->model->name }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Año</td>
                    <td class="border-td fw-sb">{{ $wo->vehiclePlate->model_year }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Kilometraje</td>
                    <td class="border-td fw-sb">{{ $wo->odo }}</td>
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb">Lista de servicios y repuestos</p>

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
                    <td class="fw-sb">S/ {{ number_format($totalNoDiscount - $wo->total, 2) }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="2"></td>
                    <td class="fw-sb" colspan="3">Total IGV 18%</td>
                    <td class="fw-sb">S/ {{ number_format($wo->total - $totalOG, 2) }}</td>
                </tr> --}}
                <tr>
                    <td colspan="2"></td>
                    <td class="text-black fw-sb"colspan="3">TOTAL</td>
                    <td class="fw-sb">S/ {{ number_format($wo->total, 2) }}</td>
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
