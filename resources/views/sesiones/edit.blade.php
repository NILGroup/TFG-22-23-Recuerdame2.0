@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <form class="dropzone p-0" id="d"  action="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/update" method="POST">
        {{csrf_field()}}
        @include('sesiones.listaItems')
        <div class="row d-flex">
            @foreach ($sesion->multimedias as $media)
            <div class="mb-5" style="width: fit-content;">
                <label class="visualizarImagen" for="media"><img src="{{$media->fichero}}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon" style="height:15em; width: 15em;"></label>
                <input class="form-check-input me-1" name="media[]" type="checkbox" value="{{$media->id}}" style="background-color: #F63F3E">
            </div>
            @endforeach
        </div>
        <div class="dz-default dz-message dropzone-correct" id="dzp">
            <div class="container dropzone-container">
                <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
            </div>
        </div>
        <div class="dropzone-previews">


        </div>
        <div>
            <button type="submit" id="guardar" name="guardarSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@include('sesiones.modals')
@include('recuerdos.modals')

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="/js/table.js"></script>
    <script>
        let id = document.getElementById("idPaciente").value;
        let id2 = document.getElementById("idSesion").value;
        var ruta = "/pacientes/" + id + "/sesiones/" + id2;
        var max
    </script>
    <script src="/js/dropzone.js"></script>
@endpush