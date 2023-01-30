@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos del recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    @include('recuerdos.listaItems')
    <div class="col-12">
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn">Atrás</button></a>
    </div>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
    <script src="/js/table.js"></script>
    <script src="/js/showView.js"></script>
@endpush