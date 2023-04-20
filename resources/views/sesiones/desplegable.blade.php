<div class="accordion mb-2">
    <div class="accordion-item accordion-header shadow-sm" id="datos1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#datos_sesion" aria-expanded="true" aria-controls="datos_sesion">
            <div class="w-100">
                <h5 class="text-muted text-start">Datos de la sesión</h5>
            </div>
        </button>
        <div id="datos_sesion" class="tabla accordion-collapse collapse show mx-2" aria-labelledby="datos1">
            <div class="row justify-content-start mb-3">
                <input hidden id="idUser" name="user_id" value="{{$user->id}}" required>
                <input hidden id="idPaciente" name="paciente_id" value="{{$paciente->id}}" required>
                <!--
                <div class=" d-flex col-lg-4 col-md-6 col-sm-12 mb-2 align-items-center">
                    <label for="fecha" style="min-width: 70px" class="col-sm-12 col-md-4 col-lg-4 labelShow">Fecha: <span class="asterisco">*</span></label>
                    <div class="col-sm-6 col-md-6 col-lg-7" style="min-width: 220px">
                        <input max="4000-12-31T23:00:00.0" min="1800-01-01T01:00:00.00" type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}" disabled>
                    </div>
                </div>
                -->
                <div class=" d-flex col-lg-4 col-md-6 col-sm-12 mb-2 align-items-center" id="divEtapa">
                    <label for="etapa" style="min-width: 70px" class="col-sm-12 col-md-4 col-lg-4 labelShow">Etapa: <span class="asterisco">*</span></label>
                    <div class="col-sm-6 col-md-6 col-lg-7" style="min-width: 220px">
                        <select class="form-select " name="etapa_id" disabled>
                            @foreach($etapas as $etapa)
                            <option value="{{$etapa->id}}" @if($sesion->etapa && $sesion->etapa->id == $etapa->id)
                                selected="selected"
                                @endif
                                >{{$etapa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex col-lg-4 col-md-12 col-sm-12 align-items-center">
                    <label for="terapeuta" class="form-label labelShow">Terapeuta:</label>
                    <label for="terapeuta" class="form-label form-label-sm">{{$user->nombre}} {{$user->apellidos}}</label>
                </div>
            </div>



            <div class="mb-3">
                <label for="titulo" class="form-label labelShow">Título:<span class="asterisco">*</span></label>
                <input type="text" maxlength="100" class="form-control form-control-sm" id="titulo" name="titulo" value="{{$sesion->titulo}}" disabled>
            </div>

            <div class="mb-3">
                <label for="objetivo" class="form-label labelShow">Objetivo:<span class="asterisco">*</span></label>
                <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3" disabled>{{$sesion->objetivo}}</textarea>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label labelShow">Descripción:</label>
                <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" disabled>{{$sesion->descripcion}}</textarea>
            </div>

            <div class="mb-3">
                <label for="acciones" class="form-label labelShow">Secuencia de acciones:</label>
                <textarea class="form-control form-control-sm" id="acciones" name="acciones" rows="3" disabled>{{$sesion->acciones}}</textarea>
            </div>
        </div>
    </div>
</div>