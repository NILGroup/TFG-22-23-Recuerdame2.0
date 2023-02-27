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
                <a href="/pacientes/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de informes de seguimiento</caption>
            <thead>
                <tr >
                    <th class="fit5" scope="col">Informe</th>
                    <th class="fit10" scope="col">Sesiones desde la última evaluación</th>
                    <th scope="col">Diagnóstico</th>
                    <th class="fit5" scope="col"></th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
                @foreach ($evaluaciones as $informe)
                <tr>
                    <td><a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver">Informe {{date("d/m/Y", strtotime($informe->fecha))}}</td>
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
                        <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe"><i class="fa-solid fa-print text-success tableIcon"></i></a>
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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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