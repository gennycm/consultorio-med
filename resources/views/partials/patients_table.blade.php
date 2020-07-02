<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Celular</th>
        <th>Correo</th>
        <th>Persona</th>
        <th>Sucursal</th>
        <th width="280px">Acciones</th>
    </tr>
    @if(count($patients)>0)
    @foreach ($patients as $key => $patient)
    <tr>
        <td>{{ $patient->name }} {{ $patient->first_lastname }} {{ $patient->second_lastname }}</td>
        <td>{{ $patient->cellphone }}</td>
        <td>{{ $patient->email }}</td>
        <td>
            @if ($patient->p_phys === 0)
            Física
            @elseif ($patient->p_moral === 0)
            Moral
            @endif
        </td>
        <td>
            {{$patient->branch}}
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('patients.show',$patient->id) }}">Ver</a>
            @can('Editar pacientes')
            <a class="btn btn-primary" href="{{ route('patients.edit',$patient->id) }}">Editar</a>
            @endcan
            @can('Eliminar pacientes')
            <button class="btn btn-danger" data-patid="{{$patient->id}}" data-toggle="modal" data-target="#deletePatModal">Eliminar</button>
            @endcan
        </td>
    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="6">
            <div class="alert alert-info text-center" role="alert">
                No se encontraron resultados.
            </div>
        </td>
    </tr>
    @endif
</table>
<div class="float-right">
    {!! $patients->render() !!}
</div>