@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear nueva persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/personas">
        {{csrf_field()}}
        @include('personasrelacionadas.listaItems')

        <!--
        <input type="hidden" name="paciente_id" value="{{$idPaciente}}">


        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" required>
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" required>
                </div>
            </div>
        </div>

        

        <div class="row form-group justify-content-between">
           <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="telefono" class="form-control form-control-sm" id="telefono">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" required>
                </div>
            </div>

        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="email" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Email<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="email" class="form-control form-control-sm" id="email" required>
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="localidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Localidad<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input required type="text" name="localidad" class="form-control form-control-sm" id="localidad">   
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo relación<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select class="form-select form-select-sm" id="tiporelacion_id" name="tiporelacion_id" required>
                        @foreach ($tipos as $tipo)
                       
                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="contacto" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contacto<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input required type="text" name="contacto" class="form-control form-control-sm" id="contacto">   
                </div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
            <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3"></textarea>
        </div>
        -->
        <div class="col-12">
            <button type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$idPaciente}}/personas"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
  

@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush