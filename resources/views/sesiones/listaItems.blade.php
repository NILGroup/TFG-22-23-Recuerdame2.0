<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row">
        <input hidden id="idUser" name="user_id" value="{{$user->id}}" required @if($show) disabled @endif>
        <input hidden id="idPaciente" name="paciente_id" value="{{$paciente->id}}" required @if($show) disabled @endif>
        <div class="row">
            <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
            <div class="col-sm-9 col-md-6 col-lg-2">
                <input type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}" required @if($show) disabled @endif>
            </div>

            <label for="etapa" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Etapa<span class="asterisco">*</span></label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select class="form-select form-select-sm" name="etapa_id"  required @if($show) disabled @endif>
                    @foreach($etapas as $etapa)
                    <option value="{{$etapa->id}}" @if($sesion->etapa && $sesion->etapa->id == $etapa->id)
                        selected="selected"
                        @endif
                        >{{$etapa->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <label for="terapeuta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Terapeuta:</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-12">{{$user->nombre}} {{$user->apellidos}}</label>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="objetivo" class="form-label col-form-label-sm">Objetivo<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3" required @if($show) disabled @endif>{{$sesion->objetivo}}</textarea>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
        <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" @if($show) disabled @endif>{{$sesion->descripcion}}</textarea>
    </div>

    <div class="row">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Recuerdos</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="col-12 justify-content-end d-flex p-2">
            @if(!$show)
                <button type="button" name="crearRecuerdo" class="btn btn-success btn-sm btn-icon me-2" data-bs-toggle="modal" data-bs-target="#recuerdosCreator"><i class="fa-solid fa-plus"></i></button>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#recuerdosExistentes">Añadir existente</button>
            @endif
        </div>

        <div>
            <table id="tabla" class="table table-bordered table-striped table-responsive">
                <caption>Listado de recuerdos</caption>
                <thead>
                    <tr class="bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Etapa</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Etiqueta</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody id="divRecuerdos">
                    <?php $i = 1; ?>
                    @foreach ($sesion->recuerdos as $recuerdo)
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                            <td>{{$recuerdo->nombre}}</td>
                            <td>{{date("d/m/Y", strtotime($recuerdo->fecha))}}</td>
                            <td>{{$recuerdo->etapa->nombre}}</td>
                            <td>{{$recuerdo->categoria->nombre}}</td>
                            <td>{{$recuerdo->estado->nombre}}</td>
                            <td>{{$recuerdo->etiqueta->nombre}}</td>
                            <td class="tableActions">
                                <a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                <a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                                <form method="post" action="{{route('recuerdo.destroy',$recuerdo->id)}}" onclick="confirmar(event)" style="display:inline!important;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                                </form>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Material</h5>
        <hr class="lineaTitulo">
    </div>
    
    @if(!$show)
    <div class="row">
        <div class="col-12 justify-content-end d-flex p-2">
            <!-- TODO REDIRIGIR A SELECCION DE MULTIMEDIA -->
            <a href="#" class="btn btn-success btn-sm">Añadir existente</button></a>
        </div>
    </div>

    <div class="dropzone dropzone-previews dropzone-custom" id="my-awesome-dropzone">
        <div class="dz-message text-muted" data-dz-message>
            <span>Click aquí o arrastrar y soltar</span>
        </div>
    </div>
    @endif
    <div id="showMultimedia" class="row pb-2">
        @foreach ($sesion->multimedias as $multimedia)
        <div class="col-sm-4 p-2">
            <div class="img-wrap">
                <a href="#" class="clear"><i class="fa-solid fa-circle-xmark text-danger fa-lg"></i></a>
                <a href="#" class="visualizarImagen"><img src="/img/avatar_hombre.png" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon"></a>
            </div>
        </div>
        @endforeach
    </div>
</div>