<form id="formulario" method="post" action="/calendarioSesion">
    {{csrf_field()}}
    @include('sesiones.listaItems')
    <div class="modal-footer">
        <input type="submit" formaction="/eliminarSesion" id="btnEliminar" name="btnEliminar" value="Eliminar sesión" class="btn btn-danger btn-md d-none">
        <input type="submit" formaction="/modificarSesion" id="btnModificar" name="btnModificar" value="Modificar sesión" class="btn btn-warning btn-md d-none">
        <input type="submit" id="btnGuardar" name="btnAccion" value="Guardar" class="btn btn-primary btn-md">
    </div>
</form>