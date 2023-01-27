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
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de evaluaciones</caption>
            <thead>
                <tr class="searcher">
                    <th scope="col">informe</th>
                    <th scope="col">fecha</th>
                    <th scope="col">sesiones desde el anterior informe de seguimiento</th>
                    <th scope="col">diagnóstico</th>
                </tr>
                <tr class="bg-primary">
                    <th scope="col">Informe</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Sesiones desde el anterior informe de seguimiento</th>
                    <th scope="col">Diagnóstico</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluaciones as $informe)
                <tr>
                    <td><a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe">Informe Nº {{$informe->id}}</td>
                    <td>{{Carbon\Carbon::parse($informe->fecha)->format("d/m/Y")}}</td>
                    <td>{{$informe->numSesiones}}</td>
                    <td>{{$informe->diagnostico}}</td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>
@endpush