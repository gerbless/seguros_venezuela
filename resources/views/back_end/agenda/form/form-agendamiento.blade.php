{!!Form::hidden('status_id',1,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('clientes_id',$cliente->id,['class'=>'form-control','required'=>'required'])!!}
@if(is_object($agendamiento))
    <div class="form-group col-xs-12">
        <apan style="color:red">*</apan> {!!Form::label('id','Teléfono:')!!}
        {!!Form::text('id',$agendamiento->id,['class'=>'form-control','placeholder'=>'Teléfono','readonly'=>'readonly','required'=>'required','maxlength'=>'20'])!!}
        {!!Form::hidden('nro',($agendamiento->nro + 1),['class'=>'form-control','required'=>'required'])!!}
    </div>
    @else
    <div class="form-group col-xs-12">
        <apan style="color:red">*</apan> {!!Form::label('id','Teléfono:')!!}
        {!!Form::text('id',$telefono,['class'=>'form-control','placeholder'=>'Teléfono','readonly'=>'readonly','required'=>'required','maxlength'=>'20'])!!}
        {!!Form::hidden('nro',1,['class'=>'form-control','required'=>'required'])!!}
        {!!Form::hidden('ff_hh_agendado',0,['class'=>'form-control'])!!}

    </div>
@endif

    <div class="form-group col-xs-6">
        <apan style="color:red">*</apan> {!!Form::label('desde','Fecha agenda:')!!}
        <div class='input-group date'>
            {!!Form::text('ff_agendado',null,['id'=>'ff_agendado','class'=>'form-control ff','placeholder'=>'Fecha agenda','required'=>'required','maxlength'=>'10'])!!}
            <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span>
        </div>
    </div>

    <div class="form-group col-xs-6">
        <apan style="color:red">*</apan> {!!Form::label('hh_agendado','Hora agenda:')!!}
        <div class="input-group bootstrap-timepicker timepicker">
            <input id="hh_agendado" name="hh_agendado" type="text" class="form-control input-small">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div>
    </div>


<script type="text/javascript">
    $('#hh_agendado').timepicker();
    $('.ff').datepicker({
        format: "dd-mm-yyyy",
        language: "es"
    });
</script>