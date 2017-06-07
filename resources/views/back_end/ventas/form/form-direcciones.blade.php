
    <div class="form-group col-xs-3">
        <apan style="color:red">*</apan> {!!Form::label('pais_id','Pais:')!!}
        {!!Form::select('pais_id',$pais_id, null, ['data-id' => 'estado-'.$class_direcciones, 'class' => 'form-control pais-'.$class_direcciones,'placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
    </div>

    <div class="form-group col-xs-3">
        <apan style="color:red">*</apan> {!!Form::label('estado_id','Estado:')!!}
        {!!Form::select('estado_id',$estado_id, null, ['data-id' => 'ciudad-'.$class_direcciones,'class' => 'form-control estado-'.$class_direcciones,'placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
    </div>

    <div class="form-group col-xs-3">
        <apan style="color:red">*</apan> {!!Form::label('ciudad_id','Ciudad:')!!}
        {!!Form::select('ciudad_id',array(), null, ['data-id' => 'municipio-'.$class_direcciones, 'class' => 'form-control ciudad-'.$class_direcciones,'placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
    </div>

    <div class="form-group col-xs-3">
        <apan style="color:red">*</apan> {!!Form::label('municipio_id','Municipio:')!!}
        {!!Form::select('municipio_id',array(), null, ['class' => 'form-control municipio-'.$class_direcciones,'placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
    </div>


    <div class="form-group col-xs-3">
        {!!Form::label('nb_parroquia','Nombre Parroquia:')!!}
        {!!Form::text('nb_parroquia',null,['class'=>'form-control','placeholder'=>'Nombre de la parroquia','required'=>'required','maxlength'=>'50'])!!}
    </div>

    <div class="form-group col-xs-3">
        {!!Form::label('co_postal','Código Postal:')!!}
        {!!Form::text('co_postal',null,['class'=>'form-control formtelefono','placeholder'=>'Código Postal','required'=>'required','maxlength'=>'3'])!!}
    </div>

    <div class="form-group col-xs-6">
        {!!Form::label('tx_avenida_calle','Calle o avenida:')!!}
        {!!Form::text('tx_avenida_calle',null,['class'=>'form-control','placeholder'=>'calle o avenida','required'=>'required','maxlength'=>'50'])!!}
    </div>


    <div class="form-group col-xs-6">
        {!!Form::label('tx_urbanizacion_direccion','Dirección:')!!}
        {!!Form::text('tx_urbanizacion_direccion',null,['class'=>'form-control','placeholder'=>'Dirección urbanización','required'=>'required','maxlength'=>'50'])!!}
    </div>

    <div class="form-group col-xs-2">
        {!!Form::label('nb_edificio_casa','Nombre Edificio-casa:')!!}
        {!!Form::text('nb_edificio_casa',null,['class'=>'form-control','placeholder'=>'Nombre del edificio o casa','required'=>'required','maxlength'=>'20'])!!}
    </div>

    <div class="form-group col-xs-2">
        {!!Form::label('nu_piso','Nro. Piso:')!!}
        {!!Form::text('nu_piso',null,['class'=>'form-control solonum','placeholder'=>'Nro. del piso','required'=>'required','maxlength'=>'20'])!!}
    </div>


    <div class="form-group col-xs-2">
        {!!Form::label('nu_casa','Nro. Casa:')!!}
        {!!Form::text('nu_casa',null,['class'=>'form-control','placeholder'=>'Nro. de la casa','required'=>'required','maxlength'=>'20'])!!}
    </div>
