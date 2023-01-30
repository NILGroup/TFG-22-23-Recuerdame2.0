@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="accordion mb-2"> 
        <div class="accordion-item accordion-header" id="evaluaciones1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#general" aria-expanded="true" aria-controls="general">
                <div class="w-100">
                    <h5 class="text-muted text-start">Datos Generales</h5>
                </div>
            </button>
            <div id="general" class="container-fluid accordion-collapse collapse show" aria-labelledby="general">
                @include('pacientes.listaItems')
            </div>
        </div>
    </div>


    @include('pacientes.desplegables')

    <div class="col-12">
        <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>
    <script src="/js/showView.js"></script>
@endpush