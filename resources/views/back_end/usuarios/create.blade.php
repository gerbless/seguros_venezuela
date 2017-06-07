<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Crear información usuario</h3>
            </div><!-- /.box-header -->

            <div id="notificacion-datos-create-cliente"></div>

            {!!Form::open(['route'=>'createusuario', 'method'=>'POST','class'=>'from-data','id'=>'datos-create-cliente'])!!}
                <div class="box-body">
                    @include('back_end.usuarios.form.formulario')
                    @include('back_end.usuarios.form.formulario_clave')
                    <div class="col-md-12 col-md-offset-5">
                        {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
                    </div>
                </div>
            {!!Form::close()!!}

        </div>


    </div>
</div>