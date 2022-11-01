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
    @include('layouts.scripts')
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