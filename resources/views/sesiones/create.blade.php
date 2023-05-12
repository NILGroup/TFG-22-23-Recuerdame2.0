@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos de la sesión</h5>
        <hr class="lineaTitulo">
    </div>
    
    <form class="dropzone p-0" id="d" method="post" action="/guardarSesion"  >
            {{csrf_field()}}
            <div class="dropzone-inner">
                    @include('sesiones.listaItems')
                    <div class="dz-default dz-message dropzone-correct" id="dzp">
                        <div class="container dropzone-container">
                            <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                            <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h2>
                        </div>
                    </div>
                    <div class="dropzone-previews">


                    </div>
                    <div class="pt-4 pb-2">
                        <h5 class="text-muted">Material Existente</h5>
                    </div>
                    <div id="showMultimedia" class="row pb-2">
                    
                    </div>
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
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>   -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/libs/dropzone.js"></script>

    <script src="/js/table.js"></script>
    <script>
        
        $("#add-multimedia").hide()
        $("#remove-multimedia").hide()
        
        let id = document.getElementById("paciente_id").value;

        let dropzone_config = {
            ruta: "/usuarios/" + id + "/sesiones"
        }

    </script>
    <script src="/js/dropzone.js"></script>
    <script src="/js/recuerdo.js"></script>
    <script src="/js/persona.js"></script>
    <script src="/js/especificar.js"></script>
    <script src="/js/multiModal.js"></script>
    <script src="/js/multimediaModal.js"></script>
@endpush