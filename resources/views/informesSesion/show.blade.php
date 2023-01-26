@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar informe de sesión</h5>
        <hr class="lineaTitulo">
    </div>
    <form action="/generarPDFInformeSesion" method="POST">
        
        {{csrf_field()}}
        @include('informesSesion.listaItems')
        <!--
        <div>
            <input type="hidden" id="id" name="id" value="{{$sesion->id}}">
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha sesión</label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input disabled type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}">
                </div>
            </div>

            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de informe</label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input disabled type="date" class="form-control form-control-sm" id="fecha_finalizada" name="fecha_finalizada" value="{{$sesion->fecha_finalizada}}">
                </div>
            </div>

            <div class="mb-3">
                <label for="respuesta" class="form-label col-form-label-sm">Respuesta del paciente</label>
                <textarea disabled class="form-control form-control-sm" id="respuesta" name="respuesta" rows="1">{{$sesion->respuesta}}</textarea>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
                <textarea disabled class="form-control form-control-sm" id="observaciones" name="observaciones" rows="1">{{$sesion->observaciones}}</textarea>
            </div>

        </div>
        -->
        
        <div>
            <a href="/pacientes/{{$sesion->paciente->id}}/informesSesion"><button type="button" class="btn btn-primary">Atrás</button></a>
            <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme"><button type="button" class="btn btn-secondary">Editar</button></a>
            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe" ><button type="button" class="btn btn-outline-primary">Generar PDF</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush
