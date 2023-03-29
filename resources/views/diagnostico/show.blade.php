@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos informe de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/cerrarEvaluacion" method="POST">
        {{csrf_field()}}
        @include('diagnostico.listaItems')
        @include('diagnostico.charts')
        <div>
            <!-- <a href="/pacientes/{{$paciente->id}}/evaluaciones"><button type="button" class="btn btn-primary">Atrás</button></a> -->
            <a href="/pacientes/{{$paciente->id}}/editarDiagnostico"><button type="button" class="btn btn-secondary">Editar</button></a>
            <a href="/pacientes/{{$paciente->id}}/informeDiagnostico"><button type="button" class="btn btn-outline-primary">Generar PDF</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script> -->
    <script src="/js/libs/chart.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    <script src="/js/libs/touchSpin.js"></script>
    <script src="/js/showView.js"></script>
    <script src="/js/evaluacion.js"></script>
    <script src="/js/chart.js"></script>
    
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
