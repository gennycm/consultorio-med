<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Correo Electrónico</th>
        <th>Roles</th>
        <th width="280px">Acciones</th>
    </tr>
    @foreach ($users as $key => $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @endif
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Ver</a>
                @can('Editar usuarios')
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                @endcan
            @if($user->id != Auth::user()->id)
                @can('Eliminar usuarios')
                <button class="btn btn-danger" data-userid="{{$user->id}}" data-toggle="modal" data-target="#deleteUserModal">Eliminar</button>
                @endcan
            @endif
        </td>
    </tr>
    @endforeach
</table>
<div class="float-right">
    {!! $users->render() !!}
</div>