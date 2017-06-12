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
{!! Form::open(['route' =>['ramos',':ramo_ID',':ramo_cliente'], 'method' => 'POST','id'=>'from-ramos']) !!}
{!! Form::close() !!}
{!! Form::open(['route' =>['producto',':producto_ID',':producto_cliente'], 'method' => 'POST','id'=>'from-producto']) !!}
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
        url=url.replace(':ramo_cliente',$("#ramo_cliente").val());
        $("#ramo_id").html('');
        $("#ramo_id").append(new Option('..:: SELECCIONE ::..',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#ramo_id").append(new Option(respuesta[i].nb_ramo,respuesta[i].id));
            }
        });
    });

    $("#ramo_id").change(function(){
        var from=$('#from-producto');
        var url= from.attr('action').replace(':producto_ID',$(this).val());
        url=url.replace(':producto_cliente',$("#producto_cliente").val());
        $("#producto_id").html('');
        $("#producto_id").append(new Option('..:: SELECCIONE ::..',''));
        $.get(url,function(respuesta,estado){
            for(i=0; i < respuesta.length; i++){
                $("#producto_id").append(new Option(respuesta[i].nb_producto,respuesta[i].id));
            }
        });
    });

    $("#producto_id").change(function(){
        $("#plan_id").html('');
        $("#plan_id").append(new Option('..:: SELECCIONE ::..',''));
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
                $("#tab-coberturas").append("<tr class='list-coberturas'>" +
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
        $(".asegurados").remove();
        $("#tarifario_id").val("");
        $.get(url,function(respuesta,estado){

            if(respuesta.length!=0)
            {
                for(i=0; i < respuesta.length; i++){

                    var Nombres= [];
                    var idAsegurados= [];
                    var ffnacimiento;
                    var arrEdades = [];
                    var $elementos = $('.EdadAsegurados');
                    var edad;
                    var tipoPersona;
                    //EXTRAIGO LOS VALORES DE LOS ASEGURADOS EN CUESTION DE LA VISTA list-datos-asegurados-poliza
                    $.each($elementos, function (i, val) {
                        edad = $(val).parent().data('edad');
                        Nombres.push($(val).parent().data('nombre'));
                        ffnacimiento = $(val).parent().data('nacimiento');
                        idAsegurados.push($(val).parent().data('idasegurado'));
                        tipoPersona = $(val).parent().data('tipopersona');
                        //SI EL ASEGURADO ES UNA PERSONA NATURAL ENTRA ENTRA EN EL ARRAY PARA VALIDAR SI CUMPLE CONE L RANGO
                        if(tipoPersona=="N")
                        {
                            if (edad !=0)
                                arrEdades.push(edad);
                            else
                                arrEdades.push(calcularEdad(ffnacimiento));
                        }
                    });

                    //DETERMINAR SI TODOS LOS BENEFICIARIOS REGISTRADOS CUMPLEN CON LA EDAD NECESARIA
                    // SI LA TARIFA CORRESPONDIENTE TIENE EN CUENTA APLICAR DISCRIMINACION DE EDADES
                    if(respuesta[i].aplica_rango==1)
                    {
                        var Mensaje=" NO CUMPLE CON LOS RANGO DE EDAD.<br>";
                        var err=null;

                        //VALIDACION PARA VERIFICAR SI EL ASEGURADO EN CUESTION CUMPLE CON LA EDAD PARAMETRIZADA EN LA TARIFA.
                        arrEdades.forEach(function (valor,key) {
                            // SI EL RANGO MINIMO Y MAXIMO NO CONCUERDAN CON LA EDAD ARMO EL MENSAJE Y NO LO DEJO CONTINUAR
                            if((valor < respuesta[i].rangoedad.minimo) || (valor > respuesta[i].rangoedad.maximo))
                            {
                                err=1;
                                Mensaje= Mensaje+ '</br> - El asegurado <b>' + Nombres[key] + '</b> no cumple con la edad mínima <b>' +respuesta[i].rangoedad.minimo +'</b> o la edad máxima: <b>'+respuesta[i].rangoedad.maximo+'</b>';
                            }
                        });

                        if(err==1){
                            $("#notificacion-datos-riesgos-asegurables").html(menj("rechazado",Mensaje)).show(500);
                            $("select#frecuencia_pago_id,select#plan_id").val("").attr("selected","selected");
                            setTimeout(function () {
                                $("#notificacion-datos-riesgos-asegurables").hide(1500);
                                return false;
                            },5000);


                        }

                    }
                    //MOSTRAR RESUMEN SUMANDO EL TOTAL A PAGAR
                    //SI ES 1 SE MOSTRARA SUMANDO LOS ASEGURADOS
                    // DE LO CONTRARIO MOSTRARA EL MONTO NETO DE LA TARIFA SIN HACER OPERACIONES MATEMATICAS
                    //EN LA BASE DE DATOS SE GUARDARA EL MONTO TOTAL SEGUN LA COFIGURACION DEL SISTEMA
                   if(respuesta[i].suma_total_asegurados==1)
                   {
                       //VERIFICO SI EXISTEN ASEGURADOS SET EN LAS VARIABLES
                       //EN CASO DE QUE NO SETEO LOS CONTROLES PARA QUE CARGE LOS ASEGURADOS EN CASO DE QUE EXISTEM
                       //SI NO EXISTEN EN EL CONTROLADOR SE VALIDARA ESO Y SE RETORA UN MENSAJE INDICANDO QUE DEBE REGISTRAR 1 ASEGURADO
                       if(Nombres.length>0)
                       {
                           $("#tab-coberturas").append("<tr class='asegurados'>" +
                                   "<th colspan='1'></th>" +
                                   "<th colspan='2'>ASEGURADOS</th>" +
                                   "<th>VALOR PRIMA</th>" +
                                   "</tr>");

                           Nombres.forEach(function (valor,key) {
                               $("#tab-coberturas").append("<tr class='asegurados'>" +
                                       "<th colspan='1'></th>" +
                                       "<td colspan='2' class='text-info'>"+ valor +"</td>" +
                                       "<td class='text-center'>"+ respuesta[i].prima+"</td>" +
                                       "</tr>");
                           });


                           $("#tab-coberturas").append("<tr class='asegurados'>" +
                                   "<td colspan='4'><hr></td>" +
                                   "</tr>"+
                                   "<tr id='primatotal'>" +
                                   "<th colspan='2'></th>" +
                                   "<th>TOTAL PRIMA:</th>" +
                                   "<th class='label-success text-center'>"+ respuesta[i].prima * $elementos.length +"</th>" +
                                   "</tr>");
                           //VALOR PRIMA GLOBAL POR TODOS LOS ASEGURADOS
                           $("#valor_prima_golbal").val(respuesta[i].prima * $elementos.length);
                       }else{
                           $("#notificacion-datos-riesgos-asegurables").html(menj("rechazado","Debe registrar al menos (1) Asegurado")).show(500);
                           $("select#frecuencia_pago_id,select#plan_id").val("").attr("selected","selected");
                           setTimeout(function () {
                               $("#notificacion-datos-riesgos-asegurables").hide(500);

                               $(".list-coberturas").hide(2000);
                               return false;
                           },5000);

                       }



                   }else{

                       $("#tab-coberturas").append("<tr class='asegurados'>" +
                               "<th colspan='3'></th>" +
                               "<th>VALOR PRIMA</th>" +
                               "</tr>");

                       $("#tab-coberturas").append("<tr class='asegurados'>" +
                               "<th colspan='3'></th>" +
                               "<th CLASS='text-center'>"+ respuesta[i].prima +"</span></th>" +
                               "</tr>");

                       $("#tab-coberturas").append("<tr class='asegurados'>" +
                               "<td colspan='4'><hr></td>" +
                               "</tr>"+
                               "<tr id='primatotal'>" +
                               "<th colspan='2'></th>" +
                               "<th>TOTAL PRIMA:</th>" +
                               "<th class='label-success text-center'>"+ respuesta[i].prima+"</th>" +
                               "</tr>");
                       //SET EN CASO DE QUE TENGA ALGUN OTRO VALOR
                       $("#valor_prima_golbal").val(respuesta[i].prima);

                   }
                    //VALOR DE LA PRIMA UNITARIA
                    $("#valor_prima").val(respuesta[i].prima);
                    //CONTEMPLA EL ID DE LA TARIFA
                    $("#tarifario_id").val(respuesta[i].id);
                    //CONTEMPA LA CANTIDAD MINIMA DE BENEFICIARIOS QUE DEBEN EXISTIR
                    //SOLO ES REFERENCIAL PARA TENER A MANO NO SE UTLIZA EN EL CONTROLADOR
                    $("#nu_beneficiarios_requeridos").val(idAsegurados.length);
                    // ID DE ASEGURADOS EXISTENTES EN EL PROCESO
                    $("#asegurados_id").val(idAsegurados.toString());
                    //RESCATO EL ID DEL PAGADOR DE LA POLIZA UBICADO EN CREATE PARA ENVIARLO CON EL REQUEST
                    $("#pagadorpli").val($("#idPolizaPagadorCrorl").val());
                }
            }else{
                $("select#frecuencia_pago_id").val("").attr("selected","selected");
                $("#tab-coberturas").append("<tr id='primatotal'>" +
                        "<th colspan='2'><span class='text-red'>No aplica para la campaña esta fecuencia de pago</span></th>" +
                        "</tr>");
            }

        });
    });

</script>

