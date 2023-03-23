@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de sesiones</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end align-items-center  d-flex">
                <a href="/pacientes/{{$paciente->id}}/sesiones/crear"><button type="button" class="btn btn-success "><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>

        <table id="tabla" class=" overflow-hidden table table-bordered  table-striped table-responsive datatable">
            <caption>Listado de sesiones</caption>
            <thead>
                <tr class="">
                    <th class="fit10 text-center" scope="col">Fecha</th>
                    <th scope="col" class="text-center">Objetivo</th>
                    <th class="fit5 text-center tableActions" scope="col">Acciones</th>
                    <th class="fit10 actions text-center" scope="col">Estado</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
                @foreach($sesiones as $sesion)
                <tr>
                    <td data-sort="{{ strtotime($sesion->fecha) }}"><a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}">{{date("d/m/Y", strtotime($sesion->fecha))}}</a></td>
                    <td>{{$sesion->objetivo}}</td>
                    
                    <td class="tableActions align-center">
                        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver datos de la sesión"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar sesión"></i></a>
                        
                        <form method="post" action="{{ route('sesiones.destroy', $sesion->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar sesión"></i></button>
                        </form>
                    </td>
                    <td class="tableActions align-center">
                        @if(!$sesion->finalizada)
                            <a class="btn btn-success btn-sm w-100 botonAccionTablas"  role="button" href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme">Finalizar</a>
                        @else
                            <a class="btn btn-primary btn-sm w-100 botonAccionTablas"  role="button" href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/ver">Ver informe</a>
                        @endif
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