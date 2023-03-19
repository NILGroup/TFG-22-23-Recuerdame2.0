<link rel="stylesheet" href="/css/calendario.css">

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la actividad</h5>
        <hr class="lineaTitulo">
    </div>
    <form id="formulario" method="post" action="/calendario">
        {{csrf_field()}}
        <input type="hidden" class="form-control" id="idPaciente" name="idPaciente" value="{{$paciente->id}}">
        <input type="hidden" class="form-control" id="id" name="id">

        <div class="row mb-3">
            <div class=" d-flex col-lg-4 col-md-7 col-sm-12 mb-2 align-items-center">
                <label for="start" class="form-label labelShow">Fecha:<span class="asterisco">*</span></label>
                <input type="date" class="form-control form-control-sm" id="start" name="start" required>
            </div>

            <div class=" d-flex col-lg-8 col-md-5 col-sm-12 mb-2 align-items-center" id="color">
                <label for="color" class="form-label labelShow">Color:</label>
                <input type="color" class="form-control form-control-sm" name="color" value="#20809d" required>
            </div>

        </div>

        <div class="mb-3">
            <label for="title" class="form-label labelShow">Título:<span class="asterisco">*</span></label>
            <input type="text" maxlength="100" class="form-control form-control-sm" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="obs" class="form-label labelShow">Pautas:<span class="asterisco">*</span></label>
            <textarea maxlength="255" class="form-control form-control-sm" id="obs" name="obs" rows="3" required></textarea>
        </div>
        <div class="mb-3" id="div-fin">
            <label for="finished" class="form-label labelShow">Anotaciones sobre el desarrollo de la actividad: <span class="asterisco" id="asteriscoFinalizar">*</span></label>
            <textarea maxlength="255" class="form-control form-control-sm" id="finished" name="finished" rows="3"></textarea>
            
        </div>
        <div class="modal-footer">
            <input type="submit" formaction="/eliminarActividad" id="btnEliminar" name="btnEliminar" value="Eliminar actividad" class="btn btn-outline-primary btn-md d-none confirm_delete_calendario">
            <input type="submit" formaction="/modificarActividad" id="btnModificar" name="btnModificar" value="Modificar actividad" class="btn btn-primary btn-md d-none">
            <input type="submit" formaction="/modificarActividad" id="btnFinalizar" name="btnFinalizar" value="Finalizar actividad" class="btn btn-primary btn-md d-none finalizar">
            <input type="submit" id="btnGuardar" name="btnAccion" value="Guardar actividad" class="btn btn-primary btn-md guardar">
        </div>
    </form>
    <!-- <form method="post" id="formularioEliminar" action="/eliminarActividad" style="display:inline!important;">
        {{csrf_field()}}
        <input type="hidden" class="form-control" id="idEliminar" name="idEliminar">
        <button type="submit" class="btn btn-danger btn-md confirm_delete" id="btnEliminar" name="btnEliminar">Eliminar actividad</button>
    </form>-->
</div>