@extends('layouts.structure')

@section('content')

<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de informes de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <a href="/pacientes/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
        </div>
    </div>
    <div>
        <table id="tabla" class="table table-bordered table-striped table-responsive">
            <caption>Listado de evaluaciones</caption>
            <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Informe</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Sesiones desde el anterior informe de seguimiento</th>
                    <th scope="col">Diagnóstico</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach ($evaluaciones as $informe)
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe">Informe Nº {{$informe->id}}</td>
                    <td>{{$informe->fecha}}</td>
                    <td>{{$informe->numSesiones}}</td>
                    <td>{{$informe->diagnostico}}</td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')

    @include('layouts.scripts')

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script>
        $(document).ready(function () {
            $('#tabla').DataTable({
                paging: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });
        });
    </script>
@endpush