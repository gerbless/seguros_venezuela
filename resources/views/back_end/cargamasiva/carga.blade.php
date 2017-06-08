
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
           <div class="panel panel-default">
        <div class="panel-body">
        <div class="panel-heading">
            <h3 class="panel-title"> <h3> Antes de cargar la información recuerda!!!!</h3> </h3>
        </div>
            <h5 style="color: #0044cc">1. Cada archivo no debe contener mas de <B CLASS="text-danger">1001</B> columnas,donde la Nro. 1 queda reservada para los encabezados y el resto para la data a registrar .</h5>
            <h5 style="color: #0044cc">2. Colocar un nombre al archivo que haga referencia a la información que se está subiendo ya que el nombre del archivo será tomado y registrado en la base de datos como el nombre de referencia para el lote. Ejem: colocar nombre de la campaña y código del plan <B CLASS="text-danger">CANCER ASC1  (Nro. si es el mismo día y campaña)</B>. <br> El nombre quedaría así <B CLASS="text-danger">CANCER ASC1_{{ date('d-m-Y') }}</B> ya que la fecha y  lote serán concatenadas de forma automática por el sistema.</h5>
            <h5 style="color: #0044cc">3. Titulos que debe contener el archivo excel en cada una de la celdas Ejem: (<B CLASS="text-danger">LETRA COLUMNA = TITULO EN LA PRIMERA CELDA</B>).</h5>
            <div class="col-md-3">
                <h6>A = nacionalidad.</h6>
                <h6>B = documento.</h6>
                <h6>C = nombres.</h6>
            </div>
             <div class="col-md-3">
                 <h6>D = sexo.</h6>
                <h6>E = edo_civil.</h6>
                <h6>F = fecha_nac.</h6>
             </div>
             <div class="col-md-3">
                <h6>G = cod1.</h6>
                <h6>H = telefono1.</h6>
                <h6>I = cod2.</h6>
             </div>
            <div class="col-md-3">
                <h6>J = telefono2</h6>
                <h6>K = correo</h6>
                <h6>L = edad</h6>
            </div>
        </div>
    </div>
        </div>
    </div>
    <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
                <h4 class="box-title">Carga Masiva</h4>
            </div>
            <div class="box-body">
                {!!Form::open(['route'=>'cargar-archivo', 'method'=>'POST','id'=>'datos-txt', 'enctype' => 'multipart/form-data'])!!}

                <div class="form-group col-xs-12">
                    <apan style="color:red">*</apan> {!!Form::label('sponsor','Sponsor:')!!}
                    {!!Form::select('sponsor',$sponsor, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
                </div>


                <div class="form-group col-xs-6">
                    <apan style="color:red">*</apan> {!!Form::label('campana_id','Campaña:')!!}
                    {!!Form::select('campana_id',$campana_id, null, ['id' => 'campana_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
                </div>

                <div class="form-group col-xs-6">
                    <apan style="color:red">*</apan> {!!Form::label('ramo_id','Ramo:')!!}
                    {!!Form::select('ramo_id',array(), null, ['id' => 'ramo_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
                </div>

                <div class="form-group col-xs-6">
                    <apan style="color:red">*</apan> {!!Form::label('producto_id','Producto:')!!}
                    {!!Form::select('producto_id',array(), null, ['id' => 'producto_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
                </div>

                <div class="form-group col-xs-6">
                    <apan style="color:red">*</apan> {!!Form::label('plan_id','Plan:')!!}<br>
                    {!!Form::select('plan_id[]',array(), null, ['style'=>'width:100%;','multiple' => 'multiple','id' => 'plan_id','required'=>'required'] )!!}
                </div>

                <br>
                <div class="form-group col-xs-9">
                    <apan style="color:red">*</apan> {!!Form::label('sel_file','Seleccione archivo:')!!}
                    <div class='input-group date'>
                        {!!Form::file('sel_file',null,['id'=>'sel_file','class'=>'form-control ff'])!!}
                    </div>
                </div>
                <br>
                <div class="form-group col-xs-3">
                    <button type="submit" class="btn  btn-success">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                        Cargar
                    </button>
                </div>
                {!!Form::close()!!}
            </div>
      </div>
    </div>
</div>
<script type="text/javascript">

       $.fn.select2.defaults.set("theme", "classic");
        // inicializamos el plugin
        $('#plan_id').select2({
            // Activamos la opcion "Tags" del plugin
            tags: true,
            placeholder: '..:: SELECCIONE ::..',
//            minimumInputLength: 4,
            tokenSeparators: [','],
            ajax: {
                dataType: 'json',
                url: '{{ url("multiples-planes") }}',
                {{--url: function (params) {--}}
                    {{--return '{{ url("multiples-planes") }}/' + params.term + '/'+ $ ("#producto_id").val()--}}
                {{--},--}}
                delay: 250,
                data: function(params) {

                        return {
                           nom_plan: params.term,
                          id_producto: $("#producto_id").val()
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                },
            }
        });

</script>


@include('back_end.combos')