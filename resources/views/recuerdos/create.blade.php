@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/recuerdo" id="recuerdoForm">
        {{csrf_field()}}
        @include('recuerdos.listaItems')
        <!--
        <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

        <div class="row form-group justify-content-between">
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="nombre" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" maxlength="50" required>
                </div>
            </div>
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Estado</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <select class="form-select form-select-sm" id="idEstado" name="estado_id">
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
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                </div>
            </div>
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <select class="form-select form-select-sm" id="idEtiqueta" name="etiqueta_id">
                        <option></option>
                        @foreach ($etiquetas as $etiqueta)
                        <option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="row col-sm-12 col-md-12 col-lg-12">
                <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1">Puntuación</label>

                <div class="col-md-auto">0</div>
                <div class="col-sm-5 col-md-5 col-lg-3">
                    <div class="range-wrap">
                        <div class="range-value" id="rangeV"></div>
                        <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion">
                    </div>
                </div>
                <div class="col mx-5">10</div>
            </div>

            <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>

        <div class="row justify-content-between">
            <div class="row">
                <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida<span class="asterisco">*</span></label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="idEtapa" name="etapa_id" required>
                        @foreach ($etapas as $etapa)
                        <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                        @endforeach

                    </select>
                </div>

                <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Emoción</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="idEmocion" name="emocion_id">
                        <option></option>
                        @foreach ($emociones as $emocion)
                        <option value="{{$emocion->id}}">{{$emocion->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" id="idCategoria" name="categoria_id">
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
                <button type="button" name="crearPersona" class="btn btn-success btn-sm btn-icon me-2" data-bs-toggle="modal" data-bs-target="#personasCreator"><i class="fa-solid fa-plus"></i></button>
                <button type="button" name="anadiendoPersona" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#personasExistentes">Añadir existente</button>
            </div>
        </div>
        <div>
            <table class="table table-bordered table-striped table-responsive">
                <caption>Listado de personas relacionadas</caption>
                <thead>
                    <tr class="bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Tipo de relación/parentesco</th>
                    </tr>
                </thead>
                <tbody id="divPersonas">

                </tbody>
            </table>
        </div>

        <div class="pt-4 pb-2">
            <h5 class="text-muted">Material</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row">
            <div class="col-12 justify-content-end d-flex p-2">
            </div>
        </div>

        <div class="dropzone dropzone-previews dropzone-custom" id="my-awesome-dropzone">
            <div class="dz-message text-muted" data-dz-message>
                <span>Click aquí o arrastrar y soltar</span>
            </div>
        </div>

        <div id="showMultimedia" class="row pb-2">
            
        </div>
        -->
        <div class="col-12 ">
            <button type="submit" value="Guardar" class="btn btn-outline-primary btn">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Atrás</button></a>
        </div>
    </form>
</div>

@include('recuerdos.models')

@endsection

@push('styles')
<link rel="stylesheet" href="/css/slider.css">
@endpush

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script>
        $(document).ready(function () {
            $('#tabla').DataTable({
                paging: false,
                info: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });
        });
    </script>
    <script>
        const
            range = document.getElementById('puntuacion'),
            rangeV = document.getElementById('rangeV'),
            setValue = () => {
                const
                    newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                    newPosition = 10 - (newValue * 0.2);
                rangeV.innerHTML = `<span>${range.value}</span>`;
                rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
            };
        document.addEventListener("DOMContentLoaded", setValue);
        range.addEventListener('input', setValue);
    </script>
@endpush