<input type="hidden" name="paciente_id" class="form-control form-control-sm" id="paciente_id" value="{{$idPaciente}}" required @if($show) disabled @endif>
<input type="hidden" name="id" class="form-control form-control-sm" id="id" value="{{$persona->id}}" required @if($show) disabled @endif>
<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$persona->nombre}}" required @if($show) disabled @endif>
            
        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$persona->apellidos}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono</label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="text" name="telefono" class="form-control form-control-sm" id="telefono" value="{{$persona->telefono}}" @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$persona->ocupacion}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="email" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Email<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="email" name="email" class="form-control form-control-sm" id="email" value="{{$persona->email}}" required @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="localidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Localidad<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="localidad" class="form-control form-control-sm" id="localidad" value="{{$persona->localidad}}" required @if($show) disabled @endif>   
        </div>
    </div>
</div>

<div class="row form-group justify-content-between" >
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de relación<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            
            <select onchange="especifique()" style="margin-right: 5px" class="form-select form-select-sm form-control" id="tiporelacion_id" name="tiporelacion_id" @if($show) disabled @endif>
                @foreach ($tipos as $tipo)
                    <option value="{{$tipo->id}}" @if($tipo->id == $persona->tiporelacion_id) selected @endif>{{$tipo->nombre}}</option>
                @endforeach
            </select>   
            <input @if($persona->tiporelacion_id != 7) style="display: none;" @endif type="text" name="tipo_custom" value="{{$persona->tipo_custom}}" class="form-control form-control-sm" id = "tipo_custom" @if($show) disabled @endif>
        </div>
    </div>
   
    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="contacto" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contacto<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="contacto" class="form-control form-control-sm" id="contacto" value="{{$persona->contacto}}" required @if($show) disabled @endif>   
        </div>
    </div>
</div>
<div class="row form-group justify-content-between" >
    <div class="mb-3 mt-3">
        <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
        <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3" @if($show) disabled @endif>{{$persona->observaciones}}</textarea>
    </div>
</div>


