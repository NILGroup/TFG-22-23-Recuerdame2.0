@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0"  style="border:none !important; background-color: #00000000;" id="d" method="post" action="/recuerdo"  >
        {{csrf_field()}}

        <div style="padding: 20px;">
                @include('recuerdos.listaItems')
                <div style="border: 1px solid #868e96;" class="dz-default dz-message" id="dzp">
                    <div class="container" style="height: 10em;">
                        <h2 style="color: #868e96;">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">


                </div>
        </div>

        <div class="col-12 ">
            <button id="guardar" type="submit" value="Guardar" class="btn btn-outline-primary btn">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Atrás</button></a>
        </div>
    </form>
</div>

@include('recuerdos.models')
@endsection

@push('styles')
<link rel="stylesheet" href="/css/slider.css">
@endpush

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script src="/js/table.js"></script>
    <script src="/js/dropzone.js"></script>
   
@endpush