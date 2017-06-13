<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">Mis tipificaciones</h4>
    </div>

    <div class="col-md-12">
        <button type="button" class="btn btn-info" onclick="cargarlistado('create-tipificaciones');">
            <span class="fa fa-map-o"></span> Crear Tipificaciones
        </button>
    </div>

    <div class="box-body">
        @if(count($data) >  0)
            <table id="tabla" class="display table table-hover" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipificación 1</th>
                    <th>Tipificación 2</th>
                    <th>Tipificación 3</th>
                    <th>Tipificación 4</th>
                    <th>CIERRE</th>
                    <th>Status</th>
                    <th>Acción</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>

                        <td>{{ $item->tpfnivel1->nb_tpfnivel1 }}</td>
                        <td>@if($item->tpfnivel2!=null) {{ $item->tpfnivel2->nb_tpfnivel2 }} @else - @endif  </td>
                        <td>@if($item->tpfnivel3!=null) {{ $item->tpfnivel3->nb_tpfnivel3 }} @else - @endif</td>
                        <td>@if($item->tpfnivel4!=null) {{ $item->tpfnivel4->nb_tpfnivel4 }} @else - @endif</td>
                        <td>{{ $item->cierre }}</td>
                        <td>{{ $item->status->nb_status }}</td>
                        <td><button class="btn  btn-success btn-xs" onclick="modalFicha([{{ $item->id }},'edit-tipificaciones']);" ><i class="fa fa-fw fa-eye"></i>Ver</button></td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <script>
                var tf = new TableFilter(document.querySelector('#tabla'), {
                    base_path: 'plugins/TableFilter-master/dist/tablefilter/',
                    paging: true,
                    paging_length: 10,
                    loader: true,
                    loader_text: "Filrando datos...",
                    rows_counter: true,
                    rows_counter_text: "Fila:",
                    help: false,
                    locale:'es',
                    responsive:false,
                    themes: [{ name: 'skyblue' }]
                });
                tf.init();
            </script>
        @else
            @include('alerts.noresult')
        @endif
    </div>
</div>