@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form id="recuerdo-form" class="p-3" method="post" action="/recuerdo" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('recuerdos.listaItems')

        

        <div class="pt-4 pb-2">
            <h5 class="text-muted">Material Existente</h5>
        </div>


        <div id="showMultimedia" class="row pb-2"></div>

        
        <div class="col-12">
            <a href="/usuarios/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Cancelar</button></a>
            <button id="recuerdo-guardar" type="submit" value="Guardar" class="btn btn-outline-primary btn">Finalizar</button>
        </div>
    </form>
</div>

@include('personasrelacionadas.modals')
@include('recuerdos.descripcionModal')
@endsection

@push('styles')
<link rel="stylesheet" href="/css/slider.css">
@endpush

@push('scripts')
@include('layouts.scripts')

<script src="/js/libs/dataTables.js"></script>
<script src="/js/table.js"></script>
<script>
    $("#remove-multimedia").hide()
    
</script>

<script src="/js/persona.js"></script>
<script src="/js/especificar.js"></script>
<script src="/js/multimediaModal.js"></script>
<script src="/js/multimediaRecuerdo.js"></script>

@endpush