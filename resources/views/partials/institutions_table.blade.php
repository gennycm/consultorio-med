<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Relación a otra Institución</th>
        <th width="280px">Acciones</th>
    </tr>
    @if(count($institutions)>0)
    @foreach ($institutions as $key => $institution)
    @if($institution->id != 1)
    <tr>
        <td>{{ $institution->name }}</td>
        <td>{{ $institution->parent['name'] }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('institutions.show',$institution->id) }}">Ver</a>
            @can('Editar instituciones')
            <a class="btn btn-primary" href="{{ route('institutions.edit',$institution->id) }}">Editar</a>
            @endcan
            @can('Eliminar instituciones')
            <button class="btn btn-danger" data-instid="{{$institution->id}}" data-patients="{{ count($institution->patients) > 0}}" data-toggle="modal" data-target="#deleteInstModal">Eliminar</button>
            @endcan
        </td>
    </tr>
    @endif
    @endforeach
    @else
    <tr>
        <td colspan="3">
            <div class="alert alert-info text-center" role="alert">
                No se encontraron resultados.
            </div>
        </td>
    </tr>
    @endif
</table>
<div class="float-right">
    {!! $institutions->render() !!}
</div>