{!!Form::hidden('status_id',1,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('cliente_id',$clientes->id,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('ff_registro',null,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('ff_ultima_actualizacion',date('Y-m-d'),['class'=>'form-control','required'=>'required'])!!}
@if(isset($poliza_asegurados[0]))
    {!!Form::hidden('direccion_id',$poliza_asegurados[0]->direccion_id,['class'=>'form-control','required'=>'required'])!!}
    <script>
       Combos('ciudad_id', '{{$poliza_asegurados[0]->estado_id}}', 'Ciudad', '{{$poliza_asegurados[0]->ciudad_id}}', 'datos-asegurado-poliza-update');
       Combos('municipio_id', '{{$poliza_asegurados[0]->estado_id}}', 'Municipio', '{{$poliza_asegurados[0]->municipio_id}}', 'datos-asegurado-poliza-update');
       activos('{{$poliza_asegurados[0]->tipo_persona_id}}','datos-asegurado-poliza-update')
    </script>

@endif
<div class="form-group col-xs-2">
    <apan style="color:red">*</apan> {!!Form::label('nacionalidad_id','Tipo documento:')!!}
    {!!Form::select('nacionalidad_id',$nacionalidad_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-2">
    {!!Form::label('nu_documento','Nro. Documento:')!!}
    {!!Form::text('nu_documento',null,['class'=>'form-control','placeholder'=>'Numero de documento del Pagador de la póliza','required'=>'required','maxlength'=>'11'])!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('nb_nombre','Nombre:')!!}
    {!!Form::text('nb_nombre',null,['class'=>'form-control','placeholder'=>'Nombre o Razón social','required'=>'required','maxlength'=>'60'])!!}
</div>

<div class="form-group col-xs-2">
    <br>
    <button onclick="nuevoAseguradoPoliza();" type="button" disabled="disabled" class="btn btn-bitbucket btnnuevoaseguradopoliza">
        <i class="fa fa-male" aria-hidden="true"></i>
        Agregar Asegurado
    </button>
</div>


<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('tipo_persona_id','Tipo Persona:')!!}
    {!!Form::select('tipo_persona_id',$tipo_persona_id, null, ['data-id'=>'datos-asegurado-poliza','class' => 'form-control tipo_persona_id','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nb_apellido','Apellido:')!!}
    {!!Form::text('nb_apellido',null,['class'=>'form-control natural','placeholder'=>'Apellido o (en caso de empresa vacio)','maxlength'=>'60','disabled'=>'disabled'])!!}
</div>
<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('nivel_educativo_id','Nivel Educativo:')!!}
    {!!Form::select('nivel_educativo_id',$nivel_educativo_id, null, ['class' => 'form-control natural','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
</div>

<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('ocupacion_id','Ocupación:')!!}
    {!!Form::select('ocupacion_id',$ocupacion_id, null, ['class' => 'form-control natural','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
</div>

<div class="form-group col-xs-2">
    <apan style="color:red">*</apan> {!!Form::label('ff_nacimiento','Fecha Nacimiento:')!!}
    <div class='input-group date'>
        {!!Form::text('ff_nacimiento',null,['id'=>'ff_nacimiento','class'=>'form-control ff_nacimiento natural','placeholder'=>'Fecha Nacimiento','disabled'=>'disabled','maxlength'=>'10'])!!}
        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
    </div>
</div>
<div class="form-group col-xs-1">
    <apan style="color:red">*</apan> {!!Form::label('edad','Edad:')!!}
    {!!Form::text('edad',null,['id'=>'edad','class'=>'form-control','placeholder'=>'Edad','required'=>'required','maxlength'=>'2','readonly'=>'readonly'])!!}
</div>
<div class="form-group col-xs-2">
    <apan style="color:red">*</apan> {!!Form::label('sexo_id','Sexo:')!!}
    {!!Form::select('sexo_id',$sexo_id, null, ['class' => 'form-control natural','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
</div>
<div class="form-group col-xs-2">
    <apan style="color:red">*</apan> {!!Form::label('estadocivil_id','Estado Civil:')!!}
    {!!Form::select('estadocivil_id',$estadocivil_id, null, ['class' => 'form-control natural','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
</div>
<div class="form-group col-xs-2">
    {!!Form::label('nu_hijos','Nro Hijos:')!!}
    {!!Form::text('nu_hijos',null,['class'=>'form-control natural solonum','placeholder'=>'Nro. de hijos','maxlength'=>'2','disabled'=>'disabled'])!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('email','E-mail:')!!}
    {!!Form::email('email',null,['class'=>'form-control natural','placeholder'=>'Correo Electronico','maxlength'=>'50','disabled'=>'disabled'])!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nu_tlf_hogar','Nro Hogar:')!!}
    {!!Form::text('nu_tlf_hogar',null,['class'=>'form-control telefonosmask natural','placeholder'=>'Teléfono Hogar','maxlength'=>'15','disabled'=>'disabled'])!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nu_tlf_celular','Nro Celular:')!!}
    {!!Form::text('nu_tlf_celular',null,['class'=>'form-control telefonosmask natural','placeholder'=>'Teléfono Celular','maxlength'=>'15','disabled'=>'disabled'])!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('nb_empresa','Nombre empresa:')!!}
    {!!Form::text('nb_empresa',null,['class'=>'form-control natural','placeholder'=>'Nombre Empresa','maxlength'=>'50','disabled'=>'disabled'])!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nb_cargo','Cargo:')!!}
    {!!Form::text('nb_cargo',null,['class'=>'form-control natural','placeholder'=>'Cargo','maxlength'=>'50','disabled'=>'disabled'])!!}
</div>

<div class="form-group col-xs-3">
    {!!Form::label('nu_ingresos','Ingresos:')!!}
    {!!Form::text('nu_ingresos',null,['class'=>'form-control natural solonum','placeholder'=>'Ingresos','maxlength'=>'50','disabled'=>'disabled'])!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nu_tlf_oficina1','Nro Oficina 1:')!!}
    {!!Form::text('nu_tlf_oficina1',null,['class'=>'form-control telefonosmask','placeholder'=>'Nro. Oficina 1','maxlength'=>'15','required'=>'required'])!!}
</div>
<div class="form-group col-xs-3">
    {!!Form::label('nu_tlf_oficina2','Nro Oficina 2:')!!}
    {!!Form::text('nu_tlf_oficina2',null,['class'=>'form-control telefonosmask','placeholder'=>'Nro. Oficina 2','maxlength'=>'15','required'=>'required'])!!}
</div>
<div class="form-group col-xs-3">
    <apan style="color:red">*</apan> {!!Form::label('activida_economica_id','Actividad Económica:')!!}
    {!!Form::select('activida_economica_id',$activida_economica_id, null, ['class' => 'form-control empresa','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
</div>
<div class="form-group col-xs-8">
    {!!Form::label('nu_capital_promedio','Capital Promedio:')!!}
    {!!Form::text('nu_capital_promedio',null,['class'=>'form-control empresa solonum','placeholder'=>'Capital Promedio','maxlength'=>'15','disabled'=>'disabled'])!!}
</div>







