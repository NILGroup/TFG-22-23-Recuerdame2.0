@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2 mb-3">
        <h5 class="text-muted">Editar persona cuidadora</h5>
        <hr class="lineaTitulo">
    </div>


    @if (isset($cuidador->multimedia))

    <!-- 

        Solo se muestra el borrar foto cuando el usuario tiene una foto que no es la predeterminada
        Además no habrá dropzone mientras haya ya una foto subida

    -->
    <div id="general" class="container-fluid accordion-collapse collapse show" aria-labelledby="general">
                 
    <div class="row text-align-center"  style="align-items: flex-start!important;">
        <div class="d-flex flex-column text-center col-lg-3 align-items-center justify-content-center ">
        @include('cuidadores.foto')
        <div class="img-wrap text-center mx-auto">
            <form action="/borrar_foto_cuidador" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$cuidador->id}}">
                <button type="submit" class="mx-auto text-center align-center btn btn-danger mb-1" id="borrar_foto">Eliminar foto</button>
            </form>
        </div>
        </div>
        
        <div class="col-lg-9 mt-4">
            <form id="d" method="post" action="/actualizarCuidador">
                {{csrf_field()}}
                            @include('cuidadores.listaItems')
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <a href="/usuarios/{{$paciente->id}}/cuidadores"><button type="button" class="btn btn-primary">Cancelar</button></a>
                    <button type="submit" value="Guardar" id="guardar" class="btn btn-outline-primary">Finalizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

    @else
    <form class="dropzone p-0" id="d" method="post" action="/registroCuidador">
        {{csrf_field()}}

        <div class="dropzone-inner">
            <div id="general" class="container-fluid accordion-collapse collapse show" aria-labelledby="general">
                <div class="row text-align-center">
                    <div class="col-lg-3 align-items-center">
                        @include('cuidadores.foto')
                    </div>
                    <div class="col-lg-9">
                        @include('cuidadores.listaItems')
                    </div>
                </div>
            </div>
            <div class="dz-default dz-message dropzone-correct" id="dzp">
                <div class="container dropzone-container" style="height: 10em;">
                    <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                    <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h2>
                </div>
            </div>
            <div class="dropzone-previews">

            </div>
        </div>

        <div class="form-group">
            <a href="/usuarios/{{$paciente->id}}/cuidadores"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button id="guardar" type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>



    @endif
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
    let id2 = document.getElementById("id").value

    let dropzone_config = {
            limit: true,
            max: 1,
            silenceMode: true,
            ruta:  "/usuarios/" + id + "/cuidadores/" + id2
        }
 


    let send_dropzone = null
</script>

@if (!isset($cuidador->multimedia))
<script src="/js/dropzone.js"></script>
<script>
    send_dropzone = true
</script>
@endif

<script src="/js/cuidador.js"></script>



@endpush