function irarriba(){
    $('html, body').animate({scrollTop:0}, 300);
}

function cargarlistado(ruta,obj){

    if(obj==undefined)  $("#contenido_principal").fadeOut(500,function () {
        $("#cargador_empresa").fadeIn(200,function () {
            var jqxhr = $.get(ruta,function(resul){
                $("#cargador_empresa").fadeOut(1200,function () {
                    if(typeof resul=="string") $("#contenido_principal").html(resul).fadeIn(1500);
                });//CIEERE PARA DESPUES QUE HACE LA OPERACION AJAX MUESTRE LOS RESULTADOS
            });

            jqxhr.fail(function(resul) {
                $("body").html(resul.responseText);
            });

        });//CIERRE DESPUES QUE CARGA EL PRELODER
    })/*//CIERRE DE CUANDO SE OCULTA EL CONTENIDO PRINCIPAL*/

    if(obj!=undefined) var jqxhr = $.get(ruta,function(resul){nroRegistros(resul); });

}


function modalFicha(arr) {
    $("#usuario_seleccionado").val(arr[0]);
    $("#capa_modal").show();
    $("#capa_para_edicion").show();
    $("#contenido_capa_edicion").html($("#cargador_empresa").html()).fadeOut(1000,function () {
        var jqxhr = $.get(arr[1]+"/"+arr[0],function(resul){
            $("#contenido_capa_edicion").html(resul).fadeIn(1000);
        });

        jqxhr.fail(function(resul) {
            $("body").html(resul.responseText);
        });

        irarriba();
    });

}
$(document).on("submit",".from-data",function(e){
    e.preventDefault();
    $('html, body').animate({scrollTop: '0px'}, 200);
    var frm=$(this);
    var id=$(this).attr("id");
    var ruta=$(this).attr("action");

    $("#notificacion-"+id).html($("#cargador_empresa").html());

    $.ajax({
        type: "POST",
        url : ruta,
        datatype:'json',
        data : frm.serialize(),
        success : function(resul){

            switch(id){
                //FORMULARIO DE TIPIFICACIÓN
                case "datos-gestion":

                    $('div.form-group > input[type="text"],input[type="radio"],input[type="submit"],select,textarea').attr("disabled","disabled");
                    $("#menj-globar").html(menj(resul.tipo,resul.menj)).show(500);
                    if(typeof resul.ruta !="undefined") cargarlistado(resul.ruta);
                    setTimeout(function () {
                        cargarlistado('nro-registros','obj'); //CALCULAR LA CANTIDAD DE REGISTROS PARA EL MENU HOME.
                        $("#menj-globar").hide(500);
                        // SI TENEMOS ERROR CON LOS NUMEROS HABILITA LOS CAMPOS DE NUEVO
                        if(typeof resul.no_nro !="undefined")  $('div.form-group > input[type="text"],input[type="radio"],input[type="submit"],select,textarea').removeAttr("disabled");
                        if(typeof resul.accion !="undefined") if(resul.accion=="SI") modalFicha([resul.id,resul.nb_accion]);
                    ;},3000);
                    break;

                //FORMULARIO DATOS BENEFICIARIOS POLIZA
                case "datos-beneficiarios-asegurados":
                    if(resul.hinabilty=="S")
                    {
                        var  $nodes  = $('.contrBeneficiariosAseguradosPoliza').children();
                        $($nodes).children().each(  function(i,val) {
                            if(val!=undefined)  $(val).attr("disabled","disabled");
                        });

                    }
                    $("#notificacion-"+id).html(menj(resul.tipo,resul.menj)).show(500);
                    setTimeout(function () {
                        $("#notificacion-"+id).hide(500);
                        $(".btnnuevobeneficiario").removeAttr("disabled");
                        if(resul.hinabilty=="S")
                        {
                            $.get(resul.list,function(resulda){
                                $(".listBeneficiarios").html(resulda);
                            });
                        }
                    },3000);
                    break;

                case "datos-asegurado-poliza":
                    if(resul.hinabilty=="S")
                    {
                        var  $nodes  = $('.contrAseguradosPoliza').children();
                        $($nodes).children().each(  function(i,val) {
                            if(val!=undefined)  $(val).attr("disabled","disabled");
                        });
                    }
                    $("#notificacion-"+id).html(menj(resul.tipo,resul.menj)).show(500);
                    setTimeout(function () {
                        $("#notificacion-"+id).hide(500);
                        $(".btnnuevoaseguradopoliza").removeAttr("disabled");
                        if(resul.hinabilty=="S") {
                            $.get(resul.list, function (resulda) {
                                $(".listAseguradosPoliza").html(resulda);
                            });
                        }
                    },3000);
                    break;

                case "datos-asegurado-poliza-update":
                    var  $nodes  = $('.contrAseguradosPoliza').children();
                    $($nodes).children().each(  function(i,val) {
                        if(val!=undefined)  $(val).attr("disabled","disabled");
                    });
                    $("#notificacion-"+id).html(menj(resul.tipo,resul.menj)).show(500);
                    setTimeout(function () {
                        $("#notificacion-"+id).hide(500);
                        $(".btnnuevoaseguradopoliza").removeAttr("disabled");
                        
                    },3000);
                    break;

                case "datos-pagador-poliza":
                    if(resul.hinabilty=="S")
                    {
                        var  $nodes  = $('.contrPagadorPoliza').children();
                        $($nodes).children().each(  function(i,val) {
                            if(val!=undefined)  $(val).attr("disabled","disabled");
                        });
                    }
                    $(".btnnuevoaseguradopoliza").removeAttr("disabled");


                    $("#notificacion-"+id).html(menj(resul.tipo,resul.menj)).show(500);
                    setTimeout(function () {
                        $("#notificacion-"+id).hide(500);
                    },10000);
                    break;

                case "datos-txt":
                    $("#contenido_principal").html(resul).fadeIn(1500);
                    break;

                default:
                    $("#notificacion-"+id).html(menj(resul.tipo,resul.menj)).show(500);
                    setTimeout(function () 
                     {$("#notificacion-"+id).hide(500);
                         setTimeout(function () {
                             if(typeof resul.ruta !="undefined") cargarlistado(resul.ruta);
                             if (typeof $("#btnaseguradospoliza") != undefined){
                                 $("#btnaseguradospoliza").attr("disabled","disabled");
                             }
                         },2000)
                    },3000);


            }
        },

        error:function (data,textStatus,errorThrown) {

            $("body").html(data.responseText);
          /*  $("#notificacion-"+id).html("");
            $.each(data.responseJSON, function(i,item){
                $("#notificacion-"+id).html(menj('rechazado',item));
            });*/
        }
        /*statusCode: {
            500: function() {
                alert( "page not found" );
            }
        }*/
    });
});
menj("rechazado",menj)

