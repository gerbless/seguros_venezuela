<div class="box box-primary">
    <div class="box-header">
        <h4 align="center" class="box-title">Historial de gestión - <b>{{$cliente->cliente}}</b></h4>
    </div>

    <div class="box-body">
        @if(count($contactos) >  0)
            <table  class="table table-striped" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Tipificación 1</th>
                    <th>Tipificación 2</th>
                    <th>Tipificación 3</th>
                    <th>Tipificación 4</th>
                    <th>status</th>
                    <th>Usuario</th>
                    <th>FF Registro</th>
                    <th>Acción</th>
                </tr>
                </thead>

                <tbody>
                @foreach($contactos as $contacto)
                    <tr>
                        <td>{{ $contacto->telefono }}</td>
                        <td class="text-center text-bold">
                              {{$contacto->tpfnivel1->nb_tpfnivel1}}
                        </td>
                        <td class="text-center text-bold">
                            @if($contacto->tpfnivel2_id!=null)
                                {{  $contacto->tpfnivel2->nb_tpfnivel2 }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center text-bold">
                            @if($contacto->tpfnivel3_id!=null)
                                {{  $contacto->tpfnivel3->nb_tpfnivel3 }}
                               @else
                                   -
                               @endif
                           </td>
                        <td class="text-center text-bold">
                            @if($contacto->tpfnivel4_id!=null)
                                {{  $contacto->tpfnivel4->nb_tpfnivel4 }}
                            @else
                                -
                            @endif
                        </td>
                           <td>{{ $contacto->status->nb_status}}</td>
                           <td>{{ $contacto->users->name}}</td>
                           <td>{{ $contacto->created_at->format('d/m/Y g:i:s a') }}</td>
                        <td onclick="$('#comt-{{$contacto->id}}').toggle(1500);" style="cursor: pointer" class="text-bold text-info">Ver más</td>
                    </tr>
                    <tr style="display: none" id="comt-{{$contacto->id}}" >
                        <td colspan="9" >
                            <b>Comentario:</b> {{$contacto->comentario}}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <script>
              /*  var tf = new TableFilter(document.querySelector('#tabla_historia'), {
                    base_path: 'plugins/TableFilter-master/dist/tablefilter/',
                    paging: true,
                    paging_length: 10,
                    loader: true,
                    loader_text: "Filrando datos...",
                    rows_counter: true,
                    rows_counter_text: "Fila:",
                    help: false,
                    responsive:false,
                    themes: [{ name: 'skyblue' }]
                });
                tf.init();*/
            </script>
        @else
            @include('alerts.noresult')
        @endif
    </div>
</div>