<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            Listados de Tipos de Beneficiarios
        </h4>
    </div>
    <div class="box-body">
        <div class="col-lg-12">
            <button class="btn btn-default" onclick="cargarlistado('create-tipo-beneficiario');">
                <i class="fa fa-suitcase" aria-hidden="true"></i>
                Agregar Tipo Beneficiario
            </button>
        </div>
        @if(count($data) >  0)

            <table id="tabla_banco" class="display table table-hover" cellspacing="0" width="100%">
                <tr>
                    <th>Nombre</th>
                    <th>Status</th>
                </tr>

                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->nb_tipo_beneficiario}}</td>
                        <td>{{ $item->status->nb_status }}</td>
                    </tr>
                @endforeach


            </table>

            <script>
                var tf = new TableFilter(document.querySelector('#tabla_banco'), {
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