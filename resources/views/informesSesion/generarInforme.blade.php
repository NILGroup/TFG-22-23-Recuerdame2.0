@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar informe de sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/cerrarInforme" method="POST">
    {{csrf_field()}}
        <div>
            <input type="hidden" id="id" name="id" value="{{$sesion->id}}">
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha sesión</label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}">
                </div>
            </div>

            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de informe<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha_finalizada" name="fecha_finalizada" value="{{$sesion->fecha_finalizada}}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="respuesta" class="form-label col-form-label-sm">Respuesta del paciente<span class="asterisco">*</span></label>
                <textarea class="form-control form-control-sm" id="respuesta" name="respuesta" rows="1" required>{{$sesion->respuesta}}</textarea>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label col-form-label-sm">Observaciones<span class="asterisco">*</span></label>
                <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="1" required>{{$sesion->observaciones}}</textarea>
            </div>

            <div>
                <button type="submit" name="guardarInformeSesion" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
                <a href="/pacientes/{{$sesion->paciente->id}}/sesiones"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
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

@endpush
