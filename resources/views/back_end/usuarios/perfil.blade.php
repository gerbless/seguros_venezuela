<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Crear Perfil de Usuario</h3>
            </div><!-- /.box-header -->
            <div id="notificacion-datos-create-cliente"></div>
            {!!Form::open(['route'=>['perfil-update',':SUBMENU_ID',$usuario->id,':ACCION_ID'], 'method' => 'PUT','id'=>'from-ck'])!!}
            <div class="box-body">
              @include('back_end.usuarios.form.ckperfiles')
            </div>
            {!!Form::close()!!}

        </div>

    </div>
</div>

<script>
    function marcar(obj){
        var id=  $(obj).attr('id');
        var valor = $(obj).prop('checked');
        var from=$('#from-ck');
        var url= from.attr('action').replace(':SUBMENU_ID',id);
        var url= url.replace(':ACCION_ID',valor);
        var data = from.serialize();
        $.post(url,data,function(result){
            if(result==0)
            {
                if(valor==false)
                {
                    $(this).prop('checked',true);
                }else{
                    $(this).prop('checked',false);
                }
            }
        })
    }
</script>