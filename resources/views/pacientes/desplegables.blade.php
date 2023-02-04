<div class="accordion mb-2"> 
    <div class="accordion-item accordion-header" id="evaluaciones1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#evaluaciones" aria-expanded="true" aria-controls="evaluaciones">
            <div class="w-100">
                <h5 class="text-muted text-start">Listado de informes de seguimiento</h5>
            </div>
        </button>
        
        <div id="evaluaciones" class="tabla accordion-collapse collapse show" aria-labelledby="evaluaciones1">
            <div class="d-flex justify-content-between upper">
                @include('layouts.tableSearcher')
                <div class="justify-content-end d-flex">
                    <a href="/pacientes/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>
            <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
                <caption>Listado de informes de seguimiento</caption>
                <thead>
                    <tr class="bg-primary">
                        <th class="fit15" scope="col">Informe</th>
                        <th class="" scope="col">Sesiones desde la última evaluación</th>
                        <th scope="col">Diagnóstico</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluaciones as $informe)
                    <tr>
                        <td><a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe">Informe {{Carbon\Carbon::parse($informe->fecha)->format("d/m/Y")}}</td>
                        <td>{{$informe->numSesiones}}</td>
                        <td>{{$informe->diagnostico}}</td>
                        <td class="tableActions">
                            <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                            </form>
                        </td>
                    </tr>
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
            <div class="d-flex justify-content-between upper">
                @include('layouts.tableSearcher')
                <div class="justify-content-end d-flex">
                    <a href="/pacientes/{{$paciente->id}}/cuidadores/crear"><button type="button" class="btn btn-success mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>

            <div>
                <table id="tabla2" class="table table-bordered table-striped table-responsive datatable">
                    <thead>
                        <tr class="bg-primary">
                            <th class="fit5" scope="col">Nombre</th>
                            <th class="fit10" scope="col">Apellidos</th>
                            <th scope="col">Correo electrónico</th>
                            <th class="fit10" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cuidadores as $cuidador)
                        <tr>
                            <td>{{$cuidador->nombre}}</td>
                            <td>{{$cuidador->apellidos}}</td>
                            <td>{{$cuidador->email}}</td>
                            <td class="tableActions">
                                <form method="post" action="{{ route('cuidadores.destroy', $cuidador->id) }}" style="display:inline!important;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                                </form>
                            </td>
                        </tr>

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
            <div class="d-flex justify-content-between upper">
                @include('layouts.tableSearcher')
                <div class="justify-content-end d-flex">
                    <a href="/pacientes/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>

            <div>
                <table id="tabla3" class="table table-bordered table-striped table-responsive datatable">
                    <thead>
                        <tr class="bg-primary">
                            <th class="fit5" scope="col">Nombre</th>
                            <th class="fit10" scope="col">Apellidos</th>
                            <th scope="col">Tipo de Relacion</th>
                            <th class="fit10" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personas as $persona)
                        <tr>
                            <td>{{$persona->nombre}}</td>
                            <td>{{$persona->apellidos}}</td>
                            <td>{{$persona->tiporelacion->nombre}}</td>
                            <td class="tableActions">
                                <a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                <a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                                <form method="post" action="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}" style="display:inline!important;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
