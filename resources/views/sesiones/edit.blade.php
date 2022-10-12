@extends('layouts.structure')

@section('content')


<form action="/sesion/{{$sesion->id}}" method="POST">
    {{csrf_field()}}
    <div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Datos de la sesión</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row">
            <input hidden id="idSesion" name="id" value="{{$sesion->id}}">
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha</label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}">
                </div>

                <label for="etapa" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Etapa</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" name="etapa">
                        @foreach($etapas as $etapa)
                            <option value="{{$etapa->id}}" 
                                @if($sesion->etapa->id == $etapa->id) 
                                    selected="selected" 
                                @endif
                            >{{$etapa->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <label for="terapeuta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Terapeuta:</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-12">{{$sesion->user->nombre}} {{$sesion->user->apellidos}}</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="objetivo" class="form-label col-form-label-sm">Objetivo</label>
            <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3">{{$sesion->objetivo}}</textarea>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3">{{$sesion->descripcion}}</textarea>
        </div>

        <div>
            <div class="mb-3">
                <label for="barreras" class="form-label col-form-label-sm">Barreras</label>
                <textarea class="form-control form-control-sm" id="barreras" name="barreras" rows="3">{{$sesion->barreras}}</textarea>
            </div>

            <div class="mb-3">
                <label for="facilitadores" class="form-label col-form-label-sm">Facilitadores</label>
                <textarea class="form-control form-control-sm" id="facilitadores" name="facilitadores" rows="3">{{$sesion->facilitadores}}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="pt-4 pb-2">
                <h5 class="text-muted">Recuerdos</h5>
                <hr class="lineaTitulo">
            </div>

            <div class="row">
                <div class="col-12 justify-content-end d-flex p-2">
                    <div class="col-12 justify-content-end d-flex p-2">
                        <!-- Nuevo-->
                        <button type="submit" formaction="/updateAndRecuerdoNuevo" name="guardarSesion" class="btn btn-success btn-sm btn-icon me-2"><i class="fa-solid fa-plus"></i></button>
                        <!-- Existente -->
                        <!-- TODO REDIRIGIR A LA PÁGINA DE CREACION Y NO A LA LISTA DE RECUERDOS -->
                        <button type="submit" formaction="/updateAndSeleccionarRecuerdos" name="guardarSesion" class="btn btn-success btn-sm me-2">Añadir existente</button>
                    </div>
                </div>
            </div>

            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
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

                    <tbody>
                        <?php $i=1; ?>
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
                                    <a href="{{route('recuerdo.show',$recuerdo->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                </td>
                                <td class="tableActions">
                                    <a href="{{route('recuerdo.show',$recuerdo->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                    <a href="{{route('recuerdo.edit',$recuerdo->id)}}"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                                    <a href="{{route('recuerdo.destroy',$recuerdo->id)}}"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></a>
                                </td>
                            </tr>
                        <?php $i++;?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 justify-content-end d-flex p-2">
                <!-- TODO REDIRIGIR A SELECCION DE MULTIMEDIA -->
                <a href="#" class="btn btn-success btn-sm">Añadir existente</button></a>
            </div>
        </div>

        <div class="dropzone dropzone-previews dropzone-custom" id="mydropzone">
            <div class="dz-message text-muted" data-dz-message>
                <span>Click aquí o arrastrar y soltar</span>
            </div>
        </div>

        <div id="showMultimedia" class="row pb-2">
            @foreach ($recuerdo->multimedias as $multimedia)
                <div class="col-sm-4 p-2">
                    <div class="img-wrap">
                        <a href="{{route('multimedias.destroy',$multimedia->id)}}"><i class="fa-solid fa-circle-xmark text-danger fa-lg"></i></a>
                        <a href="#" class="visualizarImagen"><img src="/img/avatar_hombre.png" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon"></a>
                    </div>
                </div>
            @endforeach
        </div>

        <div>
            <button type="submit" name="guardarSesion" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
        </div>
    </div>
</form>
@endsection