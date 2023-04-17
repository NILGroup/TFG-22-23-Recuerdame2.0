@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Resumen generado</h5>
        <hr class="lineaTitulo">
    </div>
    
    @include('resumenes.listaItems')

    <div>
        <!-- <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a> -->
        <a href="/usuarios/{{$paciente->id}}/resumenes/{{$resumen->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
    </div>
    @endsection

    @push('scripts')
    @include('layouts.scripts')
    <script src="/js/showView.js"></script>
    @endpush