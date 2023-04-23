<!-- MODALES -->
<div class="modal fade" id="videosCreator" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Opciones de generación de vídeos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            
            <form class="modal-body" id="videosCreatorForm">
                <div class="container">
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
                                    <button formaction="/generarVideoHistoria" id="modal_video_guardar" type="submit" class="btn btn-primary">Crear vídeo</button>
                                </div>
                </div>


                {{-- Campos inputs hidden --}}
                        <input type="hidden" class="form-control form-control-sm" id="fechaInicioModal" name="fechaInicio" value="{{$fecha}}">
                        <input type="hidden" class="form-control form-control-sm" id="fechaFinModal" name="fechaFin" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                        <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">
        

                            @foreach ($etapas as $etapa)
                            <input  type="hidden" class="form-check-input" value={{$etapa->id}} name="seleccionEtapaModal[]">
                            @endforeach



                            @foreach ($categorias as $categoria)
                            <input type="hidden"  class="form-check-input" value={{$categoria->id}} name="seleccionCatModal[]">
                            @endforeach


                    @if (Auth::user()->rol_id == 1)

                            @foreach ($etiquetas as $etiqueta)
                            <input type="hidden"class="form-check-input" value={{$etiqueta->id}} name="seleccionEtiqModal[]">
                            @endforeach

                    @endif
                </div>
                    <input type="hidden" name="apto" id="aptoModal" value="1">
                    <input type="hidden" name="noApto" id="noAptoModal" value="0">
            </form>
        </div>
    </div>
</div>



