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
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de inicio</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="date" class="form-control form-control-sm" id="fechaInicio" name="fechaInicio" value="<?php echo ($fecha) ?>">
                </div>
            </div>

            <div class="row col-sm-6 col-md-6 col-lg-6">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha de fin</label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="date" class="form-control form-control-sm" id="fechaFin" name="fechaFin" value="<?php echo (date('Y-m-d')) ?>">
                </div>
            </div>
        </div>

        <input type="hidden" name="paciente_id"  id="paciente_id"  value="{{Session::get('paciente')['id']}}">

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
            <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Categoría</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select class="form-select form-select-sm" id="idCategoria" name="idCategoria">
                    <option></option>      
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
            <div class="col-sm-3 col-md-3 col-lg-2">
                <select class="form-select form-select-sm" id="idEtiqueta" name="idEtiqueta">
                    <option></option>  
                    @foreach ($etiquetas as $etiqueta)
                        <option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <button type="submit" name="generarLibro" value="Generar libro" class="btn btn-outline-primary ">Generar libro</button>
            <button type="submit" name="generarPdf" formaction="/generarPDFHistoria" value="Generar PDF" class="btn btn-outline-primary ">Generar PDF</button>
        </div>
    </form>

</div>


@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush