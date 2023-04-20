@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <div style="margin-right: 50px;">
        @include('personasrelacionadas.listaItems')
    </div>

    @if (Auth::user()->rol_id == 1)
    <div class="col-12">
        <!-- <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a> -->
        <a href="/usuarios/{{$idPaciente}}/personas/{{$persona->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
    </div>
    @endif
</div>


@endsection

@push('scripts')
@include('layouts.scripts')
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/sweetAlert2.js"></script>
    
    <script src="/js/showView.js"></script>

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