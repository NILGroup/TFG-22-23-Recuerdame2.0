<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la actividad</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" id="formulario" method="post" action="/calendario">
        {{csrf_field()}}

        <div class="dropzone-inner">

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

        
            <div class="pt-4 pb-2">
                <h5 class="text-muted">Material</h5>
            </div>
            <div class="d-flex justify-content-end">
                <button id="multiActividadBtn" type="button" class="btn btn-success showmodal" data-show-modal="multiActividad">Gestionar multimedia</button>
            </div>
            <div class="dz-default dz-message dropzone-correct" id="dzp">
                <div class="container dropzone-container">
                    <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                    <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                </div>
            </div>
            <div class="previews-actividad">


            </div>

            <div class="pt-4 pb-2">
                <h5 class="text-muted">Material Existente</h5>
            </div>

            
            <div id="showMultimediaActividad" class="row pb-2">

            </div>
        </div>

        <div class="modal-footer">
            <input type="submit" id="btnEliminar" name="btnEliminar" value="Eliminar actividad" class="btn btn-outline-primary btn-md d-none confirm_delete_calendario">
            <input type="submit" id="btnModificar" name="btnModificar" value="Guardar cambios" class="btn btn-primary btn-md d-none">
            <input type="submit" id="btnFinalizar" name="btnFinalizar" value="Finalizar actividad" class="btn btn-primary btn-md d-none finalizar">
            <input type="submit" id="btnGuardar" name="btnAccion" value="Guardar actividad" class="btn btn-primary btn-md guardar">
        </div>









        <!-- ========== Empieza el modal ========== -->

        <div class="modal fade" id="multiActividad" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Gestionar Multimedia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <table id="tablaMultiActividad" class="table w-100 table-bordered table-striped table-responsive datatable">
                            <thead>
                                <tr>
                                    <th scope="col" style="display: none;">Id</th>
                                    <th scope="col text-center">Nombre</th>
                                    <th class="fit10" scope="col">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody class="shadow-sm">

                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="confirmMultiActividad" type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== End Section ========== -->

    </form>
    <!-- <form method="post" id="formularioEliminar" action="/eliminarActividad" style="display:inline!important;">
        {{csrf_field()}}
        <input type="hidden" class="form-control" id="idEliminar" name="idEliminar">
        <button type="submit" class="btn btn-danger btn-md confirm_delete" id="btnEliminar" name="btnEliminar">Eliminar actividad</button>
    </form>-->
</div>