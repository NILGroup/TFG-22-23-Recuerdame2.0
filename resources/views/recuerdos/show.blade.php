@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos del recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    @include('recuerdos.listaItems')
    <!--
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
                        @if(is_null($estados))
                        <option value="{{$estados}}" selected="selected">{{$estados}}</option>
                        @endif
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
                        @if(is_null($etiquetas))
                            <option value="{{$etiquetas->id}}" selected="selected">{{$etiquetas->nombre}}</option>
                        @endif
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
                        <option value="{{$etapas[0]->id}}" selected="selected">{{$etapas[0]->nombre}}</option>
                    </select>
                </div>

                <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Emoción</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select disabled class="form-select form-select-sm" name="emocion">
                        @if(is_null($emociones))
                            <option value="{{$emociones->id}}" selected="selected">{{$emociones->nombre}}</option>
                        @endif
                    </select>
                </div>

                <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select disabled class="form-select form-select-sm" name="categoria">
                        @if(is_null($categorias))
                            <option value="{{$categorias->id}}" selected="selected">{{$categorias->nombre}}</option>
                        @endif
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
        <table class="table table-bordered table-striped table-responsive">
                        <caption>Listado de personas relacionadas</caption>
                        <thead>
                            <tr class="bg-primary">
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

        
    </div>
    -->
    <div class="col-12">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn">Atrás</button></a>
    </div>
</div>
@endsection

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
@endpush