@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/actualizarPaciente">
        {{csrf_field()}}
        @include('pacientes.listaItems')
        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/especificar.js"></script>
@endpush