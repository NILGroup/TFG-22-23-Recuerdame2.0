<div>
    <input type="hidden" id="id" name="id" value="{{$sesion->id}}">
    <div class="row">
        <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha sesión<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}"  required @if($show) disabled @endif>
        </div>
    </div>
    <div class="row">
        <label for="duracion" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Duración<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="time" class="form-control form-control-sm" id="duracion" name="duracion" value="{{$sesion->duracion}}"  required @if($show) disabled @endif>
        </div>
    </div>
    <div class="row">
        <label for="apto" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Apto para continuar este tipo de terapias<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <!-- Si el checkbox está desmarcado se utiliza el hidden -->
            <input type="hidden"id="apto" name="apto" value="0">
            <input type="checkbox" class="form-check-input" value="1" id="apto" name="apto" @if($show) disabled @endif @if($sesion->apto) checked @endif>
        </div>
    </div>
    
    <input type="hidden" class="form-control form-control-sm" id="fecha_finalizada" name="fecha_finalizada" value="{{$sesion->fecha_finalizada}}" required @if($show) disabled @endif>
        
    <div class="mb-3">
        <label for="respuesta" class="form-label col-form-label-sm">Respuesta del paciente<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="respuesta" name="respuesta" rows="3" required @if($show) disabled @endif>{{$sesion->respuesta}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label col-form-label-sm">Observaciones<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3" required @if($show) disabled @endif>{{$sesion->observaciones}}</textarea>
    </div>

    <div class="mb-3">
        <label for="barreras" class="form-label col-form-label-sm">Barreras</label>
        <textarea class="form-control form-control-sm" id="barreras" name="barreras" rows="3" @if($show) disabled @endif>{{$sesion->barreras}}</textarea>
    </div>

    <div class="mb-3">
        <label for="facilitadores" class="form-label col-form-label-sm">Facilitadores</label>
        <textarea class="form-control form-control-sm" id="facilitadores" name="facilitadores" rows="3" @if($show) disabled @endif>{{$sesion->facilitadores}}</textarea>
    </div>
</div>