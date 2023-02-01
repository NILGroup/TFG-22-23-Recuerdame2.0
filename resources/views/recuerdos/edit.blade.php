@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" id="d" method="post" action="/recuerdo">
        {{csrf_field()}}
        @include('recuerdos.listaItems')
        <div class="row d-flex">
            @foreach ($recuerdo->multimedias as $media)

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
        <div class="col-12">
            <button type="submit" id="guardar" value="Guardar" class="btn btn-outline-primary btn">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Atrás</button></a>
        </div>
    </form>
</div>

@include('recuerdos.modals')
@endsection


@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="/js/table.js"></script>
    <script>
        let id = document.getElementById("paciente_id").value;
        let id2 = document.getElementById("id").value
        var ruta = "/pacientes/" + id + "/recuerdos/" + id2
        var max
        var limit = false
    </script>
    <script src="/js/dropzone.js"></script>
@endpush