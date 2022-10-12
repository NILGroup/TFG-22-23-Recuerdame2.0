@extends('layouts.structure')

@section('content')

<div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Listado de sesiones</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
                <a href="{{route('sesiones.create')}}"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>

        <div>
            <table class="table table-bordered recuerdameTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Objetivo</th>
                        <th scope="col">Finalizada/No finalizada</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                @foreach($sesiones as $sesion)
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="{{route('sesiones.show',$sesion->id)}}">{{date("d/m/Y", strtotime($sesion->fecha))}}</a></td>
                        <td>{{$sesion->objetivo}}</td>
                        <td>
                            @if($sesion->fecha_finalizada != null)
                            <i class="fa-solid fa-check text-success tableIcon"></i>{{date("d/m/Y", strtotime($sesion->fecha_finalizada))}}</td>
                            @endif
                        <td class="tableActions">
                            <a href="{{route('sesiones.show',$sesion->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            @if($sesion->fecha_finalizada == null)
                                <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme"><i class="fa-solid fa-file-pen text-success tableIcon"></i></a>
                            @else
                                <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/informe"><i class="fa-solid fa-file-circle-check text-success tableIcon"></i></a>
                            @endif
                            <form method="POST" action="{{ route('sesiones.destroy', $sesion->id) }}"  class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-link shadow-none tableIcon" onclick="confirmar(event)"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></input>
                            </form>
                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
  
<script>
function confirmar(e)
{
    if(!confirm('¿Seguro que desea eliminar esta sesión?')) {
        e.preventDefault();
    }
}
</script>
@endsection
