@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de recuerdos</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <div class="row mb-2">
                <div class="col-12 justify-content-end d-flex">
                    <a href="/pacientes/{{$paciente->id}}/recuerdos/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>

        </div>
    </div>

    <div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
        <caption>Listado de recuerdos</caption>
        <thead>
        <tr class="bg-primary">
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Etapa</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <!--<tbody>-->

            @foreach($recuerdos as $recuerdo)
            <tr>

                <td><a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}">{{$recuerdo->nombre}}</a></td>
                <td>{{$recuerdo->fecha}}</td>
                <td>{{$recuerdo->etapa->nombre}}</td>
                @if(!is_null($recuerdo->categoria))
                <td>{{$recuerdo->categoria->nombre}}</td>
                @else
                <td>Sin categoría</td>
                @endif
                @if(!is_null($recuerdo->estado))
                <td>{{$recuerdo->estado->nombre}}</td>
                @else
                <td>Sin estado</td>
                @endif
                @if(!is_null($recuerdo->etiqueta))
                <td>{{$recuerdo->etiqueta->nombre}}</td>
                @else
                <td>Sin etiqueta</td>
                @endif
                <td class="tableActions">
                    <a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                    @if (Auth::user()->rol_id == 1)
                        <!-- Boton de editar -->
                        <a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <!-- Boton de eliminar -->
                        <form method="post" action="{{ route('recuerdo.destroy', $recuerdo->id) }}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach

        </table>
    </div>
    @endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>
@endpush