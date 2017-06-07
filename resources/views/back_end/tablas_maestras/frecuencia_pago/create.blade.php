{!!Form::open(['route'=>'create-frecuencia-pago', 'method'=>'POST','class'=>'from-data','id'=>'datos-frecuencia-pago'])!!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add-Frecuencia de pago</h3>
            </div><!-- /.box-header -->
            <div id="notificacion-datos-frecuencia-pago"></div>
            <div class="box-body">
                @include('back_end.tablas_maestras.frecuencia_pago.form.formulario')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}