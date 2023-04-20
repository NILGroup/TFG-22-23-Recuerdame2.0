@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Editar resumen</h5>
        <hr class="lineaTitulo">
    </div>

    <form id="resumen-form" method="post" action="/modificarResumen">
        {{csrf_field()}}
        @include('resumenes.listaItems')

        <div class="col-12">
            <a href="/usuarios/{{$paciente->id}}/resumenes"><button type="button" class="btn btn-primary btn">Cancelar</button></a>
            <button type="submit" id="resumen-guardar" value="Guardar" class="btn btn-outline-primary btn">Finalizar</button>
        </div>
    </form>

</div>



@endsection


@push('scripts')
@include('layouts.scripts')

@endpush