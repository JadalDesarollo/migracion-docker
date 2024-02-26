<!-- Tu vista HTML -->
<table class="table table-bordered" style="border: 1px solid black;">
    <thead>
        <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>{{ $data['title'] }}</strong></td>
        <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Fecha: {{ $data['date'] }}</strong></td>
        <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF;"><strong>Hora: {{ date('H:i:s') }}</strong></td>
        <tr>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>TIPO DOC.</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>N° DOC.</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>CLIENTE</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>DESCUENTO</strong></td>
            <td colspan="3" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>CANTIDAD</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>FECHA DE EMISIÓN</strong></td>
            <td colspan="1" style="text-align: center; background-color: #071846; color: #FFFFFF; font-size: 11px;"><strong>SITUACIÓN</strong></td>
        </tr>
    </thead>
    <tbody>
        <!-- Itera sobre los primeros 5 datos y muestra cada fila en la tabla -->
        @foreach ($data['content'] as $row)
        <tr>
            <!-- Ajusta aquí para mostrar los datos correctos -->
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->document_type }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->document_number }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->name_client }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->discount }}</td>
            <td colspan="3" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->total_amount }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->broadcast_date }}</td>
            <td colspan="1" style="border-right: 1px solid black; border-bottom: 1px solid black; font-size: 11px;">{{ $row->situacion }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
