<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('assets/css/pdf.css') }}">
    <title>Orden</title>
</head>

<body>
    <!--HEADER-->
    <table class="div-1Header">
        <tr>
            <td class="logotd">
                <img src="{{ public_path('assets/images/newlogo.png') }}" width="140px">

            </td>
            <td class="datos-grales-td">
                <table class="table_h_factura">
                    <thead>
                        <th class="headerDatosh titulos">Remision: <span class="titulos">51</span></th>
                    </thead>
                    <tr>
                        <td class="titulos">
                            <p class="titulos">nombre de tu empresa</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                RFC: <span>BHUTMHTFP8</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>TELEFONO: <span>5897485106</span> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>E-MAIL: <span>contacto@tuempresa.com</span> </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--DATOS-->
    <table class="div-1Datos">
        <tr>
            <td class="receptor">
                <table class="table_receptor">
                    <tr>
                        <td class="titulos">
                            <p class="titulos tituloRec">receptor</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequat</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>RFC: <span>5897485106</span> </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="datosGral">
                <table class="table_datos">
                    <tr>
                        <td>
                            <p>
                                FECHA DE CREACIÓN:
                            </p>
                        </td>
                        <td>
                            <p>
                                25-08-2022
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                FECHA DE VENCIMIENTO:
                            </p>
                        </td>
                        <td>
                            <p>
                                31-12-2022
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                SUCURSAL:
                            </p>
                        </td>
                        <td>
                            <p>
                                CDMX
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                ALMACÉN:
                            </p>
                        </td>
                        <td>
                            <p>
                                8
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--MATERIAL/PRODUCTO-->
    <table class="table_materiales">
        <thead>
            <tr>
                <td>Código</td>
                <td>Cantidad</td>
                <td>Unidad</td>
                <td>Descripción</td>
                <td>Precio unitario</td>
                <td>Importe</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>005</td>
                <td>3.00</td>
                <td>Pieza</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. asperiores illum dolore aliquid dicta rem
                    tenetur hic.</td>
                <td>550.00</td>
                <td>1650.00</td>
            </tr>
        </tbody>
    </table>
    <!--DATOS FINALES-->
    <table class="div-1Datos">
        <tr>
            <td class="">
                <table class="table_datosFtxt">
                    <tr>
                        <td>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum maxime eos minus illum
                                dignissimos voluptas? Expedita optio eligendi hic pariatur quisquam ratione, ipsam ipsa
                                temporibus perspiciatis, alias iure sequi sit.</p>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="datosFinales">
                <table class="table_datosfinales">
                    <tr>
                        <td>
                            <p>
                                Subtotal:
                            </p>
                        </td>
                        <td>
                            <p>
                                $1650.00
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Descuento:
                            </p>
                        </td>
                        <td>
                            <p>
                                $0.00
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                IVA:
                            </p>
                        </td>
                        <td>
                            <p>
                                $264.00
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                Total:
                            </p>
                        </td>
                        <td>
                            <p>
                                $1914.00
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--FIRMA-->
    <div class="firma">
        Firma del cliente
    </div>
    <!--FOOTER-->
    <footer>
        <p>Obten tu factura en: https://tuempresa.com/facturacion | Empresa: 558525 | Referencia: 55a885dvs </p>
    </footer>
</body>

</html>
