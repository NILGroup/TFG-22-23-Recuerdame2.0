<div>
    <input type="hidden" id="id" name="id" value="{{$sesion->id}}">
    <div class="row">
        <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha sesión<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}"  required @if($show) disabled @endif>
        </div>
    </div>

    <div class="row">
        <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de informe<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="date" class="form-control form-control-sm" id="fecha_finalizada" name="fecha_finalizada" value="{{$sesion->fecha_finalizada}}" required @if($show) disabled @endif>
        </div>
    </div>

    <div class="mb-3">
        <label for="respuesta" class="form-label col-form-label-sm">Respuesta del paciente<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="respuesta" name="respuesta" rows="1" required @if($show) disabled @endif>{{$sesion->respuesta}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label col-form-label-sm">Observaciones<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="1" required @if($show) disabled @endif>{{$sesion->observaciones}}</textarea>
    </div>

</div>