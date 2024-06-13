<!-- Tu vista HTML -->
<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
        <tr>
            <td colspan="5" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ $data['title'] }}</strong></td>
            <td colspan="10" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha: {{ $data['date'] }}</strong></td>
            <td colspan="4" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Hora: {{ date('H:i:s') }}</strong></td>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Estacion: {{ $data['establishment'] }}</strong></th>
            <th colspan="10" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Del {{ date('d/m/Y', strtotime($data['desde'])) }} Al {{ date('d/m/Y', strtotime($data['hasta'])) }}</strong></th>
            <th colspan="4" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Usuario: {{ $data['user'] }}</strong></th>
        </tr>
        <tr>
            <!-- Aquí ajusta los encabezados según tus datos -->
            <th colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;">Fecha</th>
            <th colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;">Número de Doc</th>
            <th colspan="10" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;">Cliente</th>
            <th colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;">Total de Venta</th>
            <!-- <th style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;">Producto</th>
            <th style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;">Cantidad</th> -->
        </tr>
    </thead>
    <tbody>
        <!-- Itera sobre los datos y muestra cada fila en la tabla -->
        @foreach ($data['content'] as $row)
        @php
        $salesPerClient = json_decode($row->sales_per_client, true);
        @endphp
        @foreach ($salesPerClient as $saleDate)
        @foreach ($saleDate['sales'] as $sale)
        <tr>
            <!-- Mostrar la fecha -->
            <td colspan="3" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">
                {{ $sale['date'] ?? '&nbsp;' }}
            </td>

            <!-- Mostrar el documento de venta -->
            <td colspan="10" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">
                {{ $sale['sale_document'] ?? '&nbsp;' }}
            </td>

            <!-- Mostrar el cliente -->
            <td colspan="3" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->client }}</td>

            <!-- Mostrar la venta total -->
            <td colspan="3" style="border-bottom: 1px solid black; font-size: 11px;">
                {{ $sale['total_sale'] ?? '&nbsp;' }}
            </td>

        </tr>
        @endforeach
        @endforeach
        @endforeach
    </tbody>
</table>
