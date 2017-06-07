<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">Generador de archivo XML</h4>
    </div>
    <div class="box-body">
        {!!Form::open(['route'=>'crear-txt', 'method'=>'POST','class'=>'from-data','id'=>'datos-txt'])!!}
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
            <apan style="color:red">*</apan> {!!Form::label('sponsor','Sponsor:')!!}
            {!!Form::select('sponsor',$sponsor, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
        </div>

        <div class="form-group col-xs-2">
            <button type="submit" class="btn  btn-success">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                GENERAR XML
            </button>
        </div>

        {!!Form::close()!!}

        @if(isset($nom))
            <div  class="form-group col-xs-2 text-left">
                    {{ link_to_route('descarga-xml','Descarga',[$nom]) }}
            </div>
            <div class="form-group col-xs-12">
                <pre style="height: 250px; overflow:auto;">{{$strings_xml}}</pre>
            </div>
          @else
            <div  class="form-group col-xs-12">
            @include('alerts.noresult')
            </div>
        @endif
    </div>
</div>

<script type="text/javascript">
    $('.ff').datepicker({
        format: "dd-mm-yyyy",
        language: "es"
    });

</script>