function menj(tipo,menj){

    switch(tipo){
        case "aprobado":
            return "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button> <strong>EXCELENTE !!!</strong> - "+menj+"</div>"
            break;

        case "rechazado":
            return "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button> <strong>UPS !!!</strong> - "+menj+"</div>"
            break;
    }
}

$(document).on("dblclick",".div_modal",function(e){
    //funcion para ocultar las capas modales
    $("#capa_modal").hide();
    $("#capa_para_edicion").hide();
    $("#contenido_capa_edicion").html("");

});


function nroRegistros(obj) {
    var nro;
    $.each(obj,function(i,val) {
       nro= (val>0) ? val : "";
        $("#nro-home-"+i).html(nro);
    });
}

//FUNCION PARA EL MANEJO DE APERTURA DE TELEFONO SEFUN TIPIFIACION SELECCIONADA
var Desbloqueo = [];
function aperturas() {
    var from=$('#from-aperturas');
    var url= from.attr('action').replace(':tpfnivel1_ID', $("#tpfnivel1_id").val());
    url=url.replace(':tpfnivel2_ID', $("#tpfnivel2_id").val().replace('',":eliminame:"));
    url=url.replace(':tpfnivel3_ID', $("#tpfnivel3_id").val().replace('',":eliminame:"));
    url=url.replace(':tpfnivel4_ID', $("#tpfnivel4_id").val().replace('',":eliminame:"));
    var jqxhr = $.get(url);
    jqxhr.done(function(resul) {
        if(resul.length>0)
        {

            //RECORREMOS LOS ELEMENTOS HTML QUE CONTIENEN TOQUES REGISTRADOS EN LA BASE DE DATOS
            Desbloqueo = [];
            var elementos = $('.aperturas');

            $.each( elementos, function(i, val){
                /*VARIABLES CON LA DATA SENSIBLE
                 idControl: ID DEL INPUT
                 max: maximo de toques permitidos
                 toques: toques registrados en el telefono correspondiente
                 */
                //  var =$(val).parent().attr('');

                var idControl=$(val).parent().data('id');
                var max=$(val).parent().data('max');
                var toques=$(val).parent().data('toque');

                //CONTROLAMOS LAS APERTURAS DE LOS TELEFONOS SEGUN LA TIPIFICACION SELECCIONADA

                if((toques >= max) && (toques < resul[0].toque_apertura))
                {
                    $("#"+idControl).removeAttr("disabled");
                    $("#"+idControl+"-rad").removeAttr("disabled");
                    //CONTIENE UN ARREGLO CON EL NOMBRE DEL CONTRO, TOQUES MAXIMOS PERMITIDOS,TOQUES REGISTRADOS HASTA EL MOMENTO, MAXIMO APERTURA
                    Desbloqueo.push({control:idControl,max:max,toque:toques,apertura:resul[0].toque_apertura});
                }
            });

        }else{
            //BLOQUEAR ELEMENTOS NUEVAMENTE EN CASO DE QUE CAMBIE LA TIPIFICACIÓN
            if(Desbloqueo.length>0)
            {
                $.each( Desbloqueo, function(i, val){
                    $("#"+val.control).attr("disabled","disabled");
                    $("#"+val.control+"-rad").attr("disabled","disabled");
                    $("#"+val.control+"-rad").prop("checked", false);
                });
            }
        }

    });
    jqxhr.fail(function(resul) {

    });
    jqxhr.always(function(resul) {
    });
}

