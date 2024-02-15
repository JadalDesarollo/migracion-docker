<!DOCTYPE html>
<html lang="en">
<?php
$pageNumber = 1;
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Facturas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .table thead {
            background-color: #071846;
            color: #FFFFFF;
            /* Color de fondo azul claro */
        }

        .header {
            text-align: center;
            background-color: #071846;
            margin-bottom: 20px;
            padding: 1px;
            color: #FFFFFF;
        }

        .left-content {
            text-align: left;
            font-weight: bold;
            float: left;
            /* Alinea a la izquierda */
        }

        .right-content {
            text-align: left;
            font-weight: bold;
            float: right;
            /* Alinea a la derecha */
        }

        .clear {
            clear: both;
        }

        @page {
            size: A4 landscape;
        }

        p {
            line-height: 0.2;
            /* Puedes ajustar este valor según tus preferencias */
        }

        td {
            text-align: right;
        }

        table {
            width: 100%;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
            /* Color de fondo para filas impares */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $data['title'] }}</h1>
            <p>Fecha del Reporte: {{ $data['date'] }}</p>
            <p>Del {{ date('d/m/Y', strtotime($data['desde'])) }} Al {{ date('d/m/Y', strtotime($data['hasta'])) }}</p>
        </div>

        <div>
            <div class="left-content">
                <p>ESTACION: {{ $data['establishment'] }}</p>
                <p>Usuario: {{ $data['user'] }}</p>
            </div>

            <div class="right-content">
                <p>Página: {{ $pageNumber }}</p>
                <p>Fecha: {{ $data['date'] }}</p>
                <p>Hora: {{ date('H:i:s') }}</p>
            </div>

            <div style="clear: both;"></div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th rowspan="2">Tipo Doc.</th>
                    @foreach($data['products_name'] as $product_name)
                    <th colspan="2">{{ $product_name }}</th>
                    @endforeach -->
                    <th colspan="2">N° DOC.</th>
                    <th colspan="2">Producto</th>
                    <th colspan="2">Cantidad</th>
                    <th colspan="2">Precio</th>
                    <th colspan="2">Dscto</th>
                    <th colspan="2">Total</th>
                    <th colspan="2">Fecha Emisión</th>
                    <th colspan="2">Situación</th>
                </tr>
                <!-- <tr>
                    @foreach($data['products_name'] as $product_name)
                    <th>GAL</th>
                    <th>SOLES</th>
                    @endforeach
                    <th>GAL</th>
                    <th>SOLES</th>
                </tr> -->
            </thead>

            <tbody>
                @foreach($data['sales'] as $sale)
                <tr>
                    <td>{{ $sale->fecha }}</td>
                    @foreach($data['products_name'] as $product_name)
                    <td>{{ $sale->{$product_name . '-Galones'} }}</td>
                    <td>{{ $sale->{$product_name . '-Soles'} }}</td>
                    @endforeach
                    <td>{{ $sale->{'Total-Galones(delaFila)'} }}</td>
                    <td>{{ $sale->{'Total-Soles(delaFila)'} }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>


<body>
    <table style="width: 50%; margin: 0 auto;" class="table table-bordered">
        <thead>
            <tr>
                <th>PRODUCTO </th>
                <th>PROMEDIO</than=>
                <th>GALONES</th>
                <th>SOLES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>84 OCTANOS</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>90 OCTANOS</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>95 OCTANOS</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>97 OCTANOS</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th>TOTAL </th>
                <th style="text-align: right;">0.00</than=>
                <th style="text-align: right;">0.00</th>
                <th style="text-align: right;">0.00</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>84 OCTANOS</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>90 OCTANOS</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="2">TOTAL</th>
                <th colspan="2" style="text-align: right;">0.00</th>
            </tr>
        </thead>
    </table>
</body>
</html>
