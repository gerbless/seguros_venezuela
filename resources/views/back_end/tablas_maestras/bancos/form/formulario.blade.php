<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('id','ID banco:')!!}
    {!!Form::text('id',null,['class'=>'form-control','placeholder'=>'Código de la agencia','maxlength'=>'3','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_banco','Nombre del banco:')!!}
    {!!Form::text('nb_banco',null,['class'=>'form-control','placeholder'=>'Nombre del baco','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nacionalidad','Status:')!!}
    {!!Form::select('nacionalidad',array('N'=>'NACIONAL','E'=>'EXTRANJERO'), null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('cuenta','Cuenta:')!!}
    {!!Form::select('cuenta',array(1=>'SI',0=>'NO'), null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>


<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>