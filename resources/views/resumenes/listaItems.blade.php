<input type="hidden" id="idPaciente" name="paciente_id" value="{{$paciente->id}}" required>
<input type="hidden" id="idResumen" name="idResumen" value=1>
<div class="row justify-content-start mb-3">
    <div class=" d-flex col-lg-4 col-md-6 col-sm-12 mb-2 align-items-center">
        <label for="fecha" style="min-width: 70px" class="col-sm-12 col-md-4 col-lg-4 labelShow">Fecha: <span class="asterisco">*</span></label>
        <div class="col-sm-6 col-md-6 col-lg-7" style="min-width: 220px">
            @if ($resumen->fecha != null)
            <input max="4000-12-31" min="1800-01-01" type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$resumen->fecha}}">
            @else
            <input max="4000-12-31" min="1800-01-01" type="date" class="form-control form-control-sm" id="fecha" name="fecha">
            @endif
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="titulo" class="form-label labelShow">Título: <span class="asterisco">*</span></label>
    <input type="text" maxlength="100" class="form-control form-control-sm" id="titulo" name="titulo" value="{{$resumen->titulo}}" required>
</div>
<div class="mb-3">
    <label for="objetivo" class="form-label labelShow">Resumen: <span class="asterisco">*</span></label>
    <textarea class="form-control form-control-sm" id="resumen" name="resumen" rows="10" required>{{$resumen->resumen}}</textarea>
</div>