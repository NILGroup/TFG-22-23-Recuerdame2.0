@extends('layouts.structure')

@section('content')

<div class="container-fluid">

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar Historia de Vida</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/historias/generarLibro" method="GET">
        <div class="row p-2">
            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="fecha" class="form-label col-form-label-sm col-md-auto">Fecha de inicio</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="date" class="form-control form-control-sm" id="fechaInicio" name="fechaInicio" value="{{$fecha}}">
                </div>
            </div>

            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de fin</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="date" class="form-control form-control-sm" id="fechaFin" name="fechaFin" value="{{date("d/m/Y")}}">
                </div>
            </div>
        </div>

        <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

        <div class="row">
            <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select class="form-select form-select-sm" id="idEtapa" name="idEtapa">
                    <option></option>
                    @foreach ($etapas as $etapa)
                    <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="row">
            <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Categoría</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select class="form-select form-select-sm" id="idCategoria" name="idCategoria" >
                    <option ></option>
                    @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
            <div class="  col-sm-3 col-md-3 col-lg-2">
                <div class="selectBox" onclick="showCheckboxes()">
                    <select class="form-select form-select-sm" id="idEtiqueta" name="idEtiqueta">
                        <option id="seleccionado" selected></option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                    @foreach ($etiquetas as $etiqueta)
                    <label> <input  type="checkbox" onclick="onSelect('{{$etiqueta->nombre}}')" value={{$etiqueta->id}} name="seleccion[]">{{$etiqueta->nombre}}</label>
                    @endforeach
                </div>
            </div>

        </div>


        <div>
            <button type="submit" name="generarLibro" value="Generar libro" class="btn btn-outline-primary ">Generar libro</button>
            <button type="submit" name="generarPdf" formaction="/generarPDFHistoria" value="Generar PDF" class="btn btn-outline-primary ">Generar PDF</button>
        </div>
    </form>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#idEtiqueta').multiselect();
    });
</script>

@endsection

@push('scripts')
@include('layouts.scripts')
@endpush