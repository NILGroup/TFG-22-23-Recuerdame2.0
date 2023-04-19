@if(Auth::user()->rol_id == 1)
<div class="accordion mb-2 shadow-sm"> 
    <div class="accordion-item accordion-header" id="diagnostico1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#diagnostico" aria-expanded="true" aria-controls="diagnostico">
            <div class="w-100">
                <h5 class="text-muted text-start">Diagnóstico del usuario</h5>
            </div>
        </button>
        
        <div id="diagnostico" class="tabla accordion-collapse collapse show" aria-labelledby="diagnostico1">
            @include('diagnostico.listaItems')
            @include('diagnostico.charts')
        </div>
    </div>
</div>  
<div class="accordion mb-2 shadow-sm"> 
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
                    <a href="/usuarios/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>
            <table id="tabla" class="table table-bordered table-striped datatable">
                <caption>Listado de informes de seguimiento</caption>
                <thead>
                    <tr >
                        <th class="fit10 text-center" scope="col">Informe</th>
                        <th class="fit10 text-center" scope="col">Sesiones desde el anterior</th>
                        <th class=" text-center" scope="col">Diagnóstico</th>
                        <th class="fit10 text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="shadow-sm">
                    @foreach ($evaluaciones as $informe)
                    <tr>
                        <td data-sort="{{ strtotime($informe->fecha) }}"><a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver">Informe {{date("d/m/Y", strtotime($informe->fecha))}}</td>
                        <td>{{$informe->numSesiones}}</td>
                        <td>{{$informe->diagnostico}}</td>
                        <td class="tableActions">
                            <a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver informe"></i></a>
                            <a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar informe"></i></a>
                            <a href="/usuarios/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe"><i class="fa-solid fa-print text-success tableIcon" data-toggle="tooltip" data-placement="top" title="Vista de impresión del informe"></i></a>
                            <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar informe"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>  
@endif

<div class="accordion mb-2 shadow-sm"> 
    <div class="accordion-item accordion-header" id="cuidadores1">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cuidadores" aria-expanded="true" aria-controls="cuidadores">
            <div class="w-100">
                <h5 class="text-muted text-start">Listado de personas cuidadoras</h5>
            </div>
        </button>
        
        <div id="cuidadores" class="accordion-collapse collapse show" aria-labelledby="cuidadores1">
            <div class="d-flex justify-content-between upper">
                @include('layouts.tableSearcher')
                <div class="justify-content-end d-flex">
                    <a href="/usuarios/{{$paciente->id}}/cuidadores/crear"><button type="button" class="btn btn-success mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>
            <table id="tabla-cuidadores" class="table table-bordered table-striped table-responsive datatable">
                <caption>Listado de personas cuidadoras</caption>
                <thead>
                    <tr class="busqueda">
                        <th class="fit10 text-center" scope="col">Nombre</th>
                        <th class="fit10 text-center" scope="col">Correo electrónico</th>
                        <th class="fit5 text-center" scope="col">Teléfono</th>
                        <th class="fit5 text-center" scope="col">Localidad</th>
                        <th class="fit5 text-center" scope="col">Parentesco</th>
                        <th class="fit10 actions text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="shadow-sm">
                    @foreach($cuidadores as $cuidador)
                    <tr>
                        <td><a href="/usuarios/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"> {{$cuidador->nombre}} {{$cuidador->apellidos}} </a></td>
                        <td>{{$cuidador->email}}</td>
                        <td>{{$cuidador->telefono}}</td>
                        <td>{{$cuidador->localidad}}</td>
                        <td>{{$cuidador->parentesco}}</td>
                        <td class="tableActions">
                            <a href="/usuarios/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver los datos del cuidador"></i></a>
                            <a href="/usuarios/{{$paciente->id}}/cuidadores/{{$cuidador->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar cuidador"></i></a>
                            <form method="post" action="{{ route('cuidadores.destroy', $cuidador->id) }}" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar cuidador"></i></button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>  

<div class="accordion mb-2 shadow-sm"> 
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
                    <a href="/usuarios/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success mt-2 mx-2"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>
            <table id="tabla" class="table table-bordered table-striped table-responsive datatable">
                <caption>Listado de personas relacionadas</caption>
                <thead>
                    <tr >
                        <th class="fit15 text-center" scope="col">Nombre</th>
                        <th class="fit10 text-center" scope="col">Localidad</th>
                        <th class="fit10 text-center" scope="col">Tipo de relación</th>
                        <th class="fit10 actions text-center" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="shadow-sm">
                    @foreach($personas as $persona)
                    <tr>
                        <td><a href="/usuarios/{{$paciente->id}}/personas/{{$persona->id}}">{{$persona->nombre}} {{$persona->apellidos}}</a> @if($persona->contacto)★@endif</td>
                        <td>{{$persona->localidad}}</td>
                        <td>{{$persona->tiporelacion->nombre}}</td>
                        <td class="tableActions">
                            <a href="/usuarios/{{$paciente->id}}/personas/{{$persona->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver datos de la persona"></i></a>
                            <a href="/usuarios/{{$paciente->id}}/personas/{{$persona->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar persona"></i></a>
                            <form method="post" action="{{ route('personas.destroy', $persona->id) }}" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" title="Eliminar persona"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>