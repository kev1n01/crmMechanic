<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PROFORMA MECANICA FLOPAC</title>
    <link href="{{ public_path('assets/css/pdf.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="border-line">
        <div>
            <div style="float: left; width: 20%; height: 14%; margin-right: 4mm; margin-bottom: 4mm;">
                <img src="{{ public_path('assets/images/newlogo.png') }}" class="logo_img">
            </div>
            <div style="float: left; width: 50%; height: 14%; text-align: center   ">
                <p class="fw-b m-0">MECANICA AUTOMOTRIZ FLOPAC</p>
                <p class="fw-sb m-0">Sector Las Lomas - Chunapampa - Huanuco</p>
                <p class="fw-sb m-0">Cel: 957235173 / 978610524 / 933865935</p>
                <p class="fw-sb m-0">BBVA: 12312312324123</p>
                <p class="fw-sb m-0">BCP: 1231231312323</p>
                <p class="fw-sb m-0">INTERBANK: 1241241232312412</p>
            </div>
            <div style="float: left; width: 30%; height: 14%; text-align: center">

            </div>
        </div>

        <p class="fs-2 fw-b">Proforma de mantenimiento preventivo y correctivo</p>

        <p class="fs-3 fw-sb">Detalle del orden de trabajo</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Fecha/Hora de llegada</td>
                    <td class="border-td fw-sb" style="width: 26%;">
                        {{ \Carbon\Carbon::parse($wo->arrival_date)->format('d-m-Y') .
                            ' | ' .
                            \Carbon\Carbon::parse($wo->arrival_hour)->format('H:i') }}
                    </td>
                    <td class="border-td border-th fw-sb">Estado</td>
                    <td class="border-td fw-sb">{{ $wo->status }}</td>

                </tr>
                <tr>
                    <td class="border-td border-th ps-2 fw-sb">Fecha/Hora de salida</td>
                    <td class="border-td fw-sb">
                        {{ 
                            
                            $wo->departure_date != null ?
                            \Carbon\Carbon::parse($wo->departure_date)->format('d-m-Y') .
                            ' | ' .
                            \Carbon\Carbon::parse($wo->departure_hour)->format('H:i ') : 'Sigue en taller' }}
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

        <p class="fs-3 fw-sb">Informacion del cliente</p>
        <table class="table">
            <tbody>
                <tr>
                    <td class="border-td border-th fw-sb">Señor(a)</td>
                    <td class="border-td fw-sb" style="width: 50%;">{{ $wo->customerUser->name }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Dni</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->dni }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Estado</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->status }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Ruc</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->ruc }}</td>
                </tr>
                <tr>
                    <td class="border-td border-th fw-sb">Dirección</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->address }}</td>

                    <td class="border-td border-th ps-2 fw-sb">Telófono</td>
                    <td class="border-td fw-sb">{{ $wo->customerUser->phone }}</td>
                </tr>
            </tbody>
        </table>

        <p class="fs-3 fw-sb">Informacion del vehiculo {{ $wo->vehiclePlate->license_plate }}</p>

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

        <p class="fs-3 fw-sb">Lista de servicios y repuestoss</p>

        <table class="table-list">
            <thead>
                <tr>
                    <th colspan="4" class="fw-b">Repuestos</th>
                </tr>
                <tr>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wod_replacement as $k)
                    <tr>
                        <td class="fs-3 fw-sb">{{ $k->product->name }}</td>
                        <td class="fs-3 fw-sb">{{ $k->price }}</td>
                        <td class="fs-3 fw-sb">{{ $k->quantity }}</td>
                        <td class="fs-3 fw-sb">S/. {{ $k->price * $k->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <table class="table-list">
            <thead>
                <tr>
                    <th colspan="4" class="fw-b">Servicios</th>
                </tr>
                <tr>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wod_service as $w)
                    <tr>
                        <td class="fs-3 fw-sb">{{ $w->concept->name }}</td>
                        <td class="fs-3 fw-sb">{{ $w->price }}</td>
                        <td class="fs-3 fw-sb">{{ $w->quantity }}</td>
                        <td class="fs-3 fw-sb">S/. {{ $w->price * $w->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <th class="total">Total</th>
                    <th class="">S/.{{ $wo->total }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
