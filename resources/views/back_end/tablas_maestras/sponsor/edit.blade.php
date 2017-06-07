{!!Form::model($data,['route'=> ['editar-sponsor',$data->id],'method'=>'PUT','class'=>'from-data','id'=>'datos-sponsor'])!!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Edit-Sponsor</h3>
            </div><!-- /.box-header -->

            <div id="notificacion-datos-sponsor"></div>
            <div class="box-body">
                @include('back_end.tablas_maestras.sponsor.form.formulario')
                <div class="col-md-12 col-md-offset-5">
                    {!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}