<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            Listados de Rango de edades
        </h4>
    </div>
    <div class="box-body">
        <div class="col-lg-12">
            <button class="btn btn-default" onclick="cargarlistado('create-rango');">
                <i class="fa fa-suitcase" aria-hidden="true"></i>
                Agregar Rango
            </button>
        </div>
        @if(count($data) >  0)

            <table id="tabla_productos" class="display table table-hover" cellspacing="0" width="100%">
                <tr>
                    <th><center>ID</center></th>
                    <th><center>Minimo</center></th>
                    <th><center>Maximo</center></th>
                    <th><center>Status</center></th>
                    <th><center>Acciones</center></th>
                </tr>

                @foreach($data as $item)
                    <tr>
                        <td><center>{{ $item->id }}</center></td>
                        <td><center>{{ $item->minimo }}</center></td>
                        <td><center>{{ $item->maximo}}</center></td>
                        <td><center>{{ $item->status->nb_status }}</center></td>
                        <td>
                            <center>
                                <button class="btn  btn-info btn-xs" onclick="cargarlistado('editar-rango/{{$item->id}}');" ><i class="fa fa-plus"></i> EDIT</button>
                            </center>
                        </td>
                    </tr>
                @endforeach


            </table>

            <script>
                var tf = new TableFilter(document.querySelector('#tabla_productos'), {
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