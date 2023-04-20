@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de informes de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <div class ="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end d-flex">
                <a href="/usuarios/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped datatable">
            <caption>Listado de informes de seguimiento</caption>
            <thead>
                <tr >
                    <th class="fit5 text-center" scope="col">Informe</th>
                    <th class="fit10 text-center" scope="col">Sesiones desde el anterior</th>
                    <th class=" text-center" scope="col">Diagnóstico</th>
                    <th class="fit5 text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
                @foreach ($evaluaciones as $informe)
                <tr>
                    <td data-sort="{{ strtotime($informe->fecha) }}"><a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver">Informe {{date("d/m/Y", strtotime($informe->fecha))}}</td>
                    <td>{{$informe->numSesiones}}</td>
                    <td>{{$informe->diagnostico}}</td>
                    <td class="tableActions">
                        <a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver informe"></i></a>
                        <a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar informe"></i></a>
                        <a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe"><i class="fa-solid fa-print text-success tableIcon" data-toggle="tooltip" data-placement="top" title="Vista de impresión del informe"></i></a>
                        <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar informe"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('layouts.deletePopUp')

@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>   -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>
    
    @if (Session::has('created'))
        @php 
            Illuminate\Support\Facades\Session::forget('created');
        @endphp
        <script>
            var action = "Creado"
        </script>
        <script src="/js/successAlert.js"></script>
    @endif
@endpush