<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">
            <i class="{{$icon}} text-blue"></i> Listados de clientes - <label  class="text-bold text-blue">{{$carpeta}}</label>
        </h4>
    </div>
    <div class="box-body">
        @if(count($data) >  0)

            @if(isset($agentes))
                <div class="form-group col-xs-12">
                    <apan style="color:red">*</apan> {!!Form::label('agente','Seleccione un agente:')!!}
                    {!!Form::select('agente',$agentes, null, ['id' => 'agente','class' => 'form-control','placeholder'=>'..::SELECCIONE::..','required'=>'required'] )!!}
                </div>
            @endif

            <table id="tabla_gestion" class="display table table-hover" cellspacing="0" width="100%">
                <tr>
                    <th>Id-BBD</th>
                    @if($data[0]->status_id==5) <th>Última Agenda</th> @endif
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Nro. Principal</th>
                    <th>FF Registro</th>
                    @if(Auth::user()->tipo!="AGENTES" && $data[0]->status_id!=null)
                        <th>Agente</th>
                        @else
                        <th>Lote</th>
                    @endif

                    <th class="text-center">@if($data[0]->status_id!=null) Acción @else <input class="todos_asignar" type="checkbox"> @endif</th>
                </tr>



                @foreach($data as $item)
                    <tr style="" id="{{ $item->id }}"  data-id="{{ $item->id }}" data-href="asignar-individual/{{ $item->id }}/::agente">
                        <td class="text-center">{{ $item->id }}</td>
                        @if($item->status_id==5)
                            <td class="text-bold">
                               @if($item->agendamientos->count() > 0)
                                    <span class="text-blue" style="font-size: 12px"> {{ date('d-m-Y g:i a',strtotime($item->agendamientos()->orderby('created_at','desc')->first()->ff_hh_agendado)) }} </span>
                                  @else
                                    <span class="text-red">Sin Fecha N/A</span>
                               @endif
                            </td>
                        @endif
                        <td>{{ $item->documento }}</td>
                        <td>{{ $item->cliente }}</td>
                        <td>{{ $item->telefono1 }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        @if($item->status_id!=null)
                            @include('back_end.gestion.acciones')
                            @else
                            <td>Nro.{{$item->lotes->id}} {{$item->lotes->name}}</td>
                        <td  class="text-center conteck"><input id="ck-{{ $item->id }}" class="accion_asignar" type="checkbox"></td>

                        @endif

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


                $('.todos_asignar').on("click", function(){
                    if($("#agente").val()!="") {
                        var $elementos = $('.conteck');
                        var ids = [];
                        var url;
                        var id;
                        $.each($elementos, function (i, val) {
                            url = $(val).parent().data('href').replace('::agente', $("#agente").val());
                            id = $(val).parent().data('id');
                            var visible = $(val).parent().attr('style');
                            if (visible != "display: none;") {
                                $("#ck-" + id).prop('checked', true);
                                ids.push([id]);
                            }
                        });
                        var datos = ids.toString()
                        var cadena = "";
                        for (var i = 0; i < datos.length; i++) {
                            cadena += datos[i].replace(',', '-');
                        }
                        url = url.replace(id, cadena);
                        var jqxhrs = $.get(url);
                        jqxhrs.done(function (resul) {
                            $.each(resul, function (i, val) {
                                $("#" + val).fadeOut(1000, function () {
                                    $("#" + val).remove();
                                });
                            });
                            $('.todos_asignar').prop('checked',false);
                            registrosNUm();
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
    </div>
</div>