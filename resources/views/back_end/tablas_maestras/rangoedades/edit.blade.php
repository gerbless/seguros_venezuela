{!!Form::model($rango,['route'=> ['editar-rango',$rango->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-rango'])!!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit-Ramos</h3>
            </div><!-- /.box-header -->

            <div id="notificacion-datos-rango"></div>
            <div class="box-body">
                @include('back_end.tablas_maestras.rangoedades.form.formulario')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}