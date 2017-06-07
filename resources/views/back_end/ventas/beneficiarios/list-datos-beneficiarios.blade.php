<table class="display table table-hover">
    <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo Beneficiario</th>
        <th>Parentesco</th>
        <th>Tipo Persona</th>
        <th>ff Nacimiento</th>
        <th>Edad</th>
        <th>ff Registro</th>
    </tr>

    @foreach($beneficiarios_poliza as $value)
        <tr>
            <td>{{ strtoupper($value->nacionalidad_id) }}-{{ $value->nu_documento }}</td>
            <td>{{ $value->nb_nombre }}</td>
            <td>{{ $value->nb_apellido }}</td>
            <td>{{ $value->tipoBeneficiario->nb_tipo_beneficiario }}</td>
            <td>{{ $value->parentesco->nb_parentesco }}</td>
            <td>{{ $value->tipoPersona->nb_persona }}</td>
            <td>{{ $value->ff_nacimiento }}</td>
            <td>{{ $value->edad }}</td>
            <td>{{ $value->ff_registro }}</td>
        </tr>
    @endforeach
</table>