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

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="title" name="title" required>
            <label for="title" class="form-label">Título</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="start" name="start" required>
            <label for="start" class="form-label">Fecha</label>
        </div>
        <div class="form-floating mb-3">
            <input type="color" class="form-control" id="color" name="color" value="#20809d" required>
            <label for="color" class="form-label">Color</label>
        </div>
        <div class="form-floating mb-3">
            <textarea maxlength="255" class="form-control form-control-sm" id="obs" name="obs" rows="3" required></textarea>
            <label for="obs" class="form-label">Pautas</label>
        </div>
        <div class="form-floating mb-3" id="div-fin">
            <textarea maxlength="255" class="form-control form-control-sm" id="finished" name="finished" rows="3"></textarea>
            <label for="finished" class="form-label">Anotaciones sobre el desarrollo de la actividad</label>
        </div>
        <div class="modal-footer">
            <input type="submit" formaction="/eliminarActividad" id="btnEliminar" name="btnEliminar" value="Eliminar actividad" class="btn btn-outline-secondary btn-md d-none">
            <input type="submit" formaction="/modificarActividad" id="btnModificar" name="btnModificar" value="Modificar actividad" class="btn btn-primary btn-md d-none">
            <input type="submit" id="btnGuardar" name="btnAccion" value="Guardar" class="btn btn-primary btn-md">
        </div>
    </form>
   <!-- <form method="post" id="formularioEliminar" action="/eliminarActividad" style="display:inline!important;">
        {{csrf_field()}}
        <input type="hidden" class="form-control" id="idEliminar" name="idEliminar">
        <button type="submit" class="btn btn-danger btn-md confirm_delete" id="btnEliminar" name="btnEliminar">Eliminar actividad</button>
    </form>-->
</div>