//funcion que me permite calcular la edad de una persona
//recibe la fecha como un string en formato dd-mm-yyyy
function calcularEdad(fecha)
{

    if(fecha==0)
        return false;


    var edad = 0;
    //capturamos la fecha de hoy
    hoy=new Date()


    diaActual = hoy.getDate();
    // al mes le sumamos 1 ya que los meses javascript los muestra como un array de 0 a 11
    mesActual = hoy.getMonth() + 1;
    yearActual = hoy.getFullYear();
    //le concateno un 0 al dia y al mes cuando son menor que diez
    if(diaActual < 10) { diaActual = '0' + diaActual; }
    if(mesActual < 10) { mesActual = '0' + mesActual; }
    //alert('dia '+diaActual +'del mes ' + mesActual + 'del año '+ yearActual)

    //capturo la fecha que recibo
    //La descompongo en un array
    var array_fecha = fecha.split("-")
    dia = array_fecha[0];
    mes = array_fecha[1];
    year = array_fecha[2];

    //Valido que la fecha de nacimiento no sea mayor a la fecha actual
    if(year >= yearActual)
    {
        alert('La fecha de nacimiento no puede ser mayor a la fecha actual');
        //return;
    }

    else if ( (mes >= mesActual) && (dia > diaActual) )
    {

        edad = (yearActual  - 1 ) - year;
    }
    else
    {
        edad = yearActual - year;
    }

    return edad;
}



function isEmptyJSON(obj) {
    for(var i in obj) { return false; }
    return true;
}


// id = ID DEL CONTROL
// value = valor del campo dependiente
// $auto= valor para el auto select
// $metodo = nombre del metodo a ejecutar en el controlador
//$capa = nombre de la campa donde esta el control. NODO PADRE
function Combos($id,$value,$metodo,$auto,$capa){

    $('#'+$capa).find('select[name='+$id+']').html(new Option('..:: SSELECCIONE ::..','0'));
   // $('#'+$id).html(new Option('..:: SELECCIONE ::..','0'));
    var from=$('#from-autocombo');
    var url= from.attr('action').replace(':id_ID',$value);
    url=url.replace(':funcion_ID',$metodo);
    $.get(url,function(respuesta,estado){
        if(isEmptyJSON(respuesta)==false)
        {
            for(i=0; i < respuesta.length; i++){
                if($auto==respuesta[i].valor)
                {
                    $('#'+$capa).find('select[name='+$id+']').append(new Option(respuesta[i].nombre,respuesta[i].valor,true,true));
                    //$('#'+$id).append(new Option(respuesta[i].nombre,respuesta[i].valor,true,true));
                }else{
                    //$('#'+$id).append(new Option(respuesta[i].nombre,respuesta[i].valor));
                    $('#'+$capa).find('select[name='+$id+']').append(new Option(respuesta[i].nombre,respuesta[i].valor));
                }
            }
        }
    });
}

function activos(TipoPerson,idForm)
{
    var $naturales= $('#'+idForm).find(".natural");
    var $empresas =$('#'+idForm).find(".empresa");

    if(TipoPerson=="L")
    {
        $naturales.attr("disabled","disabled");
        $naturales.removeAttr("required");
        $naturales.val("");
        $empresas.removeAttr("disabled");
        $empresas.attr("required","required");
    }else{
        $naturales.removeAttr("disabled");
        $naturales.attr("required","required");
        $empresas.attr("disabled","disabled");
        $empresas.removeAttr("required");
        $empresas.val("");
    }
}














