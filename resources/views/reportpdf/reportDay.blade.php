<!DOCTYPE html>
<html>

<head>
    <title>REPORTE ACUMULADO POR DÍA</title>
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
            <h3>{{ $data['title'] }}</h3>
            <p>Del {{ date('d/m/Y', strtotime($data['desde'])) }} Al {{ date('d/m/Y', strtotime($data['hasta'])) }}</p>
        </div>

        <div>
            <div class="left-content">
                <p>ESTACION: {{ $data['establishment'] }}</p>
                <p>Usuario: {{ $data['user'] }}</p>
            </div>

            <div class="right-content">
                <p>Página: 1</p>
                <p>Fecha: {{ $data['date'] }}</p>
                <p>Hora: {{ date('H:i:s') }}</p>
            </div>

            <div class="clear"></div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Fecha</th>
                    @foreach ($data['header'] as $row)
                    <th colspan="2">{{ $row->dsarticulo1 }}</th>
                    @endforeach
                    <th colspan="2">TOTAL</th>
                </tr>
                <tr>
                    @foreach ($data['header'] as $row)
                    <th>GAL</th>
                    <th>SOLES</th>
                    @endforeach
                    <th>GALONES</th>
                    <th>SOLES</th>
                </tr>
            </thead>

            <tbody>
                @php
                $dates = [];
                $totalCantidad = 0;
                $totalTotal = 0;
                $posicion = 0;
                $indice = 0
                @endphp

                @foreach ($data['content'] as $row)
                    @if (!in_array($row->fecproceso, $dates))                    
                        @if($posicion>1)
                                <td>{{ number_format($totalCantidad, 3, '.', ',') }}</td>
                                <td>{{ number_format($totalTotal, 3, '.', ',') }}</td>
                            </tr>
                        @endif 
                    <tr>
                        @php
                            $totalCantidad += (float)$row->cantidad;
                            $totalTotal += (float)$row->total;
                        @endphp
                        <td>{{ date('d/m/Y', strtotime($row->fecproceso)) }}</td>
                        
                        @php
                        $dates[] = $row->fecproceso;
                        @endphp
                    @else 
                        @php                            
                            $totalCantidad += (float)$row->cantidad;
                            $totalTotal += (float)$row->total;
                        @endphp
                    @endif                        
                    <td>{{ number_format((float)$row->cantidad, 3, '.', ',') }}</td>
                    <td>{{ number_format((float)$row->total, 3, '.', ',') }}</td>
                    @php
                        $posicion = $posicion +1;
                        $indice = $indice + 1;
                    @endphp
                    @if(count($data['content'])==$indice)
                            <td>{{ number_format($totalCantidad, 3, '.', ',') }}</td>
                            <td>{{ number_format($totalTotal, 3, '.', ',') }}</td>
                        </tr>
                    @endif 
                    
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
@php
    $totalPromedio = 0;
    $totalGalones = 0;
    $totalSoles = 0;
@endphp

<tbody>
@foreach ($data['result'] as $result)
    @php
        $totalPromedio += floatval($result->promedio);
        $totalGalones += floatval($result->galones);
        $totalSoles += floatval($result->soles);
    @endphp
    <tr>
        <td style="text-align: center;">{{ $result->dsarticulo1 }}</td>
        <td style="text-align: right;">{{ number_format($result->promedio, 3, '.', ',') }}</td>
        <td style="text-align: right;">{{ number_format($result->galones, 3, '.', ',') }}</td>
        <td style="text-align: right;">{{ number_format($result->soles, 3, '.', ',') }}</td>
    </tr>
@endforeach
</tbody>

<thead>
    <tr>
        <th style="text-align: center;">TOTAL </th>
        <th style="text-align: right;">{{ number_format($totalPromedio, 3, '.', ',') }}</th>
        <th style="text-align: right;">{{ number_format($totalGalones, 3, '.', ',') }}</th>
        <th style="text-align: right;">{{ number_format($totalSoles, 3, '.', ',') }}</th>
    </tr>
</thead>
        <!-- <tbody>
            <tr>
                <td style="text-align: center;">GLP (litros)</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td style="text-align: center;">GNV (m3)</td>
                <td>0.00</td>
                <td>0.0</td>
                <td>0.00</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="2" style="text-align: center;">TOTAL</th>
                <th colspan="2" style="text-align: right;">0.00</th>
            </tr>
        </thead> -->
    </table>
</body>

</html>