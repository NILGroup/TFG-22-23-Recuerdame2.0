@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de usuarios</h5>
        <hr class="lineaTitulo">
    </div>
    <div class ="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end d-flex">
                @if (Auth::user()->rol_id == 1)
                <!--<a href="/pacientes/0/cuidadores/crear"><button type="button"  id="mybutton" class="btn btn-primary btn-registro mx-3">Registro cuidador</button></a>-->
                <a href="{{route('pacientes.create')}}"><button type="button"  class="btn  btn-success"><i class="fa-solid fa-plus"></i></button></a>
                @endif
            </div>
        </div>
        <table id="tabla" class="table table-striped table-bordered table-condensed table-responsive datatable">
            <caption>Listado de usuarios</caption>
            <thead>
                <tr >
                    <th class="fit15 text-center" scope="col">Nombre</th>
                    <th class="fit5 text-center" scope="col">Género</th>
                    <th class="fit5 text-center" scope="col">Edad</th>
                    <th class="fit10 actions text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <!--<tbody>-->
            @foreach($pacientes as $paciente)
                <tr class="">
                    <td>
                        <a href=" @if (Auth::user()->rol_id == 1) /pacientes/{{$paciente->id}}/sesiones @else /pacientes/{{$paciente->id}}/calendario @endif" class="link-primary">
                            {{$paciente->nombre}} {{$paciente->apellidos}}
                        </a>
                    </td>
                    <td>
                        {{$paciente->genero->nombre}}
                    </td>
                    <td>
                        {{Carbon\Carbon::parse($paciente['fecha_nacimiento'])->age}} 
                    </td>
                    <td class="tableActions">
                        <div class="d-inline">
                        
                            <a href="/pacientes/{{$paciente->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver datos del usuario"></i></a>
                            <a href="{{route('pacientes.edit',$paciente->id)}}"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar usuario"></i></a>
                            <a href="/pacientes/{{$paciente->id}}/asignarTerapeutas"><i class="fa-solid fa-users-line text-success tableIcon" data-toggle="tooltip" data-placement="top" title="Asignar más terapeutas"></i></a>
                            <form method="post" action="{{ route('pacientes.destroy', $paciente->id) }}" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="confirm_delete" data-toggle="tooltip" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar usuario"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

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