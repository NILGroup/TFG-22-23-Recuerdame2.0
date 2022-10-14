@extends('layouts.structure')

@section('content')


<form action="/crearSesion" method="POST">
    {{csrf_field()}}
    <div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Datos de la sesión</h5>
            <hr class="lineaTitulo">
        </div>
        <input hidden id="idPaciente" name="paciente_id" value="{{ Session::get('paciente')['id'] }}">
        <input hidden id="idUser" name="user_id" value="{{ $user->id }}">

        <div class="row">
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="" required>
                </div>

                <label for="etapa" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Etapa<span class="asterisco">*</span></label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" name="etapa_id" required>
                        <option disabled selected value>Seleccione una etapa</option>
                        @foreach($etapas as $etapa)
                            <option value="{{$etapa->id}}" >{{$etapa->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <label for="terapeuta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Terapeuta:</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-12">{{$user->nombre}} {{$user->apellidos}}</label>
                    <input hidden id="terapeuta_id" name="terapeuta_id" value="{{$user->id}}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="objetivo" class="form-label col-form-label-sm">Objetivo<span class="asterisco">*</span></label>
            <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>

        <div>
            <div class="mb-3">
                <label for="barreras" class="form-label col-form-label-sm">Barreras</label>
                <textarea class="form-control form-control-sm" id="barreras" name="barreras" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="facilitadores" class="form-label col-form-label-sm">Facilitadores</label>
                <textarea class="form-control form-control-sm" id="facilitadores" name="facilitadores" rows="3"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="pt-4 pb-2">
                <h5 class="text-muted">Recuerdos</h5>
                <hr class="lineaTitulo">
            </div>

            <div class="row">
                <div class="col-12 justify-content-end d-flex p-2">
                    <div class="col-12 justify-content-end d-flex p-2">
                        <!-- Nuevo-->
                        <button type="submit" formaction="/updateAndRecuerdoNuevo" name="guardarSesion" class="btn btn-success btn-sm btn-icon me-2"><i class="fa-solid fa-plus"></i></button>
                        <!-- Existente -->
                        <!-- TODO REDIRIGIR A LA PÁGINA DE CREACION Y NO A LA LISTA DE RECUERDOS -->
                        <button type="submit" formaction="/updateAndSeleccionarRecuerdos" name="guardarSesion" class="btn btn-success btn-sm me-2">Añadir existente</button>
                    </div>
                </div>
            </div>

            <div>
                <table class="table table-bordered">
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

                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 justify-content-end d-flex p-2">
                <!-- TODO REDIRIGIR A SELECCION DE MULTIMEDIA -->
                <a href="#" class="btn btn-success btn-sm">Añadir existente</button></a>
            </div>
        </div>

        <div class="dropzone dropzone-previews dropzone-custom" id="mydropzone">
            <div class="dz-message text-muted" data-dz-message>
                <span>Click aquí o arrastrar y soltar</span>
            </div>
        </div>

        <div id="showMultimedia" class="row pb-2">
            
        </div>

        <div>
            <button type="submit" name="guardarSesion" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
        </div>
    </div>
</form>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush
