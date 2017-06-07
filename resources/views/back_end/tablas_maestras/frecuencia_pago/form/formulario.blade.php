<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('id','ID Frecuencia Pago:')!!}
    {!!Form::text('id',null,['class'=>'form-control','placeholder'=>'Código de la agencia','maxlength'=>'3','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_frecuencia_pago','Frecuencia de Paga:')!!}
    {!!Form::text('nb_frecuencia_pago',null,['class'=>'form-control','placeholder'=>'Nombre del baco','maxlength'=>'60','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>