<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('id','ID ramos:')!!}
    {!!Form::text('id',null,['class'=>'form-control','placeholder'=>'Nombre del ramo','maxlength'=>'3','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_ramo','Ramo:')!!}
    {!!Form::text('nb_ramo',null,['class'=>'form-control','placeholder'=>'Nombre del ramo','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('campana_id','Campaña:')!!}
    {!!Form::select('campana_id',$campana_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>