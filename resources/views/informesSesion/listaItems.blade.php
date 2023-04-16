<div>
    <input type="hidden" id="idSesion" name="id" value="{{$sesion->id}}">
    <div class="row align-items-center">
        <label for="fecha" class="form-label col-form-label col-sm-3 col-md-2 col-lg-2 negrita">Fecha sesión:<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="datetime-local" class="form-control form-control-sm" id="fechaInforme" name="fecha" value="{{$sesion->fecha}}"  required >
        </div>
    </div>
    <div class="row align-items-center">
        <label for="fecha_fin" class="form-label col-form-label col-sm-3 col-md-2 col-lg-2 negrita">Fecha de finalización:<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="datetime-local" class="form-control form-control-sm" id="fecha_fin" name="fecha_finalizada" value="{{$sesion->fecha_finalizada}}" required >
        </div>
    </div>
    <div class="row align-items-center">
        <label for="duracion" class="form-label col-form-label col-sm-3 col-md-2 col-lg-2 negrita">Duración:<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-2">
            <input type="time" class="form-control form-control-sm" id="duracion" name="duracion" value= @if(is_null($sesion->duracion)) "00:00" @else "{{$sesion->duracion}}" @endif  required >
        </div>
    </div>
    
    <div class="row col-sm-6 col-md-6 col-lg-6 align-items-center ">
        <label for="participacion" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-3">Nivel de participación:</label>
        <div class="col-sm-12 col-md-12 col-lg-7 align-items-center">
            <select class="form-select form-select-sm" id="idParticipacion" name="participacion_id">
                <option></option>
                @foreach ($participaciones as $participacion)
                <option value="{{$participacion->id}}" @if($participacion->id == $sesion->participacion_id) selected @endif>{{$participacion->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row col-sm-6 col-md-6 col-lg-6 align-items-center ">
        <label for="complejidad" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-3">Nivel de complejidad:</label>
        <div class="col-sm-12 col-md-12 col-lg-7 align-items-center">
            <select class="form-select form-select-sm" id="idComplejidad" name="complejidad_id">
                <option></option>
                @foreach ($complejidades as $complejidad)
                <option value="{{$complejidad->id}}" @if($complejidad->id == $sesion->complejidad_id) selected @endif>{{$complejidad->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="respuesta" class="form-label col-form-label negrita">Respuesta del usuario:<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="respuesta" name="respuesta" rows="3" required >{{$sesion->respuesta}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label col-form-label negrita">Observaciones:<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3" required >{{$sesion->observaciones}}</textarea>
    </div>

    <div class="mb-3">
        <label for="barreras" class="form-label col-form-label negrita">Barreras:</label>
        <textarea class="form-control form-control-sm" id="barreras" name="barreras" rows="3" >{{$sesion->barreras}}</textarea>
    </div>

    <div class="mb-3">
        <label for="facilitadores" class="form-label col-form-label negrita">Facilitadores:</label>
        <textarea class="form-control form-control-sm" id="facilitadores" name="facilitadores" rows="3" >{{$sesion->facilitadores}}</textarea>
    </div>

    <div class="mb-3">
        <label for="facilitadores" class="form-label col-form-label negrita">Propuestas de mejora:</label>
        <textarea class="form-control form-control-sm" id="propuestas" name="propuestas" rows="3" >{{$sesion->propuestas}}</textarea>
    </div>
</div>