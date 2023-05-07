@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Modificar datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>

    @if (isset($persona->multimedia))

    <!-- 

        Solo se muestra el borrar foto cuando el usuario tiene una foto que no es la predeterminada
        Además no habrá dropzone mientras haya ya una foto subida

    -->


    <div class="row align-items-start">
        <div class="col-lg-3">
            @include('personasrelacionadas.foto')
            <form class="d-flex justify-content-center" action="/borrarFoto" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$persona->id}}">
                <button type="submit" class="btn btn-danger mb-3" id="borrar_foto">Eliminar Foto</button>
            </form>
        </div>
        <div class= "col-lg-9">
            <form id="edit-form" method="post" action="/editarPersona">
                {{csrf_field()}}
                @include('personasrelacionadas.listaItems')
            </form>

        </div>
        <div class="col-lg-12">
            <a href="/usuarios/{{$idPaciente}}/personas"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button id="guardar-no-dropzone" form="edit-form" type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
        
    </div>


        
    @else

    <!-- 

        Si la persona no tiene foto no se muestra el botón y se muestra el dropzone

    -->

    
    <form class="dropzone p-0" id="d" method="post" action="/editarPersona">
        {{csrf_field()}}

        <div class="dropzone-inner">

            <div class="row align-items-start">
                <div class="col-lg-3">
                    @include('personasrelacionadas.foto')
                </div>
                <div class="col-lg-9">
                    @include('personasrelacionadas.listaItems')
                </div>
            </div>
            
            <div class="dz-default dz-message dropzone-correct" id="dzp">
                <div class="container dropzone-container" style="height: 10em;">
                    <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                    <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                </div>
            </div>
            <div class="dropzone-previews">

            </div>
        </div>

        <div class="form-group">
            <a href="/usuarios/{{$idPaciente}}/personas"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button id="guardar" type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>


    @endif


</div>


@endsection

@push('scripts')
@include('layouts.scripts')
<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
<script src="/js/libs/dataTables.js"></script>
<script src="/js/libs/dropzone.js"></script>

<script src="/js/especificar.js"></script>
<script>
    let id = document.getElementById("paciente_id").value;
    let id2 = document.getElementById("id").value


    let dropzone_config = {
        ruta: "/usuarios/" + id + "/personas/" + id2,
        max: 1,
        limit: true
    }

    $("#guardar-no-dropzone").on("click", function(e){
        e.stopPropagation()

        let form = $("#edit-form")[0]

        if (!form.checkValidity()){
            e.preventDefault()
        }

        form.classList.add("was-validated")
    })
   
</script>
<script src="/js/dropzone.js"></script>
@endpush