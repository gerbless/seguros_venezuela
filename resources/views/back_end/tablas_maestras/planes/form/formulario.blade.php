<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('id','ID plan:')!!}
    {!!Form::text('id',null,['class'=>'form-control','placeholder'=>'Nombre del ramo','maxlength'=>'5','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_plan','Plan:')!!}
    {!!Form::text('nb_plan',null,['class'=>'form-control','placeholder'=>'Nombre del plan','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('producto_id','Producto:')!!}
    {!!Form::select('producto_id',$producto_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>