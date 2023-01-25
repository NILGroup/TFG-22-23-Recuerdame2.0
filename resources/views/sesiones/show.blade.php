@extends('layouts.structure')

@section('content')

<div class="container-fluid">

    @include('sesiones.listaItems')

    <div>
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
    </div>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script src="/js/table.js"></script>
@endpush
