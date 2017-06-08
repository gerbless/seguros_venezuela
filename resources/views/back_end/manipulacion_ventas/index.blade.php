<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            <i class="{{$icon}} text-blue"></i> Listado - <label  class="text-bold text-blue">{{$carpeta}}</label>
        </h4>
    </div>
    <div class="box-body">
        @if(count($data) >  0)

            <table id="tabla_gestion" class="display table table-hover" cellspacing="0" width="100%">
                <tr>
                    <th>Nro. transacción</th>
                    <th>Documento Pagador</th>
                    <th>Nombre Pagador</th>

                    <th>Lista de Asegurados</th>
                    <th>Banco</th>
                    <th>Medio Pago</th>
                    <th>Nro. Medio</th>

                </tr>
                @foreach($data as $item)
                    <tr style="" id="{{ $item->id }}"  data-id="{{ $item->id }}" data-href="enviar-poliza-xml-nuevamente/{{ $item->id }}/::estado">
                        <td class="text-center">{{ $item->polizapagador->first()->id }}</td>
                        <td>{{ $item->polizapagador->first()->nu_documento }}</td>
                        <td>{{ strtoupper($item->polizapagador->first()->nb_nombre)." ".strtoupper($item->polizapagador->first()->nb_apellido) }}</td>

                        <td>
                            @foreach($item->aseguradoPoliza as $asegurados)
                                   @if($item->polizapagador->first()->nu_documento==$asegurados->nu_documento)
                               <span class="tag label label-info">
                                       YO
                                       @else
                                <span class="tag label label-primary">
                                        {{ strtoupper($asegurados->nb_nombre)." ".strtoupper($asegurados->nb_apellido) }}
                                   @endif

                               </span>&nbsp;
                            @endforeach
                        </td>
                        <td>{{  $bancos->get($item->polizaPagador->first()->banco_id)  }}</td>
                        <td>{{  $medios_pago->get($item->polizaPagador->first()->medio_pago_id)  }}</td>
                        <td>{{  $item->polizaPagador->first()->nu_medio_pago  }}</td>
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
                        var url= $obj.data('href').replace('::agente',$("#agente").val());
                        var jqxhr = $.get(url);
                        jqxhr.done(function(resul) {
                            $("#"+resul).fadeOut(1000,function () {
                                $("#"+resul).remove();
                                registrosNUm();
                            });
                        });
                    }else{
                        $(this).prop('checked',false);
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