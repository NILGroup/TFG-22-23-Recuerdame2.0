@extends('layouts.structure')

@section('content')

<div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Listado de sesiones</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
                <a href="/sesion/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
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
                @foreach($sesiones as $sesion)
                    <?php $i=1; ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="{{route('sesiones.show',$sesion->id)}}">{{date("d/m/Y", strtotime($sesion->fecha))}}</a></td>
                        <td>{{$sesion->objetivo}}</td>
                        <td>
                            @if($sesion->fecha_finalizada != null)
                            <i class="fa-solid fa-check text-success tableIcon"></i>{{$sesion->fecha_finalizada}}</td>
                            @endif
                        <td class="tableActions">
                            <a href="{{route('sesiones.show',$sesion->id, false)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/sesiones/editar/{{$sesion->id}}"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            @if($sesion->fecha_finalizada != null)
                                <a href="{{route('sesiones.show',$sesion->id, false)}}"><i class="fa-solid fa-file-circle-check text-success tableIcon"></i></a>
                            @else
                                <a href="{{route('sesiones.show',$sesion->id, false)}}"><i class="fa-solid fa-file-circle-check text-success tableIcon"></i></a>
                            @endif

                            <a href="{{route('sesiones.destroy',$sesion->id)}}"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></a>
                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
@endsection
