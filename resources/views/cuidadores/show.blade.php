@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Ver persona cuidadora</h5>
        <hr class="lineaTitulo">
    </div>

    <form method="POST" action="/registroCuidador" id="formulario">
        {{csrf_field()}}
        <div id="general" class="container-fluid accordion-collapse collapse show" aria-labelledby="general">
            <div class="row text-align-center">
                <div class="col-lg-3 align-items-center">
                    @include('cuidadores.foto')
                </div>
                <div class="col-lg-9">
                    @include('cuidadores.listaItems')
                </div>
            </div>
        </div>

        <div>
            <!-- <a href="/pacientes/{{$paciente->id}}/cuidadores"><button type="button" class="btn btn-primary">Atrás</button></a> -->
            <a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}/editar"><button type="button" class="btn btn-secondary">Editar</button></a>
        </div>
    </form>
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