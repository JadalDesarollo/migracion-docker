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
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Fecha</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Número de Doc</th>
            <th colspan="12" style="text-align: center; background-color: #071846; color: #FFFFFF;">Cliente</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Total de Venta</th>
            <!-- <th style="text-align: center; background-color: #071846; color: #FFFFFF;">Producto</th>
            <th style="text-align: center; background-color: #071846; color: #FFFFFF;">Cantidad</th> -->
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
                        <td colspan="2">
                            {{ $sale['date'] ?? '&nbsp;' }}
                        </td>

                        <!-- Mostrar el documento de venta -->
                        <td colspan="2">
                            {{ $sale['sale_document'] ?? '&nbsp;' }}
                        </td>

                        <!-- Mostrar el cliente -->
                        <td colspan="12">{{ $row->client }}</td>

                        <!-- Mostrar la venta total -->
                        <td colspan="2">
                            {{ $sale['total_sale'] ?? '&nbsp;' }}
                        </td>

                    </tr>
                @endforeach
            @endforeach
        @endforeach
    </tbody>
</table>
