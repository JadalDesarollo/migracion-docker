<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Diario de Ventas</title>
    <link rel stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
        </div>

        <div>
            <div class="left-content">
                <p>ESTACION: </p>
                <p>Usuario: </p>
            </div>

            <div class="right-content">
                <p>Página: 1</p>
                <p>Fecha: </p>
                <p>Hora: </p>
            </div>

            <div class="clear"></div>
        </div>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th rowspan="2">Fecha</th>
                    @foreach($data['products_name'] as $product_name)
                    <th colspan="2">{{ $product_name }}</th>
                    @endforeach
                    <th colspan="2">Totales</th>
                </tr>
                <tr>
                    @foreach($data['products_name'] as $product_name)
                    <th>GAL</th>
                    <th>SOLES</th>
                    @endforeach
                    <th>GAL</th> <!-- Agregado -->
                    <th>SOLES</th> <!-- Agregado -->
                </tr>
            </thead>


            <tbody>
                @foreach($data['sales'] as $sale)
                @php
                $ventasArray = json_decode($sale->ventas, true);
                @endphp

                @foreach($ventasArray as $fecha => $productos)
                <tr>
                    <td>{{ $fecha }}</td>
                    @foreach($data['products_name'] as $product_name)

                    @php
                    $totalQuantity = 0;
                    $totalPrice = 0;
                    foreach ($productos as $producto) {
                    if ($producto['product_name'] == $product_name) {
                    $totalQuantity += $producto['quantity'];
                    $totalPrice += $producto['price'];
                    }
                    }
                    @endphp
                    <!-- {{ $product_name}} -->
                    <td>
                        {{ $totalQuantity > 0 ? $totalQuantity : '0' }}
                    </td>
                    <td>
                        {{ $totalPrice > 0 ? $totalPrice : '0' }}
                    </td>
                    @endforeach
                    <td>{{-- Agrega el código para mostrar totales si es necesario --}}</td>
                </tr>
                @endforeach
                @endforeach


            </tbody>
        </table>

        <!-- Agrega cualquier otro contenido necesario -->
    </div>
</body>

</html>
