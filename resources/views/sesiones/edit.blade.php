@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/update" method="POST">
        {{csrf_field()}}
        @include('sesiones.listaItems')
        <div>
            <button type="submit" name="guardarSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@include('sesiones.modals')
@include('recuerdos.modals')

@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush