<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="myTab">
    <li role="presentation" class="active"><a href="#pagador-poliza" aria-controls="pagador-poliza" role="tab" data-toggle="tab"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp; Pagador de la poliza</a></li>
    <li role="presentation"><a href="#aseguradospoliza" aria-controls="aseguradospoliza" role="tab" data-toggle="tab"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp; Asegurados Poliza</a></li>
    <!-- <li role="presentation"><a href="#beneficiarios" aria-controls="beneficiarios" role="tab" data-toggle="tab"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp; Beneficiarios</a></li> <!-- Nav tabs -->
    <li role="presentation"><a href="#riesgoasegurable" aria-controls="riesgoasegurable" role="tab" data-toggle="tab"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp; Datos de Riesgos Asegurables</a></li>
  </ul>
  <!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="pagador-poliza">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Gestionando Pagador de la poliza - <b>{{$clientes->cliente}}</b></h3>
                    </div>
                    <div id="notificacion-datos-pagador-poliza"></div>
                    @if($pagador_poliza==null)
                        {!!Form::open(['route'=>'datos-pagador-polizap', 'method'=>'POST','class'=>'from-data','id'=>'datos-pagador-poliza'])!!}
                    @else
                        {!!Form::model($pagador_poliza,['route'=> ['datos-pagador-poliza',$pagador_poliza->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-pagador-poliza'])!!}
                    @endif
                    <div class="box-body contrPagadorPoliza">
                            @include('back_end.ventas.form.form-pagador-poliza')
                            <?php  $class_direcciones="pagador-poliza";?>
                            @include('back_end.ventas.form.form-direcciones')
                        <br>
                        <div class="col-md-12 col-md-offset-5">
                            {!!Form::submit('Registrar',['class'=>'btn btn-primary','id'=>'btn_pagador'])!!}
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="aseguradospoliza">
         <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Listado </h3>
                    </div>
                    <div class="box-body listAseguradosPoliza">
                        @include('back_end.ventas.form.list-datos-asegurados-poliza')
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Asegurado Poliza - <b>{{$clientes->cliente}}</b> </h3>
                    </div>

                    @if($poliza_asegurados->count() == 0)
                        <div id="notificacion-datos-asegurado-poliza"></div>
                        {!!Form::open(['route'=>'datos-asegurado-polizap', 'method'=>'POST','class'=>'from-data','id'=>'datos-asegurado-poliza'])!!}
                        @else
                        <div id="notificacion-datos-asegurado-poliza-update"></div>
                        {!!Form::model($poliza_asegurados[0],['route'=> ['datos-asegurado-poliza',$poliza_asegurados[0]->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-asegurado-poliza-update'])!!}
                    @endif
                    <div class="box-body contrAseguradosPoliza">
                        @include('back_end.ventas.form.form-asegurados-poliza')
                        <?php  $class_direcciones="asegurados-poliza";?>
                        @include('back_end.ventas.form.form-direcciones')
                        <br>
                        <div class="col-md-12 col-md-offset-5">
                            {!!Form::submit('Registrar',['class'=>'btn btn-primary','id'=>'btnaseguradospoliza'])!!}
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>

    </div>
<!-- <div role="tabpanel" class="tab-pane" id="beneficiarios">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Beneficiarios de la poliza - <b>{{$clientes->cliente}}</b> </h3>
                    </div>
                    <div id="notificacion-datos-beneficiarios-poliza"></div>
                        {--Form::open(['route'=>'datos-beneficiariosp', 'method'=>'POST','class'=>'from-data','id'=>'datos-beneficiarios-poliza'])--}
                    <div class="box-body contrBeneficiariosPoliza">
                       {{-- @include('back_end.ventas.form.form-beneficiarios-poliza')--}}
                        <br>
                        <div class="col-md-12 col-md-offset-5">
                          {{-- {!!Form::submit('Registrar',['class'=>'btn btn-primary','id'=>'btnregistrar'])!!}
                        </div>
                    </div>
                    {!!Form::close()!!} --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Listado de Beneficiarios </h3>
                    </div>
                    <div class="box-body listBeneficiarios">
                     {{--  @include('back_end.ventas.beneficiarios.list-datos-beneficiarios') --}}
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div role="tabpanel" class="tab-pane" id="riesgoasegurable">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Datos de Riesgos Asegurables - <b>{{$clientes->cliente}}</b> </h3>
                    </div>
                    <div id="notificacion-datos-riesgos-asegurables"></div>
                    {!!Form::open(['route'=>'datos-riesgo-asegurablesp', 'method'=>'POST','class'=>'from-data','id'=>'datos-riesgos-asegurables'])!!}
                    <div class="box-body contrDatosRiesgoAsegurables">
                        @include('back_end.ventas.form.form-datos-riesgo-asegurables')
                        <br>
                        <div class="col-md-12 col-md-offset-5">
                            {!!Form::submit('Registrar',['class'=>'btn btn-primary','id'=>'btndatosriesgoasegurables'])!!}
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><b>C O B E R T U R A S</b> </h3>
                    </div>

                    <div class="box-body">
                        <table id="tab-coberturas"  class="display table table-hover"></table>
                    </div>
                </div>

            </div>
        </div>

    </div>




</div>

@include('back_end.combos')
<script type="text/javascript">
 // var  camposInput = ['nu_documento','nb_nombre','nb_apellido','ff_nacimiento','btnregistrar','edad','ff_registro','ff_ultima_actualizacion'];
 // var  campoSelect=['heredero_id','tipo_persona_id','nacionalidad_id','parentesco_id','tipobeneficiario_id'];
 // var  campoSelectCreate=['',''];



    $('.ff_nacimiento').datepicker({
        format: "dd-mm-yyyy",
        language: "es"
    });

 $(".telefonosmask").inputmask({"mask": "(9999)999.99.99"});

 $("#banco_id").change(function(){
     $("#medio_pago_id").removeAttr("disabled");
     $("#nu_medio_pago").val("");
     $("select#medio_pago_id").val("").attr("selected","selected");
 });


 $("#medio_pago_id").change(function(){
     $("#nu_medio_pago").val("");
     switch($(this).val()) {
         case "4":
             $("#nu_medio_pago").inputmask({"mask": "4999-9999-9999-9999"});
             $("#nu_medio_pago").removeAttr("disabled");
             break;
         case "3":
             $("#nu_medio_pago").inputmask({"mask": "5999-9999-9999-9999"});
             $("#nu_medio_pago").removeAttr("disabled");
             break;
         default:
             var jqxhr = $.get('cuenta-corriente/'+$("#banco_id").val());
             jqxhr.done(function(resul) {
                 var banco = resul.split(" ");
                 if(banco[0]!=0){
                     $("#nu_medio_pago,#medio_pago_id").removeAttr("disabled");
                     if($("#banco_id").val()==161)
                     {
                         $("#nu_medio_pago").inputmask({"mask": banco[1]+"-99-9999"});
                     }else{
                         if(banco[1]!=0){
                             $("#nu_medio_pago").inputmask({"mask": banco[1]+"-9999-99-9999999999"});
                         }else {
                             $("#nu_medio_pago").inputmask({"mask": "9999-9999-99-9999999999"});
                         }
                     }
                 }else{
                     $("#nu_medio_pago").attr("disabled","disabled");
                     $("#notificacion-tipo-cuenta").html(menj("rechazado","El banco seleccionado no permite Nro. de cuenta.")).show(500);
                     setTimeout(function () {
                         $("#notificacion-tipo-cuenta").hide(500);
                     },3000)
                 }

             });

     }


 });

 $(".tipo_persona_id").change(function(){activos($(this).val(),$(this).data('id'))});

 $('#datos-asegurado-poliza').find('input[name=ff_nacimiento]').focusout(function () {
     $("#edad").val(calcularEdad($(this).val()));
 });

 //$("#ff_nacimientoD").focusout(function(){$("#edadD").val(calcularEdad($(this).val()));});

    $('.formtelefono,.solonum').keypress(function(tecla) {
        if((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 0)) return false;
    });
  /*  $('input[name=copia_afiliado]').on("click", function(){


        if ($(this).val() == "S")
        {
            $.each(camposInput, function(i, val){
                $('#datos-afiliados').find('input[name='+val+']').val($('#datos-contratante').find('input[name='+val+']').val());
            });
            $.each(campoSelect, function(i, val){
                $('#datos-afiliados').find('select[name='+val+'] > option[value='+$('#datos-contratante').find('select[name='+val+']').val()+']').attr('selected', 'selected');
            });
            $.each(campoSelectCreate, function(i, val){
                $('#datos-afiliados').find('select[name='+val+']').append(new Option($('#datos-contratante').find('select[name='+val+'] option:selected').text(),$('#datos-contratante').find('select[name='+val+']').val(),1));
            });

            $("#edad").val(calcularEdad($("#ff_nacimiento").val()));
        }
        else
        {
            $.each(camposInput, function(i, val){
                $('#datos-afiliados').find('input[name='+val+']').val('');
            });
            $.each(campoSelect, function(i, val){
                $('#datos-afiliados').find('select[name='+val+'] option:first').attr('selected', 'selected');
            });
            $.each(campoSelectCreate, function(i, val){
                $('#datos-afiliados').find('select[name='+val+']').html(new Option('..::SELECCIONE::..',0,1));
            });
        }
    }); */
    function nuevoBeneficiario() {
         var  camposInput = ['nu_documento','nb_nombre','nb_apellido','ff_nacimiento','btnregistrar','edad','ff_registro','ff_ultima_actualizacion'];
         var  campoSelect=['heredero_id','tipo_persona_id','nacionalidad_id','parentesco_id','tipobeneficiario_id'];
        $("#btnregistrar").removeAttr("disabled");
        $.each(camposInput, function(i, val){
            $('#datos-beneficiarios-poliza').find('input[name='+val+']').val('');
            $('#datos-beneficiarios-poliza').find('input[name='+val+']').removeAttr("disabled");
        });
        $.each(campoSelect, function(i, val){
            $('#datos-beneficiarios-poliza').find('select[name='+val+'] option:first').attr('selected', 'selected');
            $('#datos-beneficiarios-poliza').find('select[name='+val+']').removeAttr("disabled");
        });
      /*  $.each(campoSelectCreate, function(i, val){
            $('#datos-beneficiarios-poliza').find('select[name='+val+']').html(new Option('..::SELECCIONE::..',0,1));
            $('#datos-beneficiarios-poliza').find('select[name='+val+']').removeAttr("disabled");
        });*/
        // $(".btnnuevobeneficiario").attr("disabled","disabled");
    }
    function nuevoDatoRiesgoAsegurable() {
     var  camposInput = ['nu_documento','nb_nombre','nb_apellido','ff_nacimiento','btndatosriesgoasegurables','edad','ff_registro','ff_ultima_actualizacion'];
     var  campoSelect=['nacionalidad_id','parentesco_id','tipo_riesgo_id'];
     $("#btndatosriesgoasegurables").removeAttr("disabled");
     $.each(camposInput, function(i, val){
         $('#datos-riesgos-asegurables').find('input[name='+val+']').val('');
         $('#datos-riesgos-asegurables').find('input[name='+val+']').removeAttr("disabled");
     });
     $.each(campoSelect, function(i, val){
         $('#datos-riesgos-asegurables').find('select[name='+val+'] option:first').attr('selected', 'selected');
         $('#datos-riesgos-asegurables').find('select[name='+val+']').removeAttr("disabled");
     });


 }
    function nuevoAseguradoPoliza() {
        var  camposInput = ['nb_nombre','nu_documento','nb_apellido','ff_nacimiento','nu_hijos','email','nu_tlf_celular','nb_empresa','nb_cargo','nu_ingresos','nu_tlf_oficina1','nu_tlf_oficina2','nu_tlf_hogar','nu_capital_promedio','nb_parroquia','co_postal','tx_avenida_calle','tx_urbanizacion_direccion','nb_edificio_casa','nu_piso','nu_casa','btnaseguradospoliza'];
        var  campoSelect=['nacionalidad_id','tipo_persona_id','nivel_educativo_id','ocupacion_id','sexo_id','estadocivil_id','activida_economica_id','pais_id','estado_id','ciudad_id','municipio_id'];
        $("#btnnuevoaseguradopoliza").removeAttr("disabled");
        $.each(camposInput, function(i, val){
            $('#datos-asegurado-poliza').find('input[name='+val+']').val('');
            $('#datos-asegurado-poliza').find('input[name='+val+']').removeAttr("disabled");
        });
        $.each(campoSelect, function(i, val){
            $('#datos-asegurado-poliza').find('select[name='+val+'] option:first').attr('selected', 'selected');
            $('#datos-asegurado-poliza').find('select[name='+val+']').removeAttr("disabled");
        });
    }

</script>


