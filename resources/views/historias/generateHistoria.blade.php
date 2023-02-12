@extends('layouts.structure')

@section('content')

<div class="container-fluid">

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Generar Historia de Vida</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/historias/generarLibro" method="GET">
        <div class="d-flex justify-content-start">
            <div class="">
                <label for="fecha" class="form-label col-form-label-sm " style="width: 110px;">Fecha de inicio</label>
            </div>
            <div class="fecha" style="width: fit-content;">
                <input type="date" class="form-control form-control-sm" id="fechaInicio" name="fechaInicio" value="{{$fecha}}">
            </div>
        </div>

        <div class="d-flex justify-content-start">
            <div class="">
                <label for="fecha" class="form-label col-form-label-sm " style="width: 110px;">Fecha de fin</label>
            </div>
            <div class="fecha">
                <input type="date" class="form-control form-control-sm" id="fechaFin" name="fechaFin" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>
        </div>


        <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

        <div class="row mt-3">
            <div class="col-sm-4 col-md-3 col-lg-2 ">
                <label for="etapa" class="form-check-label negrita">Etapa de la vida</label>
                <div id="checkboxes" class="checkboxes">
                    @foreach ($etapas as $etapa)
                    <label> <input class="form-check-input" type="checkbox" onclick="onSelect('{{$etapa->nombre}}', 'seleccionadoEtapa')" value={{$etapa->id}} name="seleccionEtapa[]">{{$etapa->nombre}}</label>
                    @endforeach
                </div>
            </div>


            <div class="col-sm-3 col-md-2 col-lg-2">
                <label for="categoria" class="form-check-label negrita">Categoría</label>
                <div id="checkboxesCat" class="checkboxes">
                    @foreach ($categorias as $categoria)
                    <label> <input type="checkbox" class="form-check-input" onclick="onSelect('{{$categoria->nombre}}', 'seleccionadoCat')" value={{$categoria->id}} name="seleccionCat[]">{{$categoria->nombre}}</label>
                    @endforeach
                </div>
            </div>
            @if (Auth::user()->rol_id == 1)
            <div class="  col-sm-3 col-md-2 col-lg-2">
                <label for="etiqueta" class="form-check-label negrita">Etiqueta</label>

                <div id="checkboxesEtiqueta" class="checkboxes">
                    @foreach ($etiquetas as $etiqueta)
                    <label> <input type="checkbox" class="form-check-input" onclick="onSelect('{{$etiqueta->nombre}}','seleccionadoEtiqueta')" value={{$etiqueta->id}} name="seleccionEtiq[]">{{$etiqueta->nombre}}</label>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

       <label class="form-check-label mt-3 negrita">Tipo de recuerdos<i class="bi bi-question-circle" data-toggle="tooltip" data-placement="top" title="Filtramos aquellos recuerdos que se han categorizado como aptos para continuar en las terapias y/o los que no."></i></label>

        <div class="form-check ">
            <input type="hidden" name="apto" id="apto" value="1">
            <input type="checkbox" class="form-check-input" onclick="onCheck('apto')" checked>
            <label class=" col-form-label-sm " for="1">Aptos</label><br>
            <input type="hidden" name="noApto" id="noApto" value="0">
            <input type="checkbox" class="form-check-input" onclick="onCheck('noApto')">
            <label class="form-label col-form-label-sm" for="0">No aptos</label>
        </div>



        <div>
            <button type="submit" name="generarLibro" value="Generar libro" class="btn btn-outline-primary ">Generar libro</button>
            <button type="submit" name="generarPdf" formaction="/generarPDFHistoria" value="Generar PDF" class="btn btn-outline-primary ">Generar PDF</button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/historiaVida.js"></script>
@endpush