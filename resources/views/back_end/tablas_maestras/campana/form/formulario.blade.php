<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_campana','Nombre campaña:')!!}
    {!!Form::text('nb_campana',null,['class'=>'form-control','placeholder'=>'Nombre de la campaña','maxlength'=>'60','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>