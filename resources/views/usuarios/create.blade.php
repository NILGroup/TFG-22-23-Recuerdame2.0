@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear usuario</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" id="d" method="post" action="/usuarios">
        {{csrf_field()}}

        <div class="dropzone-inner">
            @include('usuarios.listaItems')
            <div class="dz-default dz-message dropzone-correct" id="dzp">
                <div class="container dropzone-container">
                    <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                    <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                </div>
            </div>
            <div class="dropzone-previews">

            </div>
        </div>

        <div class="col-12">
            <a href="{{route('usuarios.index')}}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button id="guardar" type="submit" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>
</div>

@endsection


@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
    <script src="/js/libs/dropzone.js"></script>
    <script>

        let dropzone_config = {
            limit: true,
            max: 1,
            ruta: "/usuarios/"
        }
        
    </script>
    <script src="/js/especificar.js"></script>
    <script src="/js/dropzone.js"></script>
@endpush