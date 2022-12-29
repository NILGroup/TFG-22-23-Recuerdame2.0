<form id="formulario" method="post" action="/calendario">
    @include('sesiones.listaItems')
    <div class="modal-footer">
        <input type="submit" formaction="/eliminarActividad" id="btnEliminar" name="btnEliminar" value="Eliminar actividad" class="btn btn-danger btn-md d-none">
        <input type="submit" formaction="/modificarActividad" id="btnModificar" name="btnModificar" value="Modificar actividad" class="btn btn-warning btn-md d-none">
        <input type="submit" id="btnGuardar" name="btnAccion" value="Registrar" class="btn btn-primary btn-md">
    </div>
</form>