@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$paciente->nombre}}" disabled>
                {{csrf_field()}}

            </div>
        </div>
        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="apellidos" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$paciente->apellidos}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="genero" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <select id="genero" name="genero" class="form-control form-select form-select-sm" disabled>
                    @foreach($generos as $genero)
                        <option value="{{$genero->id}}" @if($genero->id == $paciente->genero_id) selected @endif>{{$genero->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nacionalidad </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" value="{{$paciente->nacionalidad}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <input type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha" value="{{$paciente->fecha_nacimiento}}"disabled>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="lugarNacimiento" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Lugar de nacimiento </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="lugar_nacimiento" class="form-control form-control-sm" id="lugarNacimiento" value="{{$paciente->lugar_nacimiento}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Estado civil </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <select id="estado" name="estado_id" class="form-control form-select form-select-sm" disabled>
                    @foreach($situaciones as $situacion)
                        <option value="{{$situacion->id}}" @if($situacion->id == $paciente->situacion_id) selected @endif>{{$situacion->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$paciente->ocupacion}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="fecha_inscripcion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de inscripción </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <input type="date" name="fecha_inscripcion" class="form-control form-control-sm" id="fecha_inscipcion" value="{{$paciente->fecha_inscripcion}}" disabled>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="estudios" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nivel de estudios </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <select id="estudios" name="estudio_id" class="form-control form-select form-select-sm" disabled>
                    @foreach($estudios as $estudio)
                        <option value="{{$estudio->id}}" @if($estudio->id == $paciente->estudio_id) selected @endif>{{$estudio->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="residencia" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de residencia </label>
            
            <div class="col-sm-12 col-md-12 col-lg-6">
                <select id="residencia" name="tipo_residencia" class="form-control form-select form-select-sm" disabled>
                    @foreach($residencias as $residencia)
                        <option value="{{$residencia->id}}" @if($residencia->id == $paciente->residencia_id) selected @endif>{{$residencia->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="casa" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Dirección del domicilio </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" value="{{$paciente->residencia_actual}}" disabled>
            </div>
        </div>
    </div>



    <!--DESPLEGABLES-->

    <div class="accordion"> 
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

    <div class="accordion"> 
        <div class="accordion-item accordion-header" id="cuidadores1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cuidadores" aria-expanded="true" aria-controls="cuidadores">
                <div class="w-100">
                    <h5 class="text-muted text-start">Listado de cuidadores</h5>
                </div>
            </button>
            
            <div id="cuidadores" class="accordion-collapse collapse show" aria-labelledby="cuidadores1">
                <div class="row mb-2">
                    <div class="col-12 justify-content-end d-flex">
                        <a href="/cuidadores/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
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

    <div class="accordion"> 
        <div class="accordion-item accordion-header" id="personasrelacionadas1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#personasrelacionadas" aria-expanded="true" aria-controls="personasrelacionadas">
                <div class="w-100">
                    <h5 class="text-muted text-start">Listado de personas relacionadas</h5>
                </div>
            </button>
            
            <div id="personasrelacionadas" class="accordion-collapse collapse show" aria-labelledby="personasrelacionadas1">
                <div class="row mb-2">
                    <div class="col-12 justify-content-end d-flex">
                        <a href="/pacientes/{{$paciente->id}}/crearPersona"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
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
    <div class="col-12">
        <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</div>

@endsection

@push('scripts')

<script>
    function confirmar(e) {
        if (!confirm('¿Seguro que desea eliminar esta sesión?')) {
            e.preventDefault();
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
<script>
    $(document).ready(function () {
        $('#tabla1').DataTable({
            paging: false,
            info: false,
            language: { 
                search: "_INPUT_",
                searchPlaceholder: "Buscar...",
                emptyTable: "No hay datos disponibles"
            },
            responsive: {
                details: {
                type: 'column',
                target: 'tr'
                }
            },
            dom : "<'row' <'form-control-sm mr-5' f>>"
        });

        $('#tabla2').DataTable({
            paging: false,
            info: false,
            language: { 
                search: "_INPUT_",
                searchPlaceholder: "Buscar...",
                emptyTable: "No hay datos disponibles"
            },
            responsive: {
                details: {
                type: 'column',
                target: 'tr'
                }
            },
            dom : "<'row' <'form-control-sm mr-5' f>>"
        });

        $('#tabla3').DataTable({
            paging: false,
            info: false,
            language: { 
                search: "_INPUT_",
                searchPlaceholder: "Buscar...",
                emptyTable: "No hay datos disponibles"
            },
            responsive: {
                details: {
                type: 'column',
                target: 'tr'
                }
            },
            dom : "<'row' <'form-control-sm mr-5' f>>"
        });
    });
</script>

@endpush