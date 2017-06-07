<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('campana_id','Campaña:')!!}
    {!!Form::select('campana_id',$campana_id, null, ['id' => 'campana_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('ramo_id','Ramo:')!!}
    {!!Form::select('ramo_id',$ramo_id, null, ['id' => 'ramo_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('producto_id','Producto:')!!}
    {!!Form::select('producto_id',$producto_id, null, ['id' => 'producto_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('plan_id','Planes:')!!}
    {!!Form::select('plan_id',$plan_id, null, ['id' => 'plan_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('frecuencia_pago_id','Frecuencia de pago:')!!}
    {!!Form::select('frecuencia_pago_id',$frecuencia_pago_id, null, ['id' => 'frecuencia_pago_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('prima','Prima:')!!}
    {!!Form::text('prima',null,['class'=>'form-control','placeholder'=>'Nombre de la prima','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
@include('back_end.combos')