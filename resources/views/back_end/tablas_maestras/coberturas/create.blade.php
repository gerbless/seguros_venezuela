{!!Form::open(['route'=>'create-cobertura', 'method'=>'POST','class'=>'from-data','id'=>'datos-cobertura'])!!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Add-Cobertura</h3>
            </div><!-- /.box-header -->
            <div id="notificacion-datos-cobertura"></div>
            <div class="box-body">
                @include('back_end.tablas_maestras.coberturas.form.formulario')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}