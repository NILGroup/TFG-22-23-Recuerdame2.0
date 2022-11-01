<div class="accordion mb-2"> 
    <div class="accordion-item accordion-header" id="evaluaciones1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#evaluaciones" aria-expanded="true" aria-controls="evaluaciones">
            <div class="w-100">
                <h5 class="text-muted text-start">Listado de informes de seguimiento</h5>
            </div>
        </button>
        
        <div id="evaluaciones" class="accordion-collapse collapse show" aria-labelledby="evaluaciones1">
            <div class="row mb-2">
                <div class="col-12 justify-content-end d-flex">
                    <a href="/pacientes/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success btn-sm btn-icon mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>
            <table id="tabla1" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr class="bg-primary">
                        <th scope="col">#</th>
                        <th scope="col">Informe</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Diagnóstico</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($evaluaciones as $informe)
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe">Informe Nº {{$informe->id}}</td>
                        <td>{{$informe->fecha}}</td>
                        <td>{{$informe->diagnostico}}</td>
                        <td class="tableActions">
                            <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>  

<div class="accordion mb-2"> 
    <div class="accordion-item accordion-header" id="cuidadores1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cuidadores" aria-expanded="true" aria-controls="cuidadores">
            <div class="w-100">
                <h5 class="text-muted text-start">Listado de cuidadores</h5>
            </div>
        </button>
        
        <div id="cuidadores" class="accordion-collapse collapse show" aria-labelledby="cuidadores1">
            <div class="row mb-2">
                <div class="col-12 justify-content-end d-flex">
                    <a href="/cuidadores/crear"><button type="button" class="btn btn-success btn-sm btn-icon mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>

            <div>
                <table id="tabla2" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($cuidadores as $cuidador)
                        <tr>
                            <th scope="row"><?php echo $i ?></th>

                            <td>{{$cuidador->nombre}}</td>
                            <td>{{$cuidador->apellidos}}</td>
                            <td>{{$cuidador->email}}</td>

                            <td class="tableActions">
                                <form method="post" action="{{ route('cuidadores.destroy', $cuidador->id) }}" style="display:inline!important;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  

<div class="accordion mb-2"> 
    <div class="accordion-item accordion-header" id="personasrelacionadas1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#personasrelacionadas" aria-expanded="true" aria-controls="personasrelacionadas">
            <div class="w-100">
                <h5 class="text-muted text-start">Listado de personas relacionadas</h5>
            </div>
        </button>
        
        <div id="personasrelacionadas" class="accordion-collapse collapse show" aria-labelledby="personasrelacionadas1">
            <div class="row mb-2">
                <div class="col-12 justify-content-end d-flex">
                    <a href="/pacientes/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success btn-sm btn-icon  mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>

            <div>
                <table id="tabla3" class="table table-bordered table-striped table-responsive">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>