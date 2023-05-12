<div class="modal fade" id="descripcionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Multimedia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">

            <div class="row">
              
                <input type="file" name="file[]" id="modal-file" class="form-control">
                <div class="form-group mt-4">
                    <label class="form-label">Descripción: </label>
                    <textarea class="form-control" name="descripciones[]" id="modal-descripcion" cols="30" rows="2">

                    </textarea>
                </div>
     
            </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="modal-imagenes-guardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>