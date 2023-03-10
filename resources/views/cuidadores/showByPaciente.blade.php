@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Lista cuidadores</h5>
        <hr class="lineaTitulo">
    </div>
    <div class ="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end align-items-center d-flex">
                <button type="button" class="btn btn-success showmodal mx-1" data-bs-toggle="modal" data-bs-target="#modalCuidador">Añadir existente</button>
                <a href="/pacientes/{{$paciente->id}}/cuidadores/crear"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de cuidadores</caption>
            <thead>
                <tr class="busqueda">
                    <th class="fit10 text-center" scope="col">Nombre</th>
                    <th class="fit10 text-center" scope="col">Correo electrónico</th>
                    <th class="fit5 text-center" scope="col">Teléfono</th>
                    <th class="fit5 text-center" scope="col">Localidad</th>
                    <th class="fit5 text-center" scope="col">Parentesco</th>
                    <th class="fit5 actions text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
                @foreach($cuidadores as $cuidador)
                <tr>
                    <td><a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"> {{$cuidador->nombre}} {{$cuidador->apellidos}} </a></td>
                    <td>{{$cuidador->email}}</td>
                    <td>{{$cuidador->telefono}}</td>
                    <td>{{$cuidador->localidad}}</td>
                    <td>{{$cuidador->parentesco}}</td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver los datos del cuidador."></i></a>
                        <a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar cuidador."></i></a>
                        <form method="post" action="{{ route('cuidadores.destroy', $cuidador->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar cuidador."></i></button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('layouts.deletePopUp')
@include('cuidadores.existente')

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