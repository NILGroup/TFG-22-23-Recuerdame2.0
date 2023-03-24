@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la sesión</h5>
        <hr class="lineaTitulo">
    </div>
    
    @include('sesiones.listaItems')
    <div id="showMultimedia" class="row pb-2">
        @foreach ($sesion->multimedias as $media)
            @include("layouts.multimedia")
        @endforeach
    </div>

    <div>
        <!-- <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a> -->
        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
    </div>
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
