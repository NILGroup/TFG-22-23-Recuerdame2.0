@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Informe de sesión</h5>
        <hr class="lineaTitulo">
    </div>
    <form action="/generarPDFInformeSesion" method="POST">
        {{csrf_field()}}
        @include('sesiones.desplegable')
        
        @include('informesSesion.listaItems')

        <div>
            <!-- <a href="/usuarios/{{$sesion->paciente->id}}/informesSesion"><button type="button" class="btn btn-primary">Atrás</button></a> -->
            <a href="/usuarios/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme"><button type="button" class="btn btn-secondary">Editar</button></a>
            <a href="/usuarios/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe" ><button type="button" class="btn btn-outline-primary">Generar PDF</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/sweetAlert2.js"></script>

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
