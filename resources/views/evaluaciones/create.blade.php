@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos informe de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/cerrarEvaluacion" method="POST">
    {{csrf_field()}}
        <div>
            <input type="hidden" class="form-control form-control-sm" id="fecha" name="paciente_id" value="{{$paciente->id}}" required>
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="" required>
                </div>
            </div>
            <div class="row">
                <label for="escalas" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Escalas</b></label>
            </div>
            <div class="row">
                <label for="escala" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Escala</b></label>
                <label for="valor" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Valor</b></label>
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Fecha</b></label>
        
            </div>
            <div class="row">
                <label for="GDS" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">GDS<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="number" min="1" max="7" class="form-control form-control-sm" id="gds" name="gds" value="" required>
        
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="gds_fecha" name="gds_fecha" value="" required>
                </div>
            </div>
            <div class="row">
                <label for="Mental" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Mini mental/MEC de Lobo<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="number" min="0" max="25" class="form-control form-control-sm" id="mental" name="mental" value="" required>
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="mental_fecha" name="mental_fecha" value="" required>
                </div>
            </div>
            <div class="row">
                <label for="CDR" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">CDR<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="number" min="0" max="3" class="form-control form-control-sm" id="cdr" name="cdr" value="" required>
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="cdr_fecha" name="cdr_fecha" value="" required>
                </div>
            </div>
            
                <div class="row">
                    <label for="Otra_escala" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Otra escala</b></label>
                </div>
                <div class="row">
                    <label for="escala" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Escala</b></label>
                    <label for="valor" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Valor</b></label>
                    <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2"><b>Fecha</b></label>
        
                </div>
    
            <div class="row">
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="text" class="form-control form-control-sm escalaPersonalizada" id="nombre_escala" name="nombre_escala" value="" >
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="number" class="form-control form-control-sm escalaPersonalizada" id="escala" name="escala" value="" >
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm escalaPersonalizada" id="fecha_escala" name="fecha_escala" value="" >
                </div>
            </div>
            
            <div class="mb-3">
                <label for="diagnostico" class="form-label col-form-label-sm">Diagnostico<span class="asterisco">*</span></label>
                <textarea class="form-control form-control-sm" id="diagnostico" name="diagnostico" rows="1" required></textarea>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
                <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="1"></textarea>
            </div>

            <div>
                <button type="submit" name="guardarInformeSeguimiento" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
                <a href="/pacientes/{{$paciente->id}}/evaluaciones"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
            </div>
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
