@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/recuerdo">
        {{csrf_field()}}
        @include('recuerdos.listaItems')
        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary btn">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Atrás</button></a>
        </div>
    </form>
</div>

@include('recuerdos.models')
@endsection


@push('scripts')
    @include('layouts.scripts') 
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script src="/js/table.js"></script>
    <script src="/js/dropzone.js"></script>
    
@endpush