@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de resúmenes</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de resúmenes</caption>
            <thead>
                <tr>
                    <th class="fit5 text-center" scope="col">Fecha</th>
                    <th scope="col" class="fit10 text-center">Título</th>
                    <th scope="col" class="text-center">Resúmen</th>
                    <th class="fit5 text-center tableActions" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">


            </tbody>
        </table>
    </div>

    @include('layouts.deletePopUp')

    @endsection

    @push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>

    @if (Session::has('created'))
    @php
    Illuminate\Support\Facades\Session::forget('created');
    @endphp
    <script>
        var action = "Creado"
    </script>
    <script src="/js/successAlert.js"></script>
    @endif
    @endpush