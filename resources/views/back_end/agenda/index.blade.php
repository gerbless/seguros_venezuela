<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Agendamiento - <b class="text-bold text-info">{{$cliente->cliente}}</b></h3>
            </div><!-- /.box-header -->

            <div id="notificacion-datos-agenda"></div>

            {!!Form::open(['route'=>'agendar-telefono', 'method'=>'POST','class'=>'from-data','id'=>'datos-agenda'])!!}
            <div class="box-body">
                @include('back_end.agenda.form.form-agendamiento')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>
            {!!Form::close()!!}

        </div>


    </div>
</div>