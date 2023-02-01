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
            <div class="justify-content-end d-flex">
                <a href="/pacientes/{{$paciente->id}}/sesiones/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>

        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de sesiones</caption>
            <thead>
                <tr class="bg-primary">
                    <th class="fit5" scope="col">Fecha</th>
                    <th scope="col">Objetivo</th>
                    <th class="fit5" scope="col">Informe</th>
                    <th class="fit5" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sesiones as $sesion)
                <tr>
                    <td><a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}">{{date("d/m/Y", strtotime($sesion->fecha))}}</a></td>
                    <td>{{$sesion->objetivo}}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if($sesion->fecha_finalizada == null)
                            <a class="btn btn-success btn-sm" style="width: 100%;" role="button" href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme">Finalizar</a>
                            @else
                            <a class="btn btn-primary btn-sm" style="width: 100%;" role="button" href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/informe">Ver informe</a>
                            @endif
                        </div>
                        
                
                    </td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        
                        <form method="post" action="{{ route('sesiones.destroy', $sesion->id) }}" style="display:inline!important;">
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