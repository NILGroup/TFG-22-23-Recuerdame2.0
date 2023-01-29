<form id="formulario" method="post" action="/calendarioSesion">
    {{csrf_field()}}
    <input hidden id="idSesion" name="idSesion">
    @include('sesiones.listaItems')
    <div class="modal-footer">
        <input type="submit" formaction="/eliminarSesion" id="btnEliminarSesion" name="btnEliminar" value="Eliminar sesión" class="btn btn-danger btn-md d-none">
        <input type="submit" formaction="/modificarSesion" id="btnModificarSesion" name="btnModificar" value="Modificar sesión" class="btn btn-warning btn-md d-none">
        <input type="submit" id="btnGuardarSesion" name="btnAccion" value="Guardar" class="btn btn-primary btn-md">
    </div>
</form>