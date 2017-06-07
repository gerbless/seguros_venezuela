<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">Reporte de Ventas y no ventas</h4>
    </div>
    <div class="box-body">
        {!!Form::open(['route'=>'reporte-ventas', 'method'=>'POST','id'=>'datos-ventas'])!!}
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('desde','Fecha desde:')!!}
            <div class='input-group date'>
                {!!Form::text('desde',null,['id'=>'ff_nacimiento','class'=>'form-control ff','placeholder'=>'Desde','required'=>'required','maxlength'=>'10'])!!}
                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
            </div>
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('hasta','Fecha hasta:')!!}
            <div class='input-group date'>
                {!!Form::text('hasta',null,['id'=>'hasta','class'=>'form-control ff','placeholder'=>'hasta','required'=>'required','maxlength'=>'10'])!!}
                <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
            </div>
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('campana','Campaña:')!!}
            {!!Form::select('campana',$campana, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
        </div>
        <div class="form-group col-xs-2">
            <apan style="color:red">*</apan> {!!Form::label('tipo','Tipo:')!!}
            {!!Form::select('tipo',array('VENTA' =>'VENTA','NOVENTA' =>'NO CONCRETADAS'), null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
        </div>

        <div class="form-group col-xs-2">
            <button type="submit" class="btn  btn-success">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                Exportar
            </button>
        </div>
        {!!Form::close()!!}
    </div>
</div>

<script type="text/javascript">
    $('.ff').datepicker({
        format: "dd-mm-yyyy",
        language: "es"
    });
</script>