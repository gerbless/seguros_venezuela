<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            Listados de Planes
        </h4>
    </div>
    <div class="box-body">
        <div class="col-lg-12">
            <button class="btn btn-default" onclick="cargarlistado('create-planes');">
                <i class="fa fa-suitcase" aria-hidden="true"></i>
                Agregar plan
            </button>
        </div>
        @if(count($data) >  0)

            <table id="tabla_ramos" class="display table table-hover" cellspacing="0" width="100%">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Producto</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>

                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nb_plan }}</td>
                        <td>{{ $item->producto->nb_producto}}</td>
                        <td>{{ $item->status->nb_status }}</td>
                        <td>
                            <button class="btn  btn-info btn-xs" onclick="cargarlistado('editar-planes/{{$item->id}}');" ><i class="fa fa-plus"></i> EDIT</button>
                        </td>
                    </tr>
                @endforeach


            </table>

            <script>
                var tf = new TableFilter(document.querySelector('#tabla_ramos'), {
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