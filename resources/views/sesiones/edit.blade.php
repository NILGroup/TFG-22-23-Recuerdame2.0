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
        <div class="dz-default dz-message dropzone-correct" id="dzp">
            <div class="container dropzone-container">
                <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
            </div>
        </div>
        <div class="dropzone-previews">


        </div>
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Material Existente</h5>
        </div>

        <div id="showMultimedia" class="row pb-2">
            @foreach ($sesion->multimedias as $media)
                @include("layouts.multimedia")
            @endforeach
        </div>
        <div>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" id="guardar" name="guardarSesion" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>
</div>

@include('recuerdos.modals')
@include('personasrelacionadas.modals')

@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/libs/dropzone.js"></script>
    <script src="/js/table.js"></script>
    <script src="/js/multiModal.js"></script>
    <script>
        $("#add-multimedia").hide()
        let id = document.getElementById("idPaciente").value;
        let id2 = document.getElementById("idSesion").value;

        
        let dropzone_config = {
            ruta: "/pacientes/" + id + "/sesiones/" + id2
        }
        
    </script>
    <script src="/js/dropzone.js"></script>
    <script src="/js/persona.js"></script>
    <script src="/js/recuerdo.js"></script>
    <script src="/js/multimediaModal.js"></script>
@endpush