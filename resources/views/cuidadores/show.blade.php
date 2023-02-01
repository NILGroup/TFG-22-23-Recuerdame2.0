@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Ver cuidador</h5>
        <hr class="lineaTitulo">
    </div>

    <form method="POST" action="/registroCuidador" id="formulario">
        {{csrf_field()}}
        @include('cuidadores.listaItems')
        <div>
            <a href="/pacientes/{{$paciente->id}}/cuidadores"><button type="button" class="btn btn-primary">Atrás</button></a>
            <a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/showView.js"></script>
@endpush