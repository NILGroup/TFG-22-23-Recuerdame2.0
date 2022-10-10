@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/recuerdo">

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" maxlength="50" required>
                    {{csrf_field()}}
                </div>
            </div>
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Estado</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <select class="form-select form-select-sm" id="idEstado" name="idEstado">
                        <option></option>
                        @foreach ($estados as $estado)
                        <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="fecha">
                </div>
            </div>
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <select class="form-select form-select-sm" id="idEtiqueta" name="idEtiqueta">
                        <option></option>
                        @foreach ($etiquetas as $etiqueta)
                        <option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row col-sm-12 col-md-12 col-lg-12">
                <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1">Puntuación</label>
                <div class="col-sm-5 col-md-5 col-lg-3">
                    <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion">
                </div>
                <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
            </div>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>

        <div class="row justify-content-between">
            <div class="row">
                <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida<span class="asterisco">*</span></label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="idEtapa" name="idEtapa">
                        @foreach ($etapas as $etapa)
                        <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                        @endforeach

                    </select>
                </div>

                <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Emoción</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="idEmocion" name="idEmocion">
                        <option></option>
                        @foreach ($emociones as $emocion)
                        <option value="{{$emocion->id}}">{{$emocion->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="idCategoria" name="idCategoria">
                        <option></option>
                        @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
                    <label for="localizacion" class="form-label col-form-label-sm">Localización</label>
                    <textarea maxlength="255" class="form-control form-control-sm" id="localizacion" name="localizacion" rows="3"></textarea>
         </div>
         <div class="pt-4 pb-2">
                    <h5 class="text-muted">Listado de personas relacionadas</h5>
                    <hr class="lineaTitulo">
                </div>
                <div class="row">
                    <div class="col-12 justify-content-end d-flex p-2">
                        <button type="submit" name="guardarRecuerdo"  class="btn btn-success btn-sm btn-icon me-2"><i class="fa-solid fa-plus"></i></button>
                        <button type="submit" name="guardarRecuerdo"  class="btn btn-success btn-sm me-2">Añadir existente</button>
                    </div>
                </div>

          <!-- A partir de la linea 199 del codigo de R1.0       -->
        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
        </div>
    </form>
</div>

@endsection