@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar informe de sesión</h5>
        <hr class="lineaTitulo">
    </div>
    <form action="/generarPDFInformeSesion" method="POST">
        {{csrf_field()}}
        @include('informesSesion.listaItems')

        <div>
            <a href="/pacientes/{{$sesion->paciente->id}}/informesSesion"><button type="button" class="btn btn-primary">Atrás</button></a>
            <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme"><button type="button" class="btn btn-secondary">Editar</button></a>
            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe" ><button type="button" class="btn btn-outline-primary">Generar PDF</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/showView.js"></script>
@endpush
