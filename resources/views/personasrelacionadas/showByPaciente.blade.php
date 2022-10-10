@extends('layouts.structure')

@section('content')

<div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Listado de personas relacionadas</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
                <a href=""><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
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
                @foreach($personas as $persona)
                    <?php $i=1; ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>

                        <td>{{$persona->nombre}}</td>
                        <td>{{$persona->apellidos}}</td>
                        <td>{{$persona->tiporelacion->nombre}}</td>
                          



                        <td class="tableActions">
                            <a href=""><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href=""><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            <a href=""><i class="fa-solid fa-trash-can text-danger tableIcon"></i></a>

                        </td>
                    </tr>
                    <?php $i++;?>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
