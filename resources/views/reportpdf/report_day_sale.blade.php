<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Diario de Ventas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Estilos CSS aquí */
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

            <div style="clear: both;"></div>
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
                    <th>GAL</th>
                    <th>SOLES</th>
                </tr>
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

</html>
