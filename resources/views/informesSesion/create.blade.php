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
        
        <div>
            <button type="submit" name="guardarInformeSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$sesion->paciente->id}}/sesiones"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>

    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush
