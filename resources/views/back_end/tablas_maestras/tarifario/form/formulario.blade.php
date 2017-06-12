<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('campana_id','Campaña:')!!}
    {!!Form::select('campana_id',$campana_id, null, ['id' => 'campana_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('ramo_id','Ramo:')!!}
    {!!Form::select('ramo_id',array(), null, ['id' => 'ramo_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('producto_id','Producto:')!!}
    {!!Form::select('producto_id',array(), null, ['id' => 'producto_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('plan_id','Planes:')!!}
    {!!Form::select('plan_id',array(), null, ['id' => 'plan_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('frecuencia_pago_id','Frecuencia de pago:')!!}
    {!!Form::select('frecuencia_pago_id',$frecuencia_pago_id, null, ['id' => 'frecuencia_pago_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('prima','Prima:')!!}
    {!!Form::text('prima',null,['class'=>'form-control','placeholder'=>'Nombre de la prima','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-6">
    <apan style="color:red">*</apan> {!!Form::label('aplica_rango','Aplica Rango de edad:')!!}
    {!!Form::select('aplica_rango',array('1' =>'SI','2' =>'NO'), null, ['id' => 'aplica_rango','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-6 rango">
    <apan style="color:red">*</apan> {!!Form::label('rangoedad_id','Indique el rango para la tarifa (En caso de no existir crearlo):')!!}
    {!!Form::select('rangoedad_id',$rangoedad, null, ['id' => 'rangoedad_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('suma_total_asegurados','Sumar Asegurados (Al seleccionar que si el valor de la prima se multiplica por la cantidad de asegurados):')!!}
    {!!Form::select('suma_total_asegurados',array('1' =>'SI','2' =>'NO'), null, ['id' => 'suma_total_asegurados','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<script>
    $("#aplica_rango").change(function(){
        if($(this).val()==1)
            $("#rangoedad_id").removeAttr("disabled");
        else
            $("#rangoedad_id").attr("disabled","disabled");
            $("select#rangoedad_id").val("").attr("selected","selected");
    });
</script>
@include('back_end.combos')