
@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear nueva persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" id="d" method="post" action="/crearPersona">
        {{csrf_field()}}
            <div class="dropzone-inner">
                @include('personasrelacionadas.foto')
                @include('personasrelacionadas.listaItems')
                <div class="dz-default dz-message dropzone-correct" id="dzp">
                    <div class="container dropzone-container">
                        <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                        <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">
                    
                </div>
            </div>
        
        <div class="form-group">
            <button id="guardar"  type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$idPaciente}}/personas"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
        
</div>

  

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="/js/especificar.js"></script>
    <script>
        let id = document.getElementById("paciente_id").value;
        var ruta = "/pacientes/" + id + "/personas"
        var max = 1
    </script>
    <script src="/js/dropzone.js"></script>
@endpush