@extends('layouts.structure')

@section('content')


<form action="/sesion/{{$sesion->id}}" method="POST" class="dropzone">
    {{csrf_field()}}
    @include('sesiones.listaItems')
    <div>
        <button type="submit" name="guardarSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</form>

@include('sesiones.models')

@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush