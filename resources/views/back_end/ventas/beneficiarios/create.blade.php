<ul class="nav nav-tabs" role="tablist" id="myTab">
    <li role="presentation" class="active"><a href="#beneficiarios" aria-controls="beneficiarios" role="tab" data-toggle="tab"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp; Beneficiarios</a></li>
    <li role="presentation"><a href="#list-beneficiarios" aria-controls="list-beneficiarios" role="tab" data-toggle="tab"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp; Listado de Beneficiarios</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="beneficiarios">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Beneficiarios</b> </h3>
                    </div>
                    <div id="notificacion-datos-beneficiarios-asegurados"></div>
                    <div class="form-group col-xs-2">
                        <button onclick="modalFicha([{{ $datos->cliente_id }},'venta-aprobada']);" type="button"  class="btn btn-bitbucket">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Regresar
                        </button>
                    </div>
                    {!!Form::open(['route'=>'datos-beneficiariosp', 'method'=>'POST','class'=>'from-data','id'=>'datos-beneficiarios-asegurados'])!!}
                    <div class="box-body contrBeneficiariosAseguradosPoliza">
                        @include('back_end.ventas.beneficiarios.form.form-beneficiarios-asegurados-poliza')
                        <br>
                        <div class="col-md-12 col-md-offset-5">
                            {!!Form::submit('Registrar',['class'=>'btn btn-primary','id'=>'btnacepbeneficiarios'])!!}
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="list-beneficiarios">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Listado </h3>
                    </div>
                    <div class="box-body listBeneficiarios">
                        @include('back_end.ventas.beneficiarios.list-datos-beneficiarios')
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

    $("#ff_nacimiento").focusout(function(){$("#edad").val(calcularEdad($(this).val()));});

    $('.formtelefono').keypress(function(tecla) {
        if((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 0)) return false;
    });
    function nuevoBeneficiario() {
        var  camposInput = ['nu_documento','nb_nombre','nb_apellido','ff_nacimiento','btnregistrar','edad','ff_registro','ff_ultima_actualizacion'];
        var  campoSelect=['heredero_id','tipo_persona_id','nacionalidad_id','parentesco_id','tipobeneficiario_id'];
        $("#btnacepbeneficiarios").removeAttr("disabled");
        $.each(camposInput, function(i, val){
            $('#datos-beneficiarios-asegurados').find('input[name='+val+']').val('');
            $('#datos-beneficiarios-asegurados').find('input[name='+val+']').removeAttr("disabled");
        });
        $.each(campoSelect, function(i, val){
            $('#datos-beneficiarios-asegurados').find('select[name='+val+'] option:first').attr('selected', 'selected');
            $('#datos-beneficiarios-asegurados').find('select[name='+val+']').removeAttr("disabled");
        });
        /*  $.each(campoSelectCreate, function(i, val){
         $('#datos-beneficiarios-poliza').find('select[name='+val+']').html(new Option('..::SELECCIONE::..',0,1));
         $('#datos-beneficiarios-poliza').find('select[name='+val+']').removeAttr("disabled");
         });*/
         $(".btnnuevobeneficiario").attr("disabled","disabled");
    }
</script>