<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            Listados de lotes disponibles</label>
        </h4>
    </div>
    <div class="box-body">
        @if(count($data) >  0)

            <table id="tabla_gestion" class="display table table-hover" cellspacing="0" width="100%">
                <tr>
                    <th>Id-BBD</th>
                    <th>Nombre</th>
                    <th>Nro. registros</th>
                    <th>FF Registro</th>
                    <th>ON / OFF</th>
                </tr>


                @foreach($data as $item)
                    <tr style="" id="{{ $item->id }}"  data-id="{{ $item->id }}" data-href="lote-on-of/{{ $item->id }}/::estado">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->cantidad_datos }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td  class="text-center conteck"><input id="ck-{{ $item->id }}" class="accion_asignar" type="checkbox" @if($item->status_id==1) checked="checked"  @endif ></td>
                    </tr>
                @endforeach


            </table>

            <script>
                var tf = new TableFilter(document.querySelector('#tabla_gestion'), {
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


                $('.accion_asignar').on("click", function(){
                    if($("#agente").val()!=""){
                        var $obj=$(this).parents('tr');
                        var url= $obj.data('href').replace('::estado',$(this).prop('checked'));
                        var jqxhr = $.get(url);
                        jqxhr.done(function(resul) {
                            registrosNUm();
                        });
                    }else{

                    }
                });


                function registrosNUm() {
                    var jqxhrs = $.get('nro-registros');
                    jqxhrs.done(function (resul) {
                        var nro;
                        $.each(resul,function(i,val) {
                            nro= (val>0) ? val : "";
                            $("#nro-home-"+i).html(nro);
                        });
                    });
                }
            </script>
        @else
            @include('alerts.noresult')
        @endif
    </div>
</div>