<!-- MODALES -->
<div class="modal fade" id="personasCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Crear: Personas relacionadas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="personasCreatorForm">

                <input type="hidden" name="paciente_id" id="paciente_id" value="{{$paciente->id}}">



                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" required>

                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" required>
                        </div>
                    </div>
                </div>



                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="text" name="telefono" class="form-control form-control-sm" id="telefono" required>

                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" required>
                        </div>
                    </div>

                </div>

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="email" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Email<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="email" name="email" class="form-control form-control-sm" id="email" required>

                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="localidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Localidad<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" name="localidad" class="form-control form-control-sm" id="localidad" required @if($show) disabled @endif>
                        </div>
                    </div>
                </div>

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo relación</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <select onchange="especifique()" class="form-select form-select-sm" id="tiporelacion_id" name="tiporelacion_id" required>
                                @foreach ($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                            <input style="display: none;" placeholder="Especifique" type="text" name="tipo_custom" class="form-control form-control-sm" id = "tipo_custom" @if($show) disabled @endif>
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="contacto" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contacto<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" name="contacto" class="form-control form-control-sm" id="contacto" required @if($show) disabled @endif>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
                    <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3" @if($show) disabled @endif></textarea>
                </div>

            </div> <!-- Modal body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="cerrar();">Guardar</button>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="personasExistentes" tabindex="-1" aria-labelledby="personasExistentesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Personas relacionadas existentes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered recuerdameTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Tipo de Relacion</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tablaPersonasExistentes">
                        <?php $i = 1 ?>
                        @foreach ($personas as $persona)
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td>{{$persona->nombre}}</td>
                            <td>{{$persona->apellidos}}</td>
                            <td>{{$persona->tiporelacion}}</td>
                            <td id="personasSeleccionadas" class="tableActions">
                                <input class="form-check-input" type="checkbox" value="{{$persona->id}}" name="checkPersonaExistente[]" id="checkPersonaExistente" @if($recuerdo->personas_relacionadas->contains($persona)) checked @endif>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="return agregarPersonas(checkPersonaExistente);">Guardar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="/js/persona.js"></script>
@endpush