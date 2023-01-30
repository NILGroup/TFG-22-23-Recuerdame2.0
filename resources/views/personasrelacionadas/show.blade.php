@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    @include('personasrelacionadas.foto')
    @include('personasrelacionadas.listaItems')
    <div class="col-12">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</div>
  

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="/js/showView.js"></script>
@endpush