<div class="form-group col-xs-12">
        {!!Form::label('documento','Cédula:')!!}
        {!!Form::text('documento',null,['class'=>'form-control','placeholder'=>'Cédula de Identidad','required'=>'required'])!!}
</div>

<div class="form-group col-xs-12">
        {!!Form::label('name','Nombres:')!!}
        {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese Nombre','required'=>'required'])!!}
</div>

<div class="form-group col-xs-12">
        {!!Form::label('email','Correo:')!!}
        {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Infrese Correo','required'=>'required'])!!}
        {!!Form::hidden('frm','datos-usuarios')!!}
</div>

<div class="form-group col-xs-12">
        {!!Form::label('tipo','Tipo Usuario:')!!}
        {!!Form::select('tipo',array('AGENTES'=>'AGENTES','SUPERVISOR'=>'SUPERVISOR','ADMINISTRADOR'=>'ADMINISTRADOR','CLIENTE'=>'CLIENTE'), null, ['id'=>'tipo','class' => 'form-control','placeholder'=>'Tipo Usuario','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-12">
        {!!Form::label('supervisor_users_id','Supervisor:')!!}
        {!!Form::select('supervisor_users_id',$supervisor, null, ['id'=>'tipo','class' => 'form-control','placeholder'=>'SELECCIONE','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-12">
        {!!Form::label('status_id','Status:')!!}
        {!!Form::select('status_id',array('1'=>'ACTIVO','2'=>'INACTIVO'), null, ['id'=>'STATUS','class' => 'form-control','placeholder'=>'SELECCIONE','required'=>'required'] )!!}
</div>