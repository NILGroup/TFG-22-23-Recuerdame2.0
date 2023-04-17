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
                    <th scope="col" class="fit10 text-center">Título</th>
                    <th class="fit5 text-center" scope="col">Fecha</th>
                    <!--<th scope="col" class="text-center">Resumen</th>-->
                    <th class="fit5 text-center tableActions" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">
            @foreach($resumenes as $resumen)
            <tr>
                <td><a href="/usuarios/{{$paciente->id}}/resumenes/{{$resumen->id}}">{{$resumen->titulo}}</a></td>
                <td>{{$resumen->fecha}}</td>
                <!--<td><div class="campoResumen">{{$resumen->resumen}}</div></td>-->
                <td class="tableActions">
                    <a href="/usuarios/{{$paciente->id}}/resumenes/{{$resumen->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver información del resumen"></i></a>
                    
                        <!-- Boton de editar -->
                        <a href="/usuarios/{{$paciente->id}}/resumenes/{{$resumen->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar resumen"></i></a>
                        <!-- Boton de eliminar -->
                        <form method="post" action="{{ route('resumenes.destroy', $resumen->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"  data-toggle="tooltip" data-placement="top" title="Eliminar resumen"></i></button>
                        </form>
                   
                </td>
            </tr>
            @endforeach
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