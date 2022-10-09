@extends('layouts.structure')

@section('content')


<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row">
    <input hidden id="idSesion" value="{{$sesion->id}}">
        <div class="row">
            <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha</label>
            <div class="col-sm-9 col-md-6 col-lg-2">
                <input disabled type="date" class="form-control form-control-sm" id="fecha" value="{{$sesion->fecha}}">
            </div>

            <label for="etapa" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Etapa</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select disabled class="form-select form-select-sm" name="etapa">
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
                <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-12">{{$sesion->user->nombre}} {{$sesion->user->nombre}}</label>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="objetivo" class="form-label col-form-label-sm">Objetivo</label>
        <textarea disabled class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3">{{$sesion->objetivo}}</textarea>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
        <textarea disabled class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3">{{$sesion->descripcion}}</textarea>
    </div>

    <div>
        <div class="mb-3">
            <label for="barreras" class="form-label col-form-label-sm">Barreras</label>
            <textarea disabled class="form-control form-control-sm" id="barreras" name="barreras" rows="3">{{$sesion->barreras}}</textarea>
        </div>

        <div class="mb-3">
            <label for="facilitadores" class="form-label col-form-label-sm">Facilitadores</label>
            <textarea disabled class="form-control form-control-sm" id="facilitadores" name="facilitadores" rows="3">{{$sesion->facilitadores}}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Recuerdos</h5>
            <hr class="lineaTitulo">
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
                    <?php $i=1 ?>
                    @foreach($sesion->recuerdos as $recuerdo)
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><a href="{{route('recuerdo.show',$recuerdo->id)}}">{{$recuerdo->nombre}}</a></td>
                            <td>{{date("d/m/Y", strtotime($recuerdo->fecha))}}</td>
                            <td>{{$recuerdo->etapa->nombre}}</td>
                            <td>{{$recuerdo->categoria->nombre}}</td>
                            <td>{{$recuerdo->estado->nombre}}</td>
                            <td>{{$recuerdo->etiqueta->nombre}}</td>
                            <td class="tableActions">
                                <a href="{{route('recuerdo.show',$recuerdo->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            </td>
                        </tr>
                    <?php $i++?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Material</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row pb-2">
        @foreach($sesion->multimedias as $multimedia)
            <div class="col-sm-4">
                <!-- TODO HACER QUE MUESTRE ARCHIVOS DE LA BBDD -->
                <a href="#" class="visualizarImagen"><img src="/img/avatar_hombre.png" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon"></a>
            </div>
        @endforeach
    </div>

    <div>
        <a href="/showByPaciente/{{$sesion->paciente->id}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
    </div>
</div>
@endsection
