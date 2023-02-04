@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" id="d" method="post" action="/recuerdo"  >
        {{csrf_field()}}

        <div class="dropzone-inner">
                @include('recuerdos.listaItems')
                <div class="dz-default dz-message dropzone-correct" id="dzp">
                    <div class="container dropzone-container">
                        <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                        <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">


                </div>
        </div>

        <div class="col-12 ">
            <a href="/pacientes/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Cancelar</button></a>
            <button id="guardar" type="submit" value="Guardar" class="btn btn-outline-primary btn">Finalizar</button>
        </div>
    </form>
</div>

@include('recuerdos.modals')
@endsection

@push('styles')
<link rel="stylesheet" href="/css/slider.css">
@endpush

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="/js/table.js"></script>
    <script>
        let id = document.getElementById("paciente_id").value;
        var ruta = "/pacientes/" + id + "/recuerdos"
        var max // no borrar
        var limit = false
    </script>
    <script src="/js/dropzone.js"></script>
    <script src="/js/persona.js"></script>
@endpush