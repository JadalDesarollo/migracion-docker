<table class="table table-bordered" style="border: 1px solid black;">

    <thead> </thead>
    <tbody>
        <tr>
            <td colspan="4" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ $data['title'] }}</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha: {{ $data['date'] }}</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Hora: {{ date('H:i:s') }}</strong></td>
        </tr>
        <tr>
            <th colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Estacion: {{ $data['establishment'] }}</strong></th>
            <th colspan="5" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Del {{ date('d/m/Y', strtotime($data['desde'])) }} Al {{ date('d/m/Y', strtotime($data['hasta'])) }}</strong></th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Usuario: {{ $data['user'] }}</strong></th>
        </tr>
    </tbody>

</table>

<table class="table table-bordered" style="border: 1px solid green;">
    <thead>
        <tr>
        <th rowspan="2" colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha</strong></th>
            @foreach ($data['header'] as $row)
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ $row->dsarticulo1 }}</strong></th>
            @endforeach
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>TOTAL</strong></th>
        </tr>
        <tr>
            @foreach ($data['header'] as $row)
            <th style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>GAL</strong></th>
            <th style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>SOLES</strong></th>
            @endforeach
            <th style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>GALONES</strong></th>
            <th style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>SOLES</strong></th>
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
        <td style="width: 150%; text-align: right;">{{ number_format($totalCantidad, 3, '.', ',') }}</td>
        <td style="width: 150%; text-align: right;">{{ number_format($totalTotal, 3, '.', ',') }}</td>
        </tr>
        @endif
        <tr>
            @php
            $totalCantidad += (float)$row->cantidad;
            $totalTotal += (float)$row->total;
            @endphp
            <td colspan="2" style="text-align: center;">{{ date('d/m/Y', strtotime($row->fecproceso)) }}</td>

            @php
            $dates[] = $row->fecproceso;
            @endphp
            @else
            @php
            $totalCantidad += (float)$row->cantidad;
            $totalTotal += (float)$row->total;
            @endphp
            @endif
            <td style="width: 150%; text-align: right;">{{ number_format((float)$row->cantidad, 3, '.', ',') }}</td>
            <td style="width: 150%; text-align: right;">{{ number_format((float)$row->total, 3, '.', ',') }}</td>
            @php
            $posicion = $posicion +1;
            $indice = $indice + 1;
            @endphp
            @if(count($data['content'])==$indice)
            <td style="width: 150%; text-align: right;">{{ number_format($totalCantidad, 3, '.', ',') }}</td>
            <td style="width: 150%; text-align: right;">{{ number_format($totalTotal, 3, '.', ',') }}</td>
        </tr>
        @endif

        @endforeach

    </tbody>

</table>

<table class="table table-bordered" style="border: 1px solid black;">

    <thead> </thead>
    <tbody>
        <tr>
            <td colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>PRODUCTO</strong></td>
            <td colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>PROMEDIO</strong></td>
            <td colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>GALONES</strong></td>
            <td colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>SOLES</strong></td>
        </tr>
        @php
        $totalPromedio = 0;
        $totalGalones = 0;
        $totalSoles = 0;
        @endphp
        @foreach ($data['result'] as $result)
        @php
        $totalPromedio += floatval($result->promedio);
        $totalGalones += floatval($result->galones);
        $totalSoles += floatval($result->soles);
        @endphp
        <tr>
            <td colspan="2" style="text-align: center;">{{ $result->dsarticulo1 }}</td>
            <td colspan="2" style="text-align: right;">{{ number_format($result->promedio, 3, '.', ',') }}</td>
            <td colspan="2" style="text-align: right;">{{ number_format($result->galones, 3, '.', ',') }}</td>
            <td colspan="2" style="text-align: right;">{{ number_format($result->soles, 3, '.', ',') }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>TOTAL</strong></th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ number_format($totalPromedio, 3, '.', ',') }}</strong></th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ number_format($totalGalones, 3, '.', ',') }}</strong></th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ number_format($totalSoles, 3, '.', ',') }}</strong></th>
        </tr>
    </tbody>

</table>