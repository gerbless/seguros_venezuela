<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('id','ID producto:')!!}
    {!!Form::text('id',null,['class'=>'form-control','placeholder'=>'Id producto','maxlength'=>'3','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_producto','Producto:')!!}
    {!!Form::text('nb_producto',null,['class'=>'form-control','placeholder'=>'Nombre del Producto','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('ramo_id','Ramo:')!!}
    {!!Form::select('ramo_id',$ramo_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>