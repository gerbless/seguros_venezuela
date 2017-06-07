{!!Form::open(['route'=>'create-campana', 'method'=>'POST','class'=>'from-data','id'=>'datos-campana'])!!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add-Campaña</h3>
            </div><!-- /.box-header -->
            <div id="notificacion-datos-campana"></div>
            <div class="box-body">
                @include('back_end.tablas_maestras.campana.form.formulario')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}