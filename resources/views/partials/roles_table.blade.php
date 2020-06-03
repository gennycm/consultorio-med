<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th width="280px">Acciones</th>
    </tr>
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
                <button class="btn btn-danger" data-roleid="{{$role->id}}" data-toggle="modal" data-target="#deleteRolesModal">Eliminar</button>
                @endcan
            @endif
        </td>
    </tr>
    @endforeach
</table>
<div class="float-right">
    {!! $roles->render() !!}
</div>