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
            <table class="table table-bordered recuerdameTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Tipo de Relacion</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
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
                                    <button  type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++;?>

                @endforeach
            </tbody>
        </table>
        <div class="col-12">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
        </div>
    </div>
</div>

@endsection
