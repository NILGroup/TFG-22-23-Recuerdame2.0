@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar informe de sesión</h5>
        <hr class="lineaTitulo">
    </div>
    <form action="/cerrarInformeSesion" method="POST">
        
        {{csrf_field()}}
        @include('informesSesion.listaItems')

        @include('informesSesion.desplegable')

        <div>
            <a href="/pacientes/{{$sesion->paciente->id}}/sesiones"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" name="guardarInformeSesion" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>

    </form>
</div>

@include('recuerdos.modals')
@include('personasrelacionadas.modals')

@endsection

@push('scripts')
    @include('layouts.scripts') 
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="/js/table.js"></script>
    <script src="/js/recuerdo.js"></script>
    <script src="/js/persona.js"></script>
    <script src="/js/multiModal.js"></script>
@endpush
