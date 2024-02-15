<!-- Tu vista HTML -->
<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
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
        <tr>
            <!-- Aquí ajusta los encabezados según tus datos -->
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Fecha</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">84 OCT(produc)-Galones</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">84 OCT(produc)-Soles</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">90 OCT-Galones(produc)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">90 OCT-Galones(product)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">95 OCT-Galones(produc)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">95 OCT-Galones(product)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">97 OCT-Galones(produc)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">97 OCT-Galones(product)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">REGULAR-Galones(produc)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">REGULAR-Galones(product)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">PREMIUM(produc)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">PREMIUM(product)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">GAS GLP(Galones)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">GAS GLP(Soles)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Total-Galones(delaFila)</th>
            <th colspan="2" style="text-align: center; background-color: #071846; color: #FFFFFF;">Total-Soles(delaFila)</th>
        </tr>
    </thead>
    <tbody>
        <!-- Itera sobre los datos y muestra cada fila en la tabla -->
        @foreach ($data['content'] as $row)
        <tr>
            <!-- Ajusta aquí para mostrar los datos correctos -->
            <td>{{ $row->fecha }}</td>
            <td>{{ $row->{'84 OCT(produc)-Galones'} }}</td>
            <td>{{ $row->{'84 OCT(produc)-Soles'} }}</td>
            <td>{{ $row->{'90 OCT-Galones(produc)'} }}</td>
            <td>{{ $row->{'90 OCT-Galones(product)'} }}</td>
            <td>{{ $row->{'95 OCT-Galones(produc)'} }}</td>
            <td>{{ $row->{'95 OCT-Galones(product)'} }}</td>
            <td>{{ $row->{'97 OCT-Galones(produc)'} }}</td>
            <td>{{ $row->{'97 OCT-Galones(product)'} }}</td>
            <td>{{ $row->{'REGULAR-Galones(produc)'} }}</td>
            <td>{{ $row->{'REGULAR-Galones(product)'} }}</td>
            <td>{{ $row->{'PREMIUM(produc)'} }}</td>
            <td>{{ $row->{'PREMIUM(product)'} }}</td>
            <td>{{ $row->{'GAS GLP(Galones)'} }}</td>
            <td>{{ $row->{'GAS GLP(Soles)'} }}</td>
            <td>{{ $row->{'Total-Galones(delaFila)'} }}</td>
            <td>{{ $row->{'Total-Soles(delaFila)'} }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
