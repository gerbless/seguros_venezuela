<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Editar información del Usuario</h3>
            </div><!-- /.box-header -->

            <div id="notificacion-datos-cliente"></div>


            {!!Form::model($usuario,['route'=> ['updateusuario',$usuario->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-cliente'])!!}
              <div class="box-body">
                   @include('back_end.usuarios.form.formulario')

                    <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
                    </div>
              </div>
            {!!Form::close()!!}

        </div>


    </div>

    <div class="col-md-6">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Editar Clave Usuario</h3>
            </div><!-- /.box-header -->

            <div id="notificacion-datos-clave"></div>
            {!!Form::model($usuario,['route'=> ['updateusuario',$usuario->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-clave'])!!}
              <div class="box-body">
                @include('back_end.usuarios.form.formulario_clave')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
                </div>
              </div>
            {!!Form::close()!!}

        </div>
    </div>



</div>