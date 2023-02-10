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
                <a href="/pacientes/{{$paciente->id}}/cuidadores/crear"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de cuidadores</caption>
            <thead>
                <tr class="bg-primary busqueda">
                    <th class="fit10" scope="col">Nombre</th>
                    <th class="fit10" scope="col">Correo electrónico</th>
                    <th class="fit5" scope="col">Teléfono</th>
                    <th scope="col">Localidad</th>
                    <th class="fit5" scope="col">Grado de parentesco</th>
                    <th class="fit5" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuidadores as $cuidador)
                <tr>
                    <td><a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"> {{$cuidador->nombre}} {{$cuidador->apellidos}} </a></td>
                    <td>{{$cuidador->email}}</td>
                    <td>{{$cuidador->telefono}}</td>
                    <td>{{$cuidador->localidad}}</td>
                    <td>{{$cuidador->parentesco}}</td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('cuidadores.destroy', $cuidador->id) }}" style="display:inline!important;">
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