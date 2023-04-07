@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos usuario</h5>
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
                <div class="row text-align-center">
                    <div class="col-lg-3 align-items-center">
                        @include('usuarios.foto')
                    </div>
                    <div class="col-lg-9">
                        @include('usuarios.listaItems')
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('usuarios.desplegables')

    <div class="col-12">
        <!-- <a href="{{route('usuarios.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a> -->
        <a href="/usuarios/{{$paciente->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
    </div>
</div>

@endsection

@push('scripts')
@include('layouts.scripts')
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    <script src="/js/libs/chart.js"></script>
    <script src="/js/libs/chartAnnotation.js"></script>

    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>
    <script src="/js/showView.js"></script>

    
    <script>
        const fechas = @json($fechas);
        const gds = {{json_encode($gds)}};
        const mini = {{json_encode($mini)}};
        const cdr = {{json_encode($cdr)}};
        const data = [];
        for (let i = 0; i < fechas.length; i++) {
            const item = {
                x: fechas[i],
                GDS: gds[i],
                mental: mini[i],
                CDR: cdr[i]
            };
            if(item.GDS == null)
                item.GDS = data[i-1].GDS
            if(item.mental == null)
                item.mental = data[i-1].mental
            if(item.CDR == null)
                item.CDR = data[i-1].CDR
            data.push(item)
        }

    </script>
    <script src="/js/chart.js"></script>
    @if (Session::has('created'))
        @php
            Illuminate\Support\Facades\Session::forget('created');
        @endphp
        <script>
            var action = "Modificado"
        </script>
        <script src="/js/successAlert.js"></script>
    @endif
@endpush