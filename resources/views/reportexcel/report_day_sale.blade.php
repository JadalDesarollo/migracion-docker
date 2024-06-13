<!-- Tu vista HTML -->
<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
        <tr>
            <td colspan="6" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ $data['title'] }}</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha: {{ $data['date'] }}</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Hora: {{ date('H:i:s') }}</strong></td>
        </tr>
        <tr>
            <th colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Estacion: {{ $data['establishment'] }}</strong></th>
            <th colspan="7" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Del {{ date('d/m/Y', strtotime($data['desde'])) }} Al {{ date('d/m/Y', strtotime($data['hasta'])) }}</strong></th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Usuario: {{ $data['user'] }}</strong></th>
        </tr>
        <tr>
            <!-- Aquí ajusta los encabezados según tus datos -->
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Fecha</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Local</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Fecha Venta</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Cantidad</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Monto</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Nombre</th>
        </tr>
    </thead>
    <tbody>
        <!-- Itera sobre los datos y muestra cada fila en la tabla -->
        @foreach ($data['content'] as $row)
        <tr>
            <!-- Ajusta aquí para mostrar los datos correctos -->
            <td colspan="2" >{{ $row->sale_date_v }}</td>
            <td colspan="2" >{{ $row->id_local_v }}</td>
            <td colspan="2" >{{ $row->sale_date_v }}</td>
            <td colspan="2" >{{ $row->quantity_v }}</td>
            <td colspan="2" >{{ $row->total_amount_v }}</td>
            <td colspan="2" >{{ $row->product_name_v }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

