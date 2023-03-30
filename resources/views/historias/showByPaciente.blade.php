@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de recuerdos</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end d-flex">
                <a href="/pacientes/{{$paciente->id}}/recuerdos/crear"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de recuerdos</caption>
            <thead>
                <tr >
                    <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Enlace</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Fecha</th>
                    <th class="fit10 actions text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">

            @foreach($videos as $video)
            <tr>

                <td><a href={{$video->url}}>{{$video->url}}</a></td>
                <td>{{$video->estado}}</td>
                <td>{{$video->estado}}</td>
                <td class="tableActions">
                    <a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver información del recuerdo."></i></a>
                        <!-- Boton de eliminar -->
                        <form method="post" action="{{ route('recuerdo.destroy', $recuerdo->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"  data-toggle="tooltip" data-placement="top" title="Eliminar recuerdo."></i></button>
                        </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
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