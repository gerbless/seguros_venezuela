<div class="form-group col-xs-12" >
    <div id="mensaje-datoCli" style="display: none"></div>
</div>

<div class="form-group col-xs-3">
    {!!Form::label('documento','Documento:')!!}
    {!!Form::text('documento',null,['class'=>'form-control datoCli','placeholder'=>'Ingrese documento','required'=>'required'])!!}
</div>

<div class="form-group col-xs-7">
    {!!Form::label('cliente','Nombres:')!!}
    {!!Form::text('cliente',null,['class'=>'form-control datoCli','placeholder'=>'Ingrese nombre del cliente','required'=>'required'])!!}
</div>
<div class="form-group col-xs-2">
    {!!Form::label('edad','edad:')!!}
    {!!Form::text('edad',null,['class'=>'form-control datoCli','placeholder'=>'Ingrese edad'])!!}
</div>

<div class="form-group col-xs-4">
    {!!Form::label('nacionalidad','Nacionalidad')!!}
    {!!Form::select('nacionalidad',array('V'=>'VENEZOLANO','E'=>'EXTRANJERO'), null, ['class' => 'form-control datoCli','placeholder'=>'[ SELECCIONE ]'] )!!}
</div>
<div class="form-group col-xs-4">
    {!!Form::label('sexo','sexo')!!}
    {!!Form::select('sexo',array('M'=>'MASCULINO','F'=>'FEMENINO'), null, ['class' => 'form-control datoCli','placeholder'=>'[ SELECCIONE ]'] )!!}
</div>
<div class="form-group col-xs-4">
    {!!Form::label('edo_civil','Civil')!!}
    {!!Form::select('edo_civil',array('S'=>'SOLTERO','C'=>'CASADO','D'=>'DIVORCIADO','V'=>'VIUDO','O'=>'OTRO'), null, ['class' => 'form-control datoCli','placeholder'=>'[ SELECCIONE ]'] )!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('campana','Campaña')!!}
    {!!Form::select('campana',$campana, null, ['disabled' => 'disabled','class' => 'form-control','placeholder'=>'[ SELECCIONE ]'] )!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('plan','Plan')!!}
    {!!Form::select('plan',$plan, null, ['disabled' => 'disabled','class' => 'form-control','placeholder'=>'[ SELECCIONE ]'] )!!}
</div>


