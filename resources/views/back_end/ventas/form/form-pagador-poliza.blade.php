{!!Form::hidden('status_id',1,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('clientes_id',$clientes->id,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('tipo_transaccion','E',['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('operador_id',Auth::user()->documento,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('canal_id',20,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('sucursal_id',100,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('userbanco',' ',['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('userproveedor',' ',['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('tipo_moneda_id','01',['class'=>'form-control','required'=>'required'])!!}
@if(isset($pagador_poliza))
    {!!Form::hidden('direccion_id',$pagador_poliza->direccion_id,['class'=>'form-control','required'=>'required'])!!}
    <script>
           Combos('ciudad_id','{{$pagador_poliza->estado_id}}','Ciudad','{{$pagador_poliza->ciudad_id}}','datos-pagador-poliza');
           Combos('municipio_id','{{$pagador_poliza->estado_id}}','Municipio','{{$pagador_poliza->municipio_id}}','datos-pagador-poliza');
           activos('{{$pagador_poliza->tipo_persona_id}}','datos-pagador-poliza')
    </script>
@endif
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('nacionalidad_id','Tipo documento:')!!}
            {!!Form::select('nacionalidad_id',$nacionalidad_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('nu_documento','Nro. Documento:')!!}
            {!!Form::text('nu_documento',null,['class'=>'form-control','placeholder'=>'Numero de documento del Pagador de la póliza','required'=>'required','maxlength'=>'15'])!!}
        </div>
        <div class="form-group col-xs-8">
            <apan style="color:red">*</apan> {!!Form::label('nb_nombre','Nombre:')!!}
            {!!Form::text('nb_nombre',null,['class'=>'form-control','placeholder'=>'Nombre del Pagador de la póliza','required'=>'required','maxlength'=>'150'])!!}
        </div>

        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('tipo_persona_id','Tipo Persona:')!!}
            {!!Form::select('tipo_persona_id',$tipo_persona_id, null, ['data-id'=>'datos-pagador-poliza','class' => 'form-control tipo_persona_id','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('nb_apellido','Apellido:')!!}
            {!!Form::text('nb_apellido',null,['class'=>'form-control natural','placeholder'=>'Apellido o (en caso de empresa vacio)','maxlength'=>'60','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('nivel_educativo_id','Nivel Educativo:')!!}
            {!!Form::select('nivel_educativo_id',$nivel_educativo_id, null, ['class' => 'form-control natural','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('ocupacion_id','Ocupación:')!!}
            {!!Form::select('ocupacion_id',$ocupacion_id, null, ['class' => 'form-control natural','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('ff_nacimiento','Fecha Nacimiento:')!!}
            <div class='input-group date'>
                {!!Form::text('ff_nacimiento',null,['class'=>'form-control ff_nacimiento natural','placeholder'=>'Fecha Nacimiento','maxlength'=>'10','disabled'=>'disabled'])!!}
                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
            </div>
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
            <apan style="color:red">*</apan>  {!!Form::label('nu_hijos','Nro Hijos:')!!}
            {!!Form::text('nu_hijos',null,['class'=>'form-control natural solonum','placeholder'=>'Nro. de hijos','maxlength'=>'2','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-4">
            <apan style="color:red">*</apan> {!!Form::label('email','E-mail:')!!}
            {!!Form::email('email',null,['class'=>'form-control natural','placeholder'=>'Correo Electronico','maxlength'=>'50','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan>  {!!Form::label('nu_tlf_hogar','Nro Hogar:')!!}
            {!!Form::text('nu_tlf_hogar',null,['class'=>'form-control telefonosmask natural','placeholder'=>'Teléfono Hogar','maxlength'=>'15','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan>  {!!Form::label('nu_tlf_celular','Nro Celular:')!!}
            {!!Form::text('nu_tlf_celular',null,['class'=>'form-control telefonosmask natural','placeholder'=>'Teléfono Celular','maxlength'=>'15','disabled'=>'disabled'])!!}
        </div>

        <div class="form-group col-xs-6">
            <apan style="color:red">*</apan>  {!!Form::label('nb_empresa','Nombre empresa:')!!}
            {!!Form::text('nb_empresa',null,['class'=>'form-control natural','placeholder'=>'Nombre Empresa','maxlength'=>'50','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-3">
            <apan style="color:red">*</apan> {!!Form::label('nb_cargo','Cargo:')!!}
            {!!Form::text('nb_cargo',null,['class'=>'form-control natural','placeholder'=>'Cargo','maxlength'=>'50','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-3">
            <apan style="color:red">*</apan>  {!!Form::label('nu_ingresos','Ingresos:')!!}
            {!!Form::text('nu_ingresos',null,['class'=>'form-control natural solonum','placeholder'=>'Ingresos','maxlength'=>'50','disabled'=>'disabled'])!!}
        </div>

        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('nu_tlf_oficina1','Nro Oficina 1:')!!}
            {!!Form::text('nu_tlf_oficina1',null,['class'=>'form-control telefonosmask','placeholder'=>'Nro. Oficina 1','maxlength'=>'15','required'=>'required'])!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('nu_tlf_oficina2','Nro Oficina 2:')!!}
            {!!Form::text('nu_tlf_oficina2',null,['class'=>'form-control telefonosmask','placeholder'=>'Nro. Oficina 2','maxlength'=>'15','required'=>'required'])!!}
        </div>
        <div class="form-group col-xs-3">
            <apan style="color:red">*</apan> {!!Form::label('activida_economica_id','Actividad Económica:')!!}
            {!!Form::select('activida_economica_id',$activida_economica_id, null, ['class' => 'form-control empresa','placeholder'=>'..:: SELECCIONE ::..','disabled'=>'disabled'] )!!}
        </div>
        <div class="form-group col-xs-5">
            <apan style="color:red">*</apan>  {!!Form::label('nu_capital_promedio','Capital Promedio:')!!}
            {!!Form::text('nu_capital_promedio',null,['class'=>'form-control empresa','placeholder'=>'Capital Promedio','maxlength'=>'15','disabled'=>'disabled'])!!}
        </div>


        <div class="form-group col-xs-3">
            <apan style="color:red">*</apan> {!!Form::label('bancos_id','Banco:')!!}
            {!!Form::select('banco_id',$bancos_id, null, ['id' => 'banco_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
        </div>
        <div class="form-group col-xs-3">
            <apan style="color:red">*</apan> {!!Form::label('medios_pago_id','Medio de Pago:')!!}
            {!!Form::select('medio_pago_id',$medio_pago_id, null, [ 'id' => 'medio_pago_id', 'class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required','disabled'=>'disabled'] )!!}
        </div>
        <div class="form-group col-xs-6">
            <apan style="color:red">*</apan> {!!Form::label('nu_medio_pago','Número del medio:')!!}
            {!!Form::text('nu_medio_pago',null,['id'=>'nu_medio_pago','class'=>'form-control','placeholder'=>'Número del medio de pago asociado (TARJETAA,CUENTA)','required'=>'required','disabled'=>'disabled'])!!}
        </div>
        <div class="form-group col-xs-12">
             <div id="notificacion-tipo-cuenta" style="display: none"></div>
        </div>
        <div class="form-group col-xs-12">
             {!!Form::label('ff_registro','Fecha Registro:')!!}
            {!!Form::text('ff_registro',date('Y-m-d'),['class'=>'form-control','required'=>'required','maxlength'=>'10','readonly'=>'readonly'])!!}
        </div>

