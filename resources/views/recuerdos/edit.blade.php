@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Editar recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form id="recuerdo-form" method="post" action="/actualizarRecuerdo" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('recuerdos.listaItems')

        <div class="pt-4 pb-2">
            <h5 class="text-muted">Material Existente</h5>
        </div>

        <div id="showMultimedia" class="row pb-2">
            @foreach ($recuerdo->multimedias as $media)
                @include("layouts.multimedia")
            @endforeach
        </div>


        <div class="col-12">
            <a href="/usuarios/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Cancelar</button></a>
            <button type="submit" id="recuerdo-guardar" value="Guardar" class="btn btn-outline-primary btn">Finalizar</button>
        </div>
    </form>
</div>

@include('personasrelacionadas.modals')
@include('recuerdos.descripcionModal')
@endsection


@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>   -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/table.js"></script>
    <script src="/js/especificar.js"></script>
    <script src="/js/persona.js"></script>
    <script src="/js/multimediaModal.js"></script>
    <script src="/js/multimediaRecuerdo.js"></script>
   
@endpush