@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Resumen generado</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" id="d" method="post">
        {{csrf_field()}}
        <div class="dropzone-inner">
            @include('resumenes.listaItems')
        </div>
    </form>

    <div class="text-center">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Regenerar resumen</button></a>
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Guardar resumen</button></a>
    </div>
    @endsection

    @push('scripts')
    @include('layouts.scripts')

    @endpush