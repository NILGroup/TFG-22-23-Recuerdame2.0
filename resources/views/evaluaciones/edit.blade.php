@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos informe de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/cerrarEvaluacion" method="POST">
        {{csrf_field()}}
        @include('evaluaciones.listaItems')
        <div>
            <button type="submit" name="guardarInformeSeguimiento" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/evaluaciones"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>
    $('.escalaPersonalizada').change(function (){
        var nombreEscala = document.getElementById('nombre_escala').value, 
            escala = document.getElementById('escala').value;
        if((nombreEscala == null && escala == null) || (nombreEscala == "" && escala == "") ){
            document.getElementById('nombre_escala').required = false;
            escala = document.getElementById('escala').required = false;
            fechaEscala = document.getElementById('fecha_escala').required = false;
        }
        else{
            document.getElementById('nombre_escala').required = true;
            escala = document.getElementById('escala').required = true;
            fechaEscala = document.getElementById('fecha_escala').required = true;
        }
    });
</script>
@endpush