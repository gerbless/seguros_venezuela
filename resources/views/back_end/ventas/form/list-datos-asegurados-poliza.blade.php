<table class="display table table-hover">
    <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Tipo Persona</th>
        <th>ff Registro</th>
    </tr>

    @foreach($poliza_asegurados as $value)
        <tr>
            <td>{{ strtoupper($value->nacionalidad_id) }}-{{ $value->nu_documento }}</td>
            <td>{{ $value->nb_nombre }}</td>
            <td>{{ $value->tipoPersona->nb_persona }}</td>
            <td>{{ $value->ff_registro }}</td>
            <td> <button class="btn  btn-info btn-xs" onclick="modalFicha([{{ $value->id }},'datos-beneficiarios-asegurados']);" ><i class="fa fa-plus"></i> Add Benficiarios</button> </td>
        </tr>
    @endforeach
</table>