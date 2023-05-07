@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de personas relacionadas</h5>
        <hr class="lineaTitulo">
    </div>

    <div class ="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end d-flex">
                <a href="/usuarios/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de personas relacionadas</caption>
            <thead>
                <tr >
                    <th class="fit15 text-center" scope="col">Nombre</th>
                    <th class="fit10 text-center" scope="col">Dirección</th>
                    <th class="fit10 text-center" scope="col">Tipo de relación</th>
                    <th class="fit10 actions text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
                @foreach($personas as $persona)
                <tr>
                    <td><a href="/usuarios/{{$paciente->id}}/personas/{{$persona->id}}">{{$persona->nombre}} {{$persona->apellidos}}</a> @if($persona->contacto)★@endif</td>
                    <td>{{$persona->localidad}}</td>
                    <td>
                        @if (isset($persona->tipo_custom))
                            {{$persona->tipo_custom}}
                        @else
                            {{$persona->tiporelacion->nombre}}
                        @endif
                    </td>
                    <td class="tableActions">
                        <a href="/usuarios/{{$paciente->id}}/personas/{{$persona->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver datos de la persona"></i></a>
                        <a href="/usuarios/{{$paciente->id}}/personas/{{$persona->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar persona"></i></a>
                        <form method="post" action="{{ route('personas.destroy', $persona->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar persona"></i></button>
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