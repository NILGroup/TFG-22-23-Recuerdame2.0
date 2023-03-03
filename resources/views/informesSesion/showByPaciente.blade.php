@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de informes de sesión</h5>
        <hr class="lineaTitulo">
    </div>
    <div class ="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de informes de sesiones</caption>
            <thead>
                <tr >
                    <th class="fit10 text-center" scope="col">Informe</th>
                    <th class="fit5 text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
                @foreach ($sesiones as $sesion)
                    <tr>
                        <td data-sort="{{ strtotime($sesion->fecha_finalizada) }}"><a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/ver">Informe {{date("d/m/Y", strtotime($sesion->fecha_finalizada))}}</td>
                        <td class="tableActions">
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/generarInforme"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe"><i class="fa-solid fa-print text-success tableIcon"></i></a>
                            <form method="post" action="{{ route('informesSesion.destroy', $sesion->id) }}" style="display:inline!important;">
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