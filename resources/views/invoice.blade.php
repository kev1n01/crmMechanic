{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $wo->code.'/'.$wo->vehiclePlate->license_plate.'/'.$wo->customerUser->name }}</title>
</head>

<body>
    <p>{{ $wo->code }}</p>
    <p>{{ $wo->odo }}</p>
    <p>{{ $wo->customerUser->name }}</p>
    <p>{{ $wo->vehiclePlate->license_plate }}</p>

    <table>
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Precio U</th>
                <th>Cantidad</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wod as $wodr)
                <tr>
                    <td>{{ $wodr->concept->name }}</td>
                    <td>{{ $wodr->price }}</td>
                    <td>{{ $wodr->quantity }}</td>
                    <td>{{ $wodr->quantity * $wodr->price }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td>TOTAL</td>
                <td>S/ {{ number_format($wo->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $wo->code . '/' . $wo->vehiclePlate->license_plate . '/' . $wo->customerUser->name }}</title>
</head>

<head>
    <meta charset="utf-8">
    <title>Proforma repuestos</title>
    <style>
        /* reset */

        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        /* content editable */

        *[contenteditable] {
            border-radius: 0.25em;
            min-width: 1em;
            outline: 0;
        }

        *[contenteditable] {
            /* cursor: pointer; */
        }

        *[contenteditable]:hover,
        *[contenteditable]:focus,
        td:hover *[contenteditable],
        td:focus *[contenteditable],
        img.hover {
            background: rgb(255, 255, 255);
            box-shadow: 0 0 1em 0.5em rgb(255, 255, 255);
        }

        span[contenteditable] {
            display: inline-block;
        }

        /* heading */

        /* button */
        .invoice-action a {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 10px;
            font-size: 12px;
            float: right;
            border-radius: 10px;
            margin: 0px 6px 6px 0px;
            cursor: pointer;
        }

        .invoice-action svg {
            cursor: pointer;
            font-weight: 600;
            border-radius: 10px;
            margin: 0px 6px 6px 0px;
            fill: rgba(0, 23, 55, 0.08);
            float: right;
            color: #fff;
            background: rgb(30, 109, 212);
            padding: 3px;
        }


        svg {
            display: hidden;
        }

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: rgb(255, 255, 255);
            border-color: rgb(255, 255, 255);
        }

        td {
            border-color: #DDD;
        }

        .inventory th {
            background: rgb(182, 182, 182);
            border-color: rgb(255, 255, 255);
        }



        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
        }

        body {
            box-sizing: border-box;
            height: 29.7cm;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 21cm;
        }

        body {
            background: #FFF;
            border-radius: 1px;
        }

        /* header */

        header {
            margin: 0 0 0 0;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
        }


        header address table {
            font-size: 90% !important;
        }

        header address p {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 20px;
            margin: 10px 0px 3px 0px;
        }

        header span,
        header img {
            display: block;
            float: left;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        .bold {
            font-weight: bold;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */
        header table {
            margin: 0 0 0 0 !important;
        }

        .info-general h5 {
            text-align: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .info-general p {
            font-size: 80%;
            font-weight: bold;
        }

        .inputs-cliente {
            display: flex;

        }

        table.meta {
            margin: 0 0 3em;
        }

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article p {
            font-size: 80%;
            font-weight: bold;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;

        }

        /* footer */


        .footer {
            position: absolute;
            top: 90%;
            display: none;
        }

        /* javascript */

        .add,
        .cut,
        .add-job {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut,
        .add-job {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add,
        .add-job {
            margin: -2.5em 0 0;
        }

        .add:hover,
        add-job:hover {
            background: #00ADEE;
        }

        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        tr:hover .cut {
            opacity: 1;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            .footer {
                position: absolute;
                top: 98%;
                display: block;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut,
            .invoice-action,
            .add-job {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <span><img width="100px" src=""><input type="file" accept="image/*"></span>
        <address contenteditable>
            <span class="info">
                <p class="bold">HERMANOS FLORES S.A.</p>
                <p class="bold">SECTOR LAS LOMAS - CHUNAPAMPA - HUÁNUCO</p>
                <p class="bold">Gerencia: 957235173 </p>
                <p class="bold">Oficina: 978610524 - 933865935</p>
            </span>

        </address>

        <table class="meta">
            <div class="invoice invoice-action">
                <a class="enlace enlace-proforma" href="index_obra.html">Mano de obra</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-printer action-print" data-toggle="tooltip" data-placement="top"
                    data-original-title="Reply">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
            </div>
            <tr>
                <th style=" float:right"><span>N°</span></th>
                <td style=" width: 40%; "><span contenteditable> </span></td>
            </tr>
            <tr>
                <th style="float:right"><span>Fecha</span></th>
                <td style=" width: 40%; "><span contenteditable> </span></td>
            </tr>
            <tr style="display: none;">
                <th><span>Monto </span></th>
                <td><span id="prefix" contenteditable>S/. </span><span>600.00</span></td>
            </tr>
        </table>

    </header>

    <div class="info-general">
        <h5>Proforma de Mantenimiento</h5>
        <div class="info-cliente">
            <p>1. Información del cliente</p>
            <div class="inputs-cliente">
                <table>
                    <tr>
                        <th "><span>Señor(a)</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>Razón Social</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>Dirección</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <th><span>DNI</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>RUC</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>Teléfono</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="info-vehiculo">
            <p>2. Información del Vehiculo</p>
            <div class="inputs-cliente">
                <table style="margin: 7px;">
                    <tr>
                        <th style=" width: 70px;"><span>Marca</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>Modelo</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>

                </table>
                <table style="margin: 7px;  max-width: 30%;">
                    <tr>
                        <th style=" width: 50px;"><span>Color</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>Placa</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>

                </table>
                <table style="margin: 7px;  max-width: 30%;">
                    <tr>
                        <th style=" width: 50px;"><span>Año</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>
                    <tr>
                        <th><span>ODO</span></th>
                        <td><span contenteditable> </span></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

    <article>
        <p>3. Lista de articulos y repuestos</p><br>
        <table class="inventory">
            <thead>
                <tr>
                    <th style=" width: 10%;"><span>CÓDIGO</span></th>
                    <th><span>DESCRIPCIÓN</span></th>
                    <th style=" width: 10%;"><span>V.UNITARIO</span></th>
                    <th style=" width: 10%;"><span>CANTIDAD</span></th>
                    <th style=" width: 10%;"><span>V.TOTAL</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a class="cut">-</a><span contenteditable> </span></td>
                    <td><span contenteditable> </span></td>
                    <td><span data-prefix> </span><span contenteditable> </span></td>
                    <td><span contenteditable> </span></td>
                    <td><span data-prefix>S/ </span><span>600.00</span></td>
                </tr>

            </tbody>
        </table>
        <a class="add">+</a>
        <table class="balance">
            <tr>
                <th style="float: right;"><span>Sub Total</span></th>
                <td style="width:40%;"><span data-prefix>S/ </span><span>600.00</span></td>
            </tr>
            <tr>
                <th style="float: right;"><span>Descuento</span></th>
                <td><span data-prefix>S/ </span><span contenteditable> </span></td>
            </tr>
            <tr>
                <th style="float: right;"><span>Total</span></th>
                <td><span data-prefix>S/ </span><span>600.00</span></td>
            </tr>
        </table>
    </article>

    <div class="footer">
        <p style="font-size: 73%; font-weight: bold;">
            En caso de emergencia contáctenos, que estamos para ayudarlo,
            pofesionalismo y calidad de trato para clientes de calidad
        </p>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="index.js"></script>

</body>

</html>
