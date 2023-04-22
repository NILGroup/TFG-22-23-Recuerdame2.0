<!-- MODALES -->
<div class="modal fade" id="recuerdosCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Opciones de generación de vídeos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>



                    <h2>Opciones de generación de vídeos </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                            <label class="form-check-label mt-3 negrita">Tipo de contenido <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="top" title="En este campo podemos elegir los elementos que queremos dentro del nuevo vídeo generado: solo imágenes, solo vídeos o ambos."></i></label>
    
                            <div class="form-check ">
                                <input type="hidden" name="imagenesCheck" id="imagenesCheck" value="1">
                                
                                <input type="checkbox" class="form-check-input" onclick="onCheck('imagenesCheck')" checked>
                                <label class=" col-form-label-sm " for="1">Imágenes</label><br>
                                
                                <input type="hidden" name="videosCheck" id="videosCheck" value="1">
                                
                                <input type="checkbox" class="form-check-input" onclick="onCheck('videosCheck')" checked>
                                <label class="form-label col-form-label-sm" for="1">Vídeos</label>
                            </div>
    
                            <label class="form-check-label mt-3 negrita">Extras <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="top" title="En este campo podemos activar la narración de un resumen de la historia de vida generado y narrado por inteligencia artifical."></i></label>
    
                            <div class="form-check form-switch">
                                <input type="hidden" name="narracionCheck" id="narracionCheck" value="1">
                                <input class="form-check-input" type="checkbox" id="narracionCheck" onclick="onCheck('narracionCheck')" checked>
                                <label class="form-check-label" for="narracionCheck">Narración por IA</label>
                            </div>




            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
                <button id="modal_recuerdo_guardar" type="button" class="btn btn-primary">Crear vídeo</button>
            </div>
        </div>
    </div>
</div>



