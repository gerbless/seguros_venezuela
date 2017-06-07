<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('cod_cml','ID cobertura:')!!}
    {!!Form::text('cod_cml',null,['class'=>'form-control','placeholder'=>'Nombre del ramo','maxlength'=>'3','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_cobertura','Cobertura:')!!}
    {!!Form::text('nb_cobertura',null,['class'=>'form-control','placeholder'=>'Nombre del la cobertura','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('suma_asegurada','Suma asegurada:')!!}
    {!!Form::text('suma_asegurada',null,['class'=>'form-control','placeholder'=>'Coloque la suma asegurada','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('prima','Prima:')!!}
    {!!Form::text('prima',null,['class'=>'form-control','placeholder'=>'Prima Asegurada','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('tasa','Tasa:')!!}
    {!!Form::text('tasa',null,['class'=>'form-control','placeholder'=>'Coloque tasa','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('plan_id','Plan:')!!}
    {!!Form::select('plan_id',$plan_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Aplica XML:')!!}
    {!!Form::select('caso_muerte',array(1=>'SI',2=>'NO'), null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>