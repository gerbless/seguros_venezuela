<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('cod_xml','Id Parentesco:')!!}
    {!!Form::text('cod_xml',null,['class'=>'form-control','placeholder'=>'ID parentesco','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_parentesco','Parentesco:')!!}
    {!!Form::text('nb_parentesco',null,['class'=>'form-control','placeholder'=>'Nombre del parentesco','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>