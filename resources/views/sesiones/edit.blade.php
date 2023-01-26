@extends('layouts.structure')

@section('content')


<form action="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/update" method="POST">
    {{csrf_field()}}
    @include('sesiones.listaItems')
    <div>
        <button type="submit" name="guardarSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</form>

@include('sesiones.models')
@include('recuerdos.models')

@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush