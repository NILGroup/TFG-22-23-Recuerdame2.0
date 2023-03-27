@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Registro persona cuidadora</h5>
        <hr class="lineaTitulo">
    </div>

    <form class="dropzone p-0" id="d" method="post" action="/registroCuidador">
        {{csrf_field()}}
        <div class="dropzone-inner">
            @include('cuidadores.foto')
            @include('cuidadores.listaItems')
            <div class="dz-default dz-message dropzone-correct" id="dzp">
                <div class="container dropzone-container">
                    <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                    <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                </div>
            </div>
            <div class="dropzone-previews">
                    
                </div>
            <div class="col-12">
                <a href="/pacientes/{{$paciente->id}}/cuidadores"><button type="button" class="btn btn-primary">Cancelar</button></a>
                <button type="submit" value="Guardar" id="guardar" class="btn btn-outline-primary">Finalizar</button>
            </div>
        </div>


    </form>



</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/dropzone.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>

    <script>
        let id = document.getElementById("paciente").value;
        let send_dropzone = true

        let dropzone_config = {
            limit: true,
            max: 1,
            silenceMode: true,
            ruta: "/pacientes/" + id + "/cuidadores"
        }
        
    </script>
    <script src="/js/cuidador.js"></script>
    <script src="/js/dropzone.js"></script>
    
@endpush