<div class="row justify-content-start mb-3">
    <input hidden id="idPaciente" name="paciente_id" value="{{$paciente->id}}" required>
    <div class=" d-flex col-lg-4 col-md-6 col-sm-12 mb-2 align-items-center">
        <label for="fecha" style="min-width: 70px" class="col-sm-12 col-md-4 col-lg-4 labelShow">Fecha: <span class="asterisco">*</span></label>
        <div class="col-sm-6 col-md-6 col-lg-7" style="min-width: 220px">
            <input max="4000-12-31T23:00:00.0" min="1800-01-01T01:00:00.00" type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha" required>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="titulo" class="form-label labelShow">Título: <span class="asterisco">*</span></label>
    <input type="text" maxlength="100" class="form-control form-control-sm" id="titulo" name="titulo" required>
</div>
<div class="mb-3">
    <label for="objetivo" class="form-label labelShow">Resumen: <span class="asterisco">*</span></label>
    <textarea class="form-control form-control-sm" id="resumen" name="resumen" rows="10" required>{{$completed_text}}</textarea>
</div>