<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('id','ID Tipo Beneficiario:')!!}
    {!!Form::text('id',null,['class'=>'form-control','placeholder'=>'Código tipo beneficiario','maxlength'=>'3','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('nb_tipo_beneficiario','Nombre tipo beneficiario:')!!}
    {!!Form::text('nb_tipo_beneficiario',null,['class'=>'form-control','placeholder'=>'Nombre beneficiario','maxlength'=>'120','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>