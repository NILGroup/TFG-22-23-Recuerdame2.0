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
        <!--
        <div>
            <input type="hidden" class="form-control form-control-sm" id="fecha" name="paciente_id" value="{{$paciente->id}}" required @if($show) disabled @endif>
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="" required @if($show) disabled @endif>
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
                        <input type="number" min="1" max="7" class="form-control form-control-sm" id="gds" name="gds" value="" required @if($show) disabled @endif>
        
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="gds_fecha" name="gds_fecha" value="" required @if($show) disabled @endif>
                </div>
            </div>
            <div class="row">
                <label for="Mental" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Mini mental/MEC de Lobo<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="number" min="0" max="25" class="form-control form-control-sm" id="mental" name="mental" value="" required @if($show) disabled @endif>
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="mental_fecha" name="mental_fecha" value="" required @if($show) disabled @endif>
                </div>
            </div>
            <div class="row">
                <label for="CDR" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">CDR<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                        <input type="number" min="0" max="3" class="form-control form-control-sm" id="cdr" name="cdr" value="" required @if($show) disabled @endif>
                </div>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="cdr_fecha" name="cdr_fecha" value="" required @if($show) disabled @endif>
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
                <textarea class="form-control form-control-sm" id="diagnostico" name="diagnostico" rows="1" required @if($show) disabled @endif></textarea>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
                <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="1"></textarea>
            </div>

        </div>
        -->
        <div>
            <button type="submit" name="guardarInformeSeguimiento" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/evaluaciones"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/escalaEvaluacion.js"></script>
@endpush
