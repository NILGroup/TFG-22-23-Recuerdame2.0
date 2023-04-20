@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos del recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    @include('recuerdos.listaItems')
    <div id="showMultimedia" class="row pb-2">
            @foreach ($recuerdo->multimedias as $media)
                @include("layouts.multimedia")
            @endforeach
    </div>
    @if (Auth::user()->rol_id == 1)
    <div class="col-12">
        <!-- <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn">Atrás</button></a> -->
        <a href="/usuarios/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>   -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    
    <script src="/js/table.js"></script>
    <script src="/js/showView.js"></script>
    
    @if (Session::has('created'))
        @php 
            Illuminate\Support\Facades\Session::forget('created');
        @endphp
        <script>
            var action = "Modificado"
        </script>
        <script src="/js/successAlert.js"></script>
    @endif
@endpush