@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de personas relacionadas</h5>
        <hr class="lineaTitulo">
    </div>


    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <a href="/pacientes/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
        </div>
    </div>

    <div>
        <table class="table table-bordered table-striped table-responsive">
            <caption>Listado de personas relacionadas</caption>
            <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Tipo de Relacion</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($personas as $persona)
                <tr>
                    <th scope="row"><?php echo $i ?></th>

                    <td>{{$persona->nombre}}</td>
                    <td>{{$persona->apellidos}}</td>
                    <td>{{$persona->tiporelacion->nombre}}</td>

                    <td class="tableActions">
                        <a href="{{route('personas.show', $persona->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="{{route('personas.edit', $persona->id)}}"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="/personas/{{$persona->id}}" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    </td>
                </tr>
                <?php $i++; ?>

                @endforeach
                @if(sizeof($personas) == 0)
                    <tr>
                        <td colspan="8" align="center">No se han generado personas relacionadas</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush