@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear paciente</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0"  style="border:none !important; background-color: #00000000;" id="d" method="post" action="/pacientes">
        {{csrf_field()}}

        <div style="padding: 20px;">
            @include('pacientes.listaItems')
            <div style="border: 1px solid #868e96;" class="dz-default dz-message" id="dzp">
                <div class="container" style="height: 10em;">
                    <h2 style="color: #868e96;">Arrastre sus archivos</h1>
                </div>
            </div>
            <div class="dropzone-previews">

            </div>
        </div>

        <div class="col-12">
            <button id="guardar" type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        var ruta = "/pacientes/"
    </script>
    <script src="/js/especificar.js"></script>
    <script src="/js/dropzone.js"></script>
@endpush