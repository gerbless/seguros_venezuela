{!!Form::open(['route'=>'create-rango', 'method'=>'POST','class'=>'from-data','id'=>'datos-rango'])!!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add-Rango</h3>
            </div><!-- /.box-header -->
            <div id="notificacion-datos-rango"></div>
            <div class="box-body">
                @include('back_end.tablas_maestras.rangoedades.form.formulario')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}