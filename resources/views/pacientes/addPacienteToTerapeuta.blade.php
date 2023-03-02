@extends('layouts.structure')

@section('content')

<!-- Tu contenido aquí -->

<div class="container-fluid">

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Asignar usuario a otros terapeutas</h5>
        <hr class="lineaTitulo">
    </div>
    <form action="/asignacionTerapeutas" method="post">
        {{csrf_field()}}

        <input type="hidden" value="{{$paciente->id}}" name="paciente_id">
        
        <div class ="tabla">
            <div class="d-flex justify-content-between upper">
                @include('layouts.tableSearcher')
            </div>
            <table class="table table-bordered recuerdameTable datatable">
                <thead>
                    <tr >
                        <th class="fit5 text-center" scope="col col-12">Asignar</th>
                        <th class="text-center" scope="col col-12">Nombre</th>
                    </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center" scope="row">
                            <input class="form-check-input" type="checkbox" value={{$user->id}} name="seleccion[]" @if($user->pacientes->contains($paciente)) checked @endif>
                        </td>
                        <td>
                            {{$user->nombre}} {{$user->apellidos}}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-12">
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
    <script src="/js/table.js"></script>
@endpush