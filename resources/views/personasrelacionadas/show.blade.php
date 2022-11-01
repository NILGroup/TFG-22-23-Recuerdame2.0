@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="">

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input disabled type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$persona->nombre}}">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos</label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input disabled type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$persona->apellidos}}">
                </div>
            </div>
        </div>

        

        <div class="row form-group justify-content-between">
           <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input disabled type="text" name="telefono" class="form-control form-control-sm" id="telefono" value="{{$persona->telefono}}">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación</label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input disabled type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$persona->ocupacion}}">
                </div>
            </div>

        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="email" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Email</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input disabled type="text" name="email" class="form-control form-control-sm" id="email" value="{{$persona->email}}">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="localidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Localidad</label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input disabled type="text" name="localidad" class="form-control form-control-sm" id="localidad" value="{{$persona->localidad}}">   
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de relación</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input disabled type="text" name="tipo" class="form-control form-control-sm" id="tipo" value="{{$persona->tiporelacion->nombre}}">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="contacto" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contacto</label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input disabled type="text" name="contacto" class="form-control form-control-sm" id="contacto" value="{{$persona->contacto}}">   
                </div>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
            <textarea disabled class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3">{{$persona->observaciones}}</textarea>
        </div>

        <div class="col-12">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
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