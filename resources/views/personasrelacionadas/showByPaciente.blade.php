@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de personas relacionadas</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="d-flex justify-content-between upper">
        @include('layouts.tableSearcher')
        <div class="justify-content-end d-flex">
            <a href="/pacientes/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
        </div>
    </div>

    <div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de personas relacionadas</caption>
            <thead>
                <tr class="bg-primary">
                    <th scope="col">Nombre</th>
                    <th class="fit10" scope="col">Tipo de Relacion</th>
                    <th class="fit5" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    <td><a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}">{{$persona->nombre}} {{$persona->apellidos}}</a> @if($persona->contacto)★@endif</td>
                    <td>{{$persona->tiporelacion->nombre}}</td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('personas.destroy', $persona->id) }}" style="display:inline!important;">
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