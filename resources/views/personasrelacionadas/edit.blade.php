@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Modificar datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/personas/{{$persona->id}}">

    
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$persona->nombre}}">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos</label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$persona->apellidos}}">
                </div>
            </div>
        </div>

        

        <div class="row form-group justify-content-between">
           <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="telefono" class="form-control form-control-sm" id="telefono" value="{{$persona->telefono}}">
                   
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación</label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$persona->ocupacion}}">
                </div>
            </div>

        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="email" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Email</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="email" class="form-control form-control-sm" id="email" value="{{$persona->email}}">
                   
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de relación</label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select class="form-select form-select-sm" id="tiporelacion_id" name="tiporelacion_id" >
                        
                        @foreach ($tipos as $tipo)
                        
                        
                        <?php if ($tipo->nombre == $persona->tiporelacion->nombre) echo "<option  value='{$tipo->id}' selected > {$tipo->nombre}  </option>"; 
                        else echo "<option  value='{$tipo->id}' >{$tipo->nombre} </option>";?>
                        
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
        </div>
    </form>
</div>
  

@endsection