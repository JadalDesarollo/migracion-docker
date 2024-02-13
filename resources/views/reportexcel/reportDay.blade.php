<!-- Tu vista HTML -->
<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
        <tr>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha: {{ date('d/m/Y') }}</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Hora: {{ date('H:i:s') }}</strong></td>
        </tr>
        <tr>
            <!-- Aquí ajusta los encabezados según tus datos -->
            <th>Fecha</th>
            <th>84 OCT(produc)-Galones</th>
            <th>84 OCT(produc)-Soles</th>
            <th>90 OCT-Galones(produc)</th>
            <th>90 OCT-Galones(product)</th>
            <th>95 OCT-Galones(produc)</th>
            <th>95 OCT-Galones(product)</th>
            <th>97 OCT-Galones(produc)</th>
            <th>97 OCT-Galones(product)</th>
            <th>REGULAR-Galones(produc)</th>
            <th>REGULAR-Galones(product)</th>
            <th>PREMIUM(produc)</th>
            <th>PREMIUM(product)</th>
            <th>GAS GLP(Galones)</th>
            <th>GAS GLP(Soles)</th>
            <th>Total-Galones(delaFila)</th>
            <th>Total-Soles(delaFila)</th>
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
