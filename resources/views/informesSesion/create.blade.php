@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <form action="/cerrarInformeSesion" method="POST">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Generar informe de sesión</h5>
            <hr class="lineaTitulo">
        </div>
        {{csrf_field()}}
        @include('informesSesion.listaItems')
        
        <div>
            <button type="submit" name="guardarInformeSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$sesion->paciente->id}}/informesSesion"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>

    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush
