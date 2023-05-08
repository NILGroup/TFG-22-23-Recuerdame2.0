@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de vídeos</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end d-flex">
                <a href="/usuarios/{{$paciente->id}}/historias/generarHistoria"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de vídeos</caption>
            <thead>
                <tr >
                        <th scope="col" class="text-center">Vídeo</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Fecha</th>
                        <th class="fit10 actions text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">

            @foreach($videos as $video)
            <tr>

                <td><a href="/usuarios/{{$video->paciente_id}}/videos/{{$video->id}}">{{$video->nombre}}</a></td>
                <td>{{$video->estado}}</td>
                <td>{{$video->created_at}}</td>
                <td class="tableActions">
                    <a href="/usuarios/{{$video->paciente_id}}/videos/{{$video->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver información del video."></i></a>
                        <!-- Boton de eliminar -->
                        <form method="post" action="{{ route('video.destroy', $video->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"  data-toggle="tooltip" data-placement="top" title="Eliminar video."></i></button>
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