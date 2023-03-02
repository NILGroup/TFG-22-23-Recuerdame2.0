@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de recuerdos</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="tabla">
        <div class="d-flex justify-content-between upper">
            @include('layouts.tableSearcher')
            <div class="justify-content-end d-flex">
                <a href="/pacientes/{{$paciente->id}}/recuerdos/crear"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
        <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de recuerdos</caption>
            <thead>
                <tr >
                    <th scope="col" class="text-center">Nombre</th>
                    @if (Auth::user()->rol_id == 1)
                        <th scope="col" class="text-center">Etapa</th>
                        <th scope="col" class="text-center">Categoría</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Etiqueta</th>
                        <th scope="col" class="text-center">Apto</th>
                    @endif
                    <th class="fit10 text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">

            @foreach($recuerdos as $recuerdo)
            <tr>

                <td><a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}">{{$recuerdo->nombre}}</a></td>
                @if (Auth::user()->rol_id == 1)
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
                    <td class=" text-center">
                        <input class="form-check-input" type="checkbox" name="apto" value="1" id="apto" @if($recuerdo->apto) checked @endif disabled>
                    </td>
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