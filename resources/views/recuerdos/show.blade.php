@extends('layouts.structure')

@section('content')
<div class="pt-4 pb-2">
    <h5 class="text-muted">Datos del recuerdo</h5>
    <hr class="lineaTitulo">
</div>

<div>
    <input hidden id="idRecuerdo" value="$recuerdo->id">
    <div class="row form-group justify-content-between">
        <div class="row col-sm-6 col-md-6 col-lg-6">
            <label for="nombre" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Nombre</label>
            <div class="col-sm-9 col-md-10 col-lg-5">
                <input type="text" disabled class="form-control form-control-sm" id="nombre" value="{{$recuerdo->nombre}}">
            </div>
        </div>

        <div class="row col-sm-6 col-md-6 col-lg-6">
            <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Estado</label>
            <div class="col-sm-9 col-md-6 col-lg-4">
                <select disabled class="form-select form-select-sm" name="estado">
                    <option value="{{$estado->id}}" selected="selected">{{$estado->nombre}}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="row col-sm-6 col-md-6 col-lg-6">
            <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha</label>
            <div class="col-sm-9 col-md-6 col-lg-4">
                <input disabled type="date" class="form-control form-control-sm" id="fecha" value="{{$recuerdo->fecha}}">
            </div>
        </div>
        <div class="row col-sm-6 col-md-6 col-lg-6">
            <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
            <div class="col-sm-9 col-md-6 col-lg-4">
                <select disabled class="form-select form-select-sm" name="etiqueta">
                        <option value="{{$etiqueta->id}}" selected="selected">{{$etiqueta->nombre}}</option>
                    </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="row col-sm-12 col-md-12 col-lg-12">
            <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1">Puntuación</label>
            <div class="col-sm-5 col-md-5 col-lg-3">
                <input disabled type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="{{$recuerdo->puntuacion}}">
            </div>
            <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2">{{$recuerdo->puntuacion}}</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
        <textarea disabled class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3">{{$recuerdo->descripcion}}</textarea>
    </div>

    <div class="row justify-content-between">
        <div class="row">
            <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select disabled class="form-select form-select-sm" name="etapa">
                        <option value="{{$etapa->id}}" selected="selected">{{$etapa->nombre}}</option>
                </select>
            </div>

            <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Emoción</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select disabled class="form-select form-select-sm" name="emocion">
                        <option value="{{$emocion->id}}" selected="selected">{{$emocion->nombre}}</option>
                </select>
            </div>

            <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select disabled class="form-select form-select-sm" name="categoria">
                        <option value="{{$categoria->id}}" selected="selected">{{$categoria->nombre}}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="localizacion" class="form-label col-form-label-sm">Localización</label>
        <textarea disabled class="form-control form-control-sm" id="localizacion" rows="3">{{$recuerdo->localizacion}}</textarea>
    </div>

</div>

<div class="pt-4 pb-2">
    <h5 class="text-muted">Listado de personas relacionadas</h5>
    <hr class="lineaTitulo">
</div>
<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Tipo de relación/parentesco</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach ($recuerdo->personas_relacionadas as $persona)
            <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><a href="VerDatosPersonaRelacionada">{{$persona->nombre}}</a></td>
                <td>{{$persona->apellidos}}</td>
                <td>{{$persona->tiporelacion->nombre}}</td>
                <td class="tableActions">
                    <a href="VerDatosPersonaRelacionada"></i></a>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach


        </tbody>
    </table>
</div>

<div class="pt-4 pb-2">
    <h5 class="text-muted">Material</h5>
    <hr class="lineaTitulo">
</div>

<div id="showMultimedia" class="row pb-2">
    @foreach ($recuerdo->multimedias as $media)
    <div class="col-sm-4 p-2">
        <div class="img-wrap">
            <a href="#" class="visualizarImagen"><img src="/img/{{$media->fichero}}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon"></a>
        </div>
    </div>
    @endforeach
</div>

<div class="col-12">
    <button type="submit" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
    <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
</div>
</div>
  

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush