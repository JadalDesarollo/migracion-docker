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
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">T/D</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">NRO.DOCUM.</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">R.U.C.</th>
            <th colspan="5" style="text-align: center; background-color: #071846; color: #FFFFFF;">CLIENTE</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">VALOR VENTA</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">IMPUESTO</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <!-- Itera sobre los datos y muestra cada fila en la tabla -->
        @foreach ($data['content'] as $row)
        <tr>
            <!-- Ajusta aquí para mostrar los datos correctos -->
            <td colspan="2">{{ $row->date }}</td>
            <td colspan="2">{{ $row->document_type }}</td>
            <td colspan="2">{{ $row->document_number }}</td>
            <td colspan="2">{{ $row->ruc }}</td>
            <td colspan="5">{{ $row->client_name }}</td>
            <td colspan="2">{{ $row->sale_valor }}</td>
            <td colspan="2">{{ $row->tax }}</td>
            <td colspan="2">{{ $row->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


