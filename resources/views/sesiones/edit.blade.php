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

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush