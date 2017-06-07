<div class="box box-primary">
    <div class="box-header">
        <h4 class="box-title">Buscar Usuarios</h4>
    </div>

    <div class="box-body">
        @if(count($usuarios) >  0)
            <table id="tabla_pacientes" class="display table table-hover" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>email</th>
                    <th>Tipo</th>
                    <th>Acción</th>
                </tr>
                </thead>

                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->tipo }}</td>
                        <td><button class="btn  btn-success btn-xs" onclick="modalFicha([{{ $usuario->id }},'editar-usuario']);" ><i class="fa fa-fw fa-eye"></i> Ver</button></td>
                        <td><button class="btn  btn-primary btn-xs" onclick="modalFicha([{{ $usuario->id }},'perfil-usuario']);" ><i class="fa fa-user-md"></i> Roles</button></td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            @else
            @include('alerts.noresult')
        @endif
    </div>
</div>