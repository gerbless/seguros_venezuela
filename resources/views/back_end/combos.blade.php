{!! Form::open(['route' =>['tpfnivel1',':tpfnivel1_ID'], 'method' => 'POST','id'=>'from-tpfnivel1']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['tpfnivel2',':tpfnivel2_ID'], 'method' => 'POST','id'=>'from-tpfnivel2']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['tpfnivel3',':tpfnivel3_ID'], 'method' => 'POST','id'=>'from-tpfnivel3']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['aperturas',':tpfnivel1_ID',':tpfnivel2_ID',':tpfnivel3_ID',':tpfnivel4_ID'], 'method' => 'POST','id'=>'from-aperturas']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['ciudad',':ciudad_ID'], 'method' => 'POST','id'=>'from-ciudad']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['municipio',':municipio_ID'], 'method' => 'POST','id'=>'from-municipio']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['ramos',':ramo_ID'], 'method' => 'POST','id'=>'from-ramos']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['producto',':producto_ID'], 'method' => 'POST','id'=>'from-producto']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['plan',':plan_ID',':plan_cliente'], 'method' => 'POST','id'=>'from-plan']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['coberturas',':coberturas_ID'], 'method' => 'POST','id'=>'from-coberturas']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['tarifario',':campana_ID',':ramo_ID',':producto_ID',':plan_ID',':frecuencia_pago_ID'], 'method' => 'POST','id'=>'from-tarifario']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['autocombo',':id_ID',':funcion_ID'], 'method' => 'POST','id'=>'from-autocombo']) !!}
{!! Form::close() !!}

<script>
    $("#tpfnivel1_id").change(function(){
        var from=$('#from-tpfnivel1');
        var url= from.attr('action').replace(':tpfnivel1_ID',$(this).val());
        $("#tpfnivel2_id").html('');
        $("#tpfnivel2_id").append(new Option('SELECCIONE  TIPIFICACIÓN',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#tpfnivel2_id").append(new Option(respuesta[i].nb_tpfnivel2,respuesta[i].id));
            }
        });
        aperturas();
    });

    $("#tpfnivel2_id").change(function(){
        $("#tpfnivel3_id").removeAttr("required");
        var from=$('#from-tpfnivel2');
        var url= from.attr('action').replace(':tpfnivel2_ID',$(this).val());
        $("#tpfnivel3_id").html('');
        $("#tpfnivel3_id").append(new Option('SELECCIONE  TIPIFICACIÓN',''));

        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#tpfnivel3_id").append(new Option(respuesta[i].nb_tpfnivel3,respuesta[i].id));
            }
            if(respuesta.length > 0) $("#tpfnivel3_id").attr("required","required");
        });
        aperturas();
    });

    $("#tpfnivel3_id").change(function(){
        $("#tpfnivel4_id").removeAttr("required");
        var from=$('#from-tpfnivel3');
        var url= from.attr('action').replace(':tpfnivel3_ID',$(this).val());
        $("#tpfnivel4_id").html('');
        $("#tpfnivel4_id").append(new Option('SELECCIONE  TIPIFICACIÓN',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#tpfnivel4_id").append(new Option(respuesta[i].nb_tpfnivel4,respuesta[i].id));
            }
            if(respuesta.length > 0) $("#tpfnivel4_id").attr("required","required");
        });
        aperturas();
    });

    $("#tpfnivel4_id").change(function(){aperturas();});

    $(".estado-pagador-poliza,.estado-asegurados-poliza").change(function(){
        var from=$('#from-ciudad');
        var fromM=$('#from-municipio');
        var classe=$(this).data('id');
        var url= from.attr('action').replace(':ciudad_ID',$(this).val());
        var urlM= fromM.attr('action').replace(':municipio_ID',$(this).val());
        $("."+classe).html('');
        $("."+classe.replace('ciudad',"municipio")).html('');
        $("."+classe).append(new Option('..::SELECCIONE::..',''));
        $("."+classe.replace('ciudad',"municipio")).append(new Option('..::SELECCIONE::..',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("."+classe).append(new Option(respuesta[i].nb_ciudad,respuesta[i].id));
            }
        });

        $.get(urlM,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("."+classe.replace('ciudad',"municipio")).append(new Option(respuesta[i].nb_municipio,respuesta[i].id));
            }
        });
    });

    $("#campana_id").change(function(){
        var from=$('#from-ramos');
        var url= from.attr('action').replace(':ramo_ID',$(this).val());
        $("#ramo_id").html('');
        $("#ramo_id").append(new Option('SELECCIONE  RAMOS',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#ramo_id").append(new Option(respuesta[i].nb_ramo,respuesta[i].id));
            }
        });
    });

    $("#ramo_id").change(function(){
        var from=$('#from-producto');
        var url= from.attr('action').replace(':producto_ID',$(this).val());
        $("#producto_id").html('');
        $("#producto_id").append(new Option('SELECCIONE  PRODUCTO',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#producto_id").append(new Option(respuesta[i].nb_producto,respuesta[i].id));
            }
        });
    });

    $("#producto_id").change(function(){
        $("#plan_id").html('');
        $("#plan_id").append(new Option('SELECCIONE  PLAN',''));
        var from=$('#from-plan');
        var url= from.attr('action').replace(':plan_ID',$(this).val());
        url=url.replace(':plan_cliente',$("#plan_cliente").val());
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#plan_id").append(new Option(respuesta[i].nb_plan,respuesta[i].id));
            }
        });
    });


    $("#plan_id").change(function(){
        var from=$('#from-coberturas');
        var url= from.attr('action').replace(':coberturas_ID',$(this).val());
        $("#tab-coberturas").html("");
        $.get(url,function(respuesta,estado){
            $("#tab-coberturas").append("<tr>" +
                    "<th>COBERTURA</th>" +
                    "<th>SUMA ASEGURADA</th>" +
                    "<th>PRIMA</th>" +
                    "<th>TASA</th>" +
                    "</tr>");
            for(i=0; i < respuesta.length; i++){
                $("#tab-coberturas").append("<tr>" +
                          "<td>"+ respuesta[i].nb_cobertura +"</td>" +
                          "<td>"+ respuesta[i].suma_asegurada +"</td>" +
                          "<td>"+ respuesta[i].prima +"</td>" +
                          "<td>"+ respuesta[i].tasa +"</td>" +
                        "</tr>");
            }
        });
    });

    $("#frecuencia_pago_id").change(function(){
        var from=$('#from-tarifario');
        var url= from.attr('action').replace(':campana_ID',$("#campana_id").val());
        url=url.replace(':ramo_ID',$("#ramo_id").val());
        url=url.replace(':producto_ID',$("#producto_id").val());
        url=url.replace(':plan_ID',$("#plan_id").val());
        url=url.replace(':frecuencia_pago_ID',$("#frecuencia_pago_id").val());
        $("#primatotal").remove();
        $("#tarifario_id").val("");
        $.get(url,function(respuesta,estado){

            if(respuesta.length!=0)
            {
                for(i=0; i < respuesta.length; i++){
                    $("#tab-coberturas").append("<tr id='primatotal'>" +
                            "<th>PRIMA:</th>" +
                            "<th>"+ respuesta[i].prima +"</th>" +
                            "</tr>");

                    $("#tarifario_id").val(respuesta[i].id);
                    $("#valor_prima").val(respuesta[i].prima);
                }
            }else{
                $("#tab-coberturas").append("<tr id='primatotal'>" +
                        "<th colspan='2'><span class='text-red'>No aplica para la campaña esta fecuencia de pago</span></th>" +
                        "</tr>");
            }

        });
    });

</script>

