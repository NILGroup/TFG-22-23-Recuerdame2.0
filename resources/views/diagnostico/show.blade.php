@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos informe de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/cerrarEvaluacion" method="POST">
        {{csrf_field()}}
        @include('diagnostico.listaItems')
        @include('diagnostico.charts')
        <div>
            <!-- <a href="/pacientes/{{$paciente->id}}/evaluaciones"><button type="button" class="btn btn-primary">Atrás</button></a> -->
            <a href="/pacientes/{{$paciente->id}}/editarDiagnostico"><button type="button" class="btn btn-secondary">Editar</button></a>
            <a href="/pacientes/{{$paciente->id}}/informeDiagnostico"><button type="button" class="btn btn-outline-primary">Generar PDF</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/2.2.1/chartjs-plugin-annotation.min.js" integrity="sha512-qF3T5CaMgSRNrxzu69V3ZrYGnrbRMIqrkE+OrE01DDsYDNo8R1VrtYL8pk+fqhKxUBXQ2z+yV/irk+AbbHtBAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="/js/libs/chart.js"></script>
    <script src="/js/libs/chartAnnotation.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    <script src="/js/libs/touchSpin.js"></script>
    <script src="/js/showView.js"></script>
    <script src="/js/evaluacion.js"></script>

    <script>
        const fecha = @json($fecha);
        const gds = {{json_encode($gds)}};
        const mini = {{json_encode($mini)}};
        const cdr = {{json_encode($cdr)}};
        const data = [];
        for (let i = 0; i < fecha.length; i++) {
            const item = {
                x: fecha[i],
                GDS: gds[i],
                mental: mini[i],
                CDR: cdr[i]
            };
            console.log(item)
            if(item.GDS == null)
                item.GDS = data[i-1].GDS
            if(item.mental == null)
                item.mental = data[i-1].mental
            if(item.CDR == null)
                item.CDR = data[i-1].CDR
            data.push(item)
        }
        console.log(data)

    
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
