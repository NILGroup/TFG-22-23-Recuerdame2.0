<form id="formulario" method="post" action="/calendarioSesion">
    {{csrf_field()}}
    @include('sesiones.listaItems')
    <div class="modal-footer">
        <input type="submit" id="btnEliminarSesion" name="btnEliminar" value="Eliminar sesión" class="btn btn-outline-primary btn-md d-none confirm_delete_calendario">
        <input type="submit" formaction="/modificarSesion" id="btnModificarSesion" name="btnModificar" value="Modificar sesión" class="btn btn-primary btn-md d-none">
        <input type="submit" id="btnGuardarSesion" name="btnAccion" value="Guardar" class="btn btn-primary btn-md guardar">
    </div>
</form>