@extends('layouts.structure')

@section('content')
<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de recuerdos</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
        <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
                <a href="/recuerdo/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>
          
        </div>
    </div>

    <div>
        <?php $i = 1; ?>
        <table class="table table-bordered recuerdameTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
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

                <th scope="row"><?php echo $i ?></th>

                <td>{{$recuerdo->nombre}}</td>
                <td>{{$recuerdo->fecha}}</td>
                <td>{{$recuerdo->etapa_id}}</td>
                <td>{{$recuerdo->categoria_id}}</td>
                <td>{{$recuerdo->estado_id}}</td>
                <td>{{$recuerdo->etiqueta_id}}</td>
                <td class="tableActions">
                                <a href="/recuerdo/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                <?php if (Auth::user()->rol_id == 1) { ?>
                                    <a href=""><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                                    <a href=""><i class="fa-solid fa-trash-can text-danger tableIcon"></i></a>
                                <?php } ?>
                            </td>
                <?php $i++; ?>
            </tr>
            @endforeach


        </table>
    </div>

    @endsection