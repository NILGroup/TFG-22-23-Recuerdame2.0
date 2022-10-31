@extends('layouts.structure')

@section('content')

<!-- Tu contenido aquí -->

<div class="container-fluid">

    <div class="pt-4 pb-2">
        <h5 class="text-muted">Asignar paciente a otros terapeutas</h5>
        <hr class="lineaTitulo">
    </div>
    <form action="/asignacionTerapeutas" method="post">
        {{csrf_field()}}

        <input type="hidden" value="{{$paciente->id}}" name="paciente_id">
        <div>
            <table class="table table-bordered recuerdameTable">
                <thead>
                    <tr>
                        <th scope="col col-1"></th>
                        <th scope="col col-12">Nombre</th>
                        <th scope="col col-12">Apellidos</th>

                </thead>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value={{$user->id}} name="seleccion[]" @if($user->pacientes->contains($paciente)) checked @endif>
                            </div>
                        </th>
                        <td>
                            {{$user->nombre}}
                        </td>
                        <td>
                            {{$user->apellidos}}
                        </td>
                    </tr>
                @endforeach
            </table>
            <input type="hidden" name="numT" value="" />
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush