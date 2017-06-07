<div class="row">
  {!!Form::model($gestionar,['route'=> ['gestionar-tipificacion',$gestionar->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-gestion'])!!}
    <h4 align="center"><b>Gestionando - <b> {{$gestionar->status->nb_status}} </h4>
    <div class="col-md-5">
        <div class="box box-primary">

            <div class="box-header">
                <h4 class="box-title">Datos del cliente</h4>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!!Form::hidden('clientes_id',$gestionar->id)!!}
                {!!Form::hidden('users_id',Auth::user()->id)!!}
                {!!Form::hidden('ruta',$gestionar->status->submenu()->select('ruta')->first()->ruta)!!}
                {!!Form::hidden('status_id',1)!!}
                @include('back_end.gestion.form.form-clientes')
            </div>


        </div>
    </div>

    <div class="col-md-7">
        <div class="box box-primary">

            <div class="box-header">
                <h4 class="box-title"><apan style="color:red">*</apan> Datos de contacto - Seleccione uno (OBLIGATORIO) <apan style="color:red">*</apan></h4>
            </div><!-- /.box-header -->

            <div class="box-body" id="conteinput">
                @include('back_end.gestion.form.form-contacto')
            </div>
        </div>
    </div>
    <div  class="col-md-12" id="menj-globar" style="display: none;text-align: center"></div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title"><apan style="color:red">*</apan> Tipificación de la llamada (OBLIGATORIO) <apan style="color:red">*</apan>  </h4>
            </div><!-- /.box-header -->
            <div class="box-body">
                @include('back_end.gestion.form.form-tipficacion')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Guardar',['class'=>'btn btn-primary btn-xs'])!!}
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
{{link_to('actualizar-datos/::CAMPO/::NUMERO/'.$gestionar->id,null,['id'=>'id_ruta','style'=>'display: none;'])}}
<script>

    $('.formtelefono').keypress(function(tecla) {
        if((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 0)) return false;
    });
    $(".formtelefono,.datoCli").focusout(function(){
        var valor=$(this).val();
        if(valor==0) return false;
        var campo=$(this).attr("name");
        var campoid=$(this).attr("id");
        var clas=$(this).attr("class").replace('form-control ','');
        var ruta = $('#id_ruta').attr("href").replace('::CAMPO',campo);
        ruta =ruta.replace('::NUMERO',valor);
        var jqxhr = $.get(ruta);
        jqxhr.done(function(resul) {
            $("#mensaje-"+clas).html(menj(resul.tipo,resul.menj)).show(500);
            if(typeof resul.accion !="undefined")
            {
                $("#"+campoid).val(resul.campo);
            }
        });
        jqxhr.always(function() {
            setTimeout(function () {$("#mensaje-"+clas).hide(500);},2000);
        });
        jqxhr.fail(function(resul) {
            $("body").html(resul.responseText);
        });

    });

    $(".radios").click(function(){
        var nro=$(this).val();
        if($('#telefono'+nro).val()==""){
            $(this).prop("checked", false);
            return false;
        }

        $(this).val($('#telefono'+nro).val());
    });

</script>

@include('back_end.combos')


