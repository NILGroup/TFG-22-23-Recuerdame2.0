<!-- <form id="formulario" method="post" action="/calendarioSesion">
    {{csrf_field()}}
    @include('sesiones.listaItems')
    <div class="modal-footer">
        <input type="submit" id="btnEliminarSesion" name="btnEliminar" value="Eliminar sesión" class="btn btn-outline-primary btn-md d-none confirm_delete_calendario">
        <input type="submit" formaction="/modificarSesion" id="btnModificarSesion" name="btnModificar" value="Modificar sesión" class="btn btn-primary btn-md d-none">
        <input type="submit" id="btnGuardarSesion" name="btnAccion" value="Guardar sesión" class="btn btn-primary btn-md guardar">
    </div>
</form> -->

<form class="dropzone p-0" id="formulario" method="post" action="/calendarioSesion">
            {{csrf_field()}}
            <div class="dropzone-inner">
                    @include('sesiones.listaItems')
                    <div class="dz-default dz-message dropzone-correct" id="dzp">
                        <div class="container dropzone-container">
                            <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                            <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                        </div>
                    </div>
                    <div class="dropzone-previews">


                    </div>
                    <div class="pt-4 pb-2">
                        <h5 class="text-muted">Material Existente</h5>
                    </div>
                    <div id="showMultimedia" class="row pb-2">
                    
                    </div>
            </div>
    
        <div>
            <div class="modal-footer">
                <input type="submit" id="btnEliminarSesion" name="btnEliminar" value="Eliminar sesión" class="btn btn-outline-primary btn-md d-none confirm_delete_calendario">
                <input type="submit" formaction="/modificarSesion" id="btnModificarSesion" name="btnModificar" value="Modificar sesión" class="btn btn-primary btn-md d-none">
                <input type="submit" id="btnGuardarSesion" name="btnAccion" value="Guardar sesión" class="btn btn-primary btn-md guardar">
             </div>
           
        </div>
    </form>