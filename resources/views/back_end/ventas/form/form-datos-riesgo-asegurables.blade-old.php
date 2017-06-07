{!!Form::hidden('status_id',1,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('clientes_id',$clientes->id,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('ff_registro',null,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('ff_ultima_actualizacion',null,['class'=>'form-control','required'=>'required'])!!}

<div class="form-group col-xs-10"></div>
<div class="form-group col-xs-2">
    <button onclick="nuevoDatoRiesgoAsegurable();" type="button" disabled="disabled" class="btn btn-bitbucket btnnuevodatosriesgosasegurables">
        <i class="fa fa-male" aria-hidden="true"></i>
        Agregar
    </button>
</div>

<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('tipo_riesgo_id','Tipos de Riesgo:')!!}
    {!!Form::select('tipo_riesgo_id',$tipo_riesgo_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('nacionalidad_id','Nacionalidad:')!!}
    {!!Form::select('nacionalidad_id',$nacionalidad_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nu_documento','Nro. Documento:')!!}
    {!!Form::text('nu_documento',null,['class'=>'form-control','placeholder'=>'Numero de documento del Pagador de la póliza','required'=>'required','maxlength'=>'15'])!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('nb_nombre','Nombre:')!!}
    {!!Form::text('nb_nombre',null,['class'=>'form-control','placeholder'=>'Nombre o Razón social','required'=>'required','maxlength'=>'50'])!!}
</div>
<div class="form-group col-xs-6">
    {!!Form::label('nb_apellido','Apellido:')!!}
    {!!Form::text('nb_apellido',null,['class'=>'form-control','placeholder'=>'Apellido o (en caso de empresa vacio)','maxlength'=>'50'])!!}
</div>

<div class="form-group col-xs-2">
    <apan style="color:red">*</apan> {!!Form::label('ff_nacimiento','Fecha Nacimiento:')!!}
    <div class='input-group date'>
        {!!Form::text('ff_nacimiento',null,['id'=>'ff_nacimientoD','class'=>'form-control ff_nacimiento','placeholder'=>'Fecha Nacimiento','required'=>'required','maxlength'=>'10'])!!}
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
    </div>
</div>
<div class="form-group col-xs-1">
    <apan style="color:red">*</apan> {!!Form::label('edad','Edad:')!!}
    {!!Form::text('edad',null,['id'=>'edadD','class'=>'form-control','placeholder'=>'Edad','required'=>'required','maxlength'=>'2','readonly'=>'readonly'])!!}
</div>
<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('parentesco_id','Parentesto:')!!}
    {!!Form::select('parentesco_id',$parentesco_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
