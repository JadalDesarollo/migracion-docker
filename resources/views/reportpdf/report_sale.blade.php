<!-- Tu vista HTML -->
<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
        <td colspan="4" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ $data['title'] }}</strong></td>
        <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha: {{ $data['date'] }}</strong></td>
        <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Hora: {{ date('H:i:s') }}</strong></td>
        <tr>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>FECHA</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>T/D</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>NRO.DOCUM.</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>R.U.C.</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>CLIENTE</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>VALOR VENTA</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>IMPUESTO</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>TOTAL</strong></td>
        </tr>
    </thead>
    <tbody>
        <!-- Itera sobre los primeros 5 datos y muestra cada fila en la tabla -->
        @foreach ($data['content'] as $row)
        <tr>
            <!-- Ajusta aquí para mostrar los datos correctos -->
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->date }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->document_type }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->document_number }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->ruc }}</td>
            <td colspan="3" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->client_name }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->sale_valor }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->tax }}</td>
            <td colspan="1" style="border-bottom: 1px solid black; font-size: 11px;">{{ $row->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
