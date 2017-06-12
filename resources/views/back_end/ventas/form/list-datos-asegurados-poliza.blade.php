<table class="display table table-hover">
    <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Tipo Persona</th>
        <th>edad</th>
        <th>ff Nacimiento</th>
    </tr>

    @foreach($poliza_asegurados as $value)
        <tr data-tipopersona="{{ $value->tipo_persona_id }}"  data-idasegurado="{{ $value->id }}" data-edad="{{ $value->edad }}" data-nombre="{{ $value->nb_nombre }}" data-nacimiento="{{ date('d-m-Y',strtotime($value->ff_nacimiento))  }}">
            <td>{{ strtoupper($value->nacionalidad_id) }}-{{ $value->nu_documento }}</td>
            <td>{{ $value->nb_nombre }} {{ $value->nb_apellido }}</td>
            <td>{{ $value->tipoPersona->nb_persona }}</td>
            <td class="EdadAsegurados"> {{ $value->edad }}</td>
            <td>{{ date('d-m-Y',strtotime($value->ff_nacimiento))  }}</td>
            <td> <button class="btn  btn-info btn-xs" onclick="modalFicha([{{ $value->id }},'datos-beneficiarios-asegurados']);" ><i class="fa fa-plus"></i> Add Benficiarios</button> </td>
        </tr>
    @endforeach
</table>