<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th width="280px">Acciones</th>
    </tr>
    @if(count($roles)>0)
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Ver</a>
            @if ( $role->name != "Admin" )
            @can('Editar roles')
            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
            @endcan
            @can('Eliminar roles')
            <button class="btn btn-danger" data-roleid="{{$role->id}}" data-users="{{ count($role->users) > 0}}" data-toggle="modal" data-target="#deleteRolesModal">Eliminar</button>
            @endcan
            @endif
        </td>
    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="2">
            <div class="alert alert-info text-center" role="alert">
                No se encontraron resultados.
            </div>
        </td>
    </tr>
    @endif
</table>
<div class="float-right">
    {!! $roles->render() !!}
</div>