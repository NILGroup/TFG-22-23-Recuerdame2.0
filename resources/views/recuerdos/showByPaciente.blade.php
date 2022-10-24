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
        <table class="table table-bordered table-striped table-responsive">
        <caption>Listado de recuerdos</caption>
        <thead>
        <tr class="bg-primary">
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

                <td><a href="/recuerdo/{{$recuerdo->id}}">{{$recuerdo->nombre}}</a></td>
                <td>{{$recuerdo->fecha}}</td>
                <td>{{$recuerdo->etapa_id}}</td>
                <td>{{$recuerdo->categoria_id}}</td>
                <td>{{$recuerdo->estado_id}}</td>
                <td>{{$recuerdo->etiqueta_id}}</td>
                <td class="tableActions">
                    <a href="/recuerdo/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                    <?php if (Auth::user()->rol_id == 1) { ?>
                        <!-- Boton de editar -->
                        <a href="/recuerdo/{{$recuerdo->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
<!-- Boton de eliminar -->
                        <form method="post" action="{{ route('recuerdo.destroy', $recuerdo->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    <?php } ?>
                </td>
                <?php $i++; ?>
            </tr>
            @endforeach


        </table>
    </div>
    <script>
        function confirmar(e) {
            if (!confirm('¿Seguro que desea eliminar este recuerdo?')) {
                e.preventDefault();
            }
        }
    </script>
    @endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush