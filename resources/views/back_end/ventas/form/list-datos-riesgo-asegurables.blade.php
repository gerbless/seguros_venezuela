<table class="display table table-hover">
    <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo de Riesgo</th>
        <th>Parentesco</th>
        <th>ff Nacimiento</th>
        <th>Edad</th>
        <th>ff Registro</th>
    </tr>

    @foreach($datos_riesgo_asegurable as $value)
        <tr>
            <td>{{ strtoupper($value->nacionalidad_id) }}-{{ $value->nu_documento }}</td>
            <td>{{ $value->nb_nombre }}</td>
            <td>{{ $value->nb_apellido }}</td>
            <td>{{ $value->tipoRiesgo->nb_tipo_riesgo }}</td>
            <td>{{ $value->parentesco->nb_parentesco }}</td>
            <td>{{ $value->ff_nacimiento }}</td>
            <td>{{ $value->edad }}</td>
            <td>{{ $value->ff_registro }}</td>
        </tr>
    @endforeach
</table>