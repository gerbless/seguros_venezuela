<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_ocupacion','Nombre:')!!}
    {!!Form::text('nb_ocupacion',null,['class'=>'form-control','placeholder'=>'Nombre del la ocupación','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>