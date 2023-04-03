<!-- Modal trigger button -->
<button type="button" style="display: none" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDescripcion">
  Launch
</button>


<div class="modal fade" id="modalDescripcion" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Añadir descripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">

                <div id="imagen-modal" class="text-center">
                    
                </div>
                <p class="text-center" id="imagen-nombre"></p>
                <div class="row form-group m-3">
                    <label for="descripcion-imagen" class="form-label negrita">Descripción</label>
                    <textarea placeholder="Descripción del archivo" class="form-control" name="descripcion-imagen" id="descripcion-imagen" cols="30" rows="10"></textarea>
                </div>
                     
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


