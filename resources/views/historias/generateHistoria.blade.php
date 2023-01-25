@extends('layouts.structure')

@section('content')

<div class="container-fluid">

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar Historia de Vida</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/historias/generarLibro" method="GET">
        <div class="row justify-content-start">
            <div class="row col-sm-6 col-md-6 col-lg-5">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-5">Fecha de inicio</label>
                <div class="col-sm-9 col-md-6 col-lg-5">
                    <input type="date" class="form-control form-control-sm" id="fechaInicio" name="fechaInicio" value="{{$fecha}}">
                </div>
            </div>

            <div class="row col-sm-6 col-md-6 col-lg-7">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de fin</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="date" class="form-control form-control-sm" id="fechaFin" name="fechaFin" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                </div>
            </div>
        </div>

        <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

        <div class="row">
            <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida</label>
            <div class="col-sm-9 col-md-6 col-lg-2">
                <div class="selectBox" onclick="showCheckboxes('checkboxes')">
                    <select class="form-select form-select-sm" id="idEtapa" name="idEtapa">
                        <option id="seleccionadoEtapa" selected></option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxes" class="checkboxes">
                    @foreach ($etapas as $etapa)
                    <label> <input type="checkbox" onclick="onSelect('{{$etapa->nombre}}', 'seleccionadoEtapa')" value={{$etapa->id}} name="seleccionEtapa[]">{{$etapa->nombre}}</label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Categoría</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <div class="selectBox" onclick="showCheckboxes('checkboxesCat')">
                    <select class="form-select form-select-sm" id="idCategoria" name="idCategoria">
                        <option id="seleccionadoCat" selected></option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxesCat" class="checkboxes">
                    @foreach ($categorias as $categoria)
                    <label> <input type="checkbox" onclick="onSelect('{{$categoria->nombre}}', 'seleccionadoCat')" value={{$categoria->id}} name="seleccionCat[]">{{$categoria->nombre}}</label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
            <div class="  col-sm-3 col-md-3 col-lg-2">
                <div class="selectBox" onclick="showCheckboxes('checkboxesEtiqueta')">
                    <select class="form-select form-select-sm" id="idEtiqueta" name="idEtiqueta">
                        <option id="seleccionadoEtiqueta" selected></option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxesEtiqueta" class="checkboxes">
                    @foreach ($etiquetas as $etiqueta)
                    <label> <input type="checkbox" onclick="onSelect('{{$etiqueta->nombre}}','seleccionadoEtiqueta')" value={{$etiqueta->id}} name="seleccionEtiq[]">{{$etiqueta->nombre}}</label>
                    @endforeach
                </div>
            </div>

            <br>
            <br>
            <label class=" col-form-label-sm "><strong>Tipo de recuerdos</strong></label>
            
            <div class="form-check">
                <input type="hidden" name="apto" id="apto" value="1">
                <input type="checkbox" onclick="onCheck('apto')" checked>
                <label class=" col-form-label-sm " for="1">Aptos</label><br>
                <input type="hidden" name="noApto" id="noApto" value="0">
                <input type="checkbox" onclick="onCheck('noApto')">
                <label class="form-label col-form-label-sm" for="0">No aptos</label>
            </div>

        </div>


        <div>
            <button type="submit" name="generarLibro" value="Generar libro" class="btn btn-outline-primary ">Generar libro</button>
            <button type="submit" name="generarPdf" formaction="/generarPDFHistoria" value="Generar PDF" class="btn btn-outline-primary ">Generar PDF</button>
        </div>

    </form>

</div>

<script type="text/javascript">
    //multiple seleccion con checkbox en generar Historia de vida
    var expanded = false;
    var expandedEtiqueta = false;
    var expandedEtapa = false;
    var expandedCat = false;

    function expandir(expanded, checkboxes) {
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
        return expanded;
    }

    function showCheckboxes(ide) {

        if (ide == 'checkboxesEtiqueta') {
            expandedEtiqueta = expandir(expandedEtiqueta, document.getElementById("checkboxesEtiqueta"));

        } else if (ide == 'checkboxesCat') {
            expandedCat = expandir(expandedCat, document.getElementById("checkboxesCat"));
        } else {
            expandedEtapa = expandir(expandedEtapa, document.getElementById("checkboxes"));
        }

    }

    let array = [];
    let arrayEt = [];
    let arrayCat = [];
    let arrayEtapa = [];

    function anadirInfo(array, string) {
        const index = array.indexOf(string);
        if (index > -1) { // only splice array when item is found
            array.splice(index, 1); // 2nd parameter means remove one item only
        } else array.push(string);
        return array;
    }

    function onSelect(string, elementoSeleccionado) {
        var select = document.getElementById(elementoSeleccionado);

        if (select.getAttribute("id") == 'seleccionadoEtiqueta') {
            select.textContent = anadirInfo(arrayEt, string);

        } else if (select.getAttribute("id") == 'seleccionadoCat') {
            select.textContent = anadirInfo(arrayCat, string);
        } else {
            select.textContent = anadirInfo(arrayEtapa, string);
        }
    }

    function onCheck(elementoSeleccionado) {
        var select = document.getElementById(elementoSeleccionado);

        if (select.getAttribute("value") == 0) {
            select.setAttribute("value", 1);

        } else select.setAttribute("value", 0);
    }

</script>

@endsection

@push('scripts')
@include('layouts.scripts')
@endpush