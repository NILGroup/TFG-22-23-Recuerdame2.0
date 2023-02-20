
<input id="id" type="hidden" class="form-control form-control-sm @error('nombre') is-invalid @enderror" placeholder="Nombre" name="id" value="{{ $cuidador->id }}" required autocomplete="nombre" autofocus>
<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="nick" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-6">Nombre:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6 align-items-center">
            <input id="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" placeholder="Nombre" name="nombre" value="{{ $cuidador->nombre }}" required autocomplete="nombre" autofocus>
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="apellidos" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-4">Apellidos:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8 align-items-center">
            <input id="apellidos" type="text" class="form-control form-control-sm @error('apellidos') is-invalid @enderror" placeholder="Apellidos" name="apellidos" value="{{ $cuidador->apellidos }}" required autocomplete="apellidos" autofocus>
        </div>
    </div>
</div>
<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="telefono" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-6">Teléfono:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6 align-items-center">
            <input id="telefono" type="text" class="form-control form-control-sm @error('telefono') is-invalid @enderror" placeholder="Número de teléfono" name="telefono" value="{{ $cuidador->telefono }}"required autocomplete="telefono" autofocus>

         
        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="localidad" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-4">Localidad:</label>
        <div class="col-sm-12 col-md-12 col-lg-8 align-items-center">
            <input id="localidad" type="text" class="form-control form-control-sm" placeholder="Localidad de residencia" name="localidad" value="{{ $cuidador->localidad }}" autocomplete="localidad" autofocus>
        </div>
    </div>
</div>
<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="fecha" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-6">Correo:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6 align-items-center">
            <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ $cuidador->email }}" required autocomplete="email" autofocus>
        </div>
    </div>
    <div class="row col-sm-6 col-md-6 col-lg-7 align-items-center">
        <label for="parentesco" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-4">Parentesco:</label>
        <div class="col-sm-7 col-md-7 col-lg-8 align-items-center">
            <select class="form-select form-select-sm" id="parentesco" name="parentesco">
                <option value=""></option>
                <option value="Primer grado" @if($cuidador->parentesco == "Primer grado") selected @endif >Primer Grado</option>
                <option value="Segundo grado" @if($cuidador->parentesco == "Segundo grado") selected @endif >Segundo Grado</option>
                <option value="Tercer grado" @if($cuidador->parentesco == "Tercer grado") selected @endif >Tercer Grado</option>
                <option value="Cuarto grado" @if($cuidador->parentesco == "Cuarto grado") selected @endif >Cuarto Grado</option>
                <option value="Quinto grado" @if($cuidador->parentesco == "Quinto grado") selected @endif >Quinto Grado</option>
                <option value="Sexto grado" @if($cuidador->parentesco == "Sexto grado") selected @endif >Sexto Grado</option>
            </select>
        </div>
    </div>
    
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="terapeuta" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-6">Paciente:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6 align-items-center">
            <select class="form-select form-select-sm" id="paciente" name="paciente" required>
                <option value=""></option>
                @foreach($pacientes as $p)
                <option value="{{$p->id}}" @if(!is_null($paciente) && $paciente->id == $p->id) selected @endif>
                    {{$p->nombre}} {{$p->apellido}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    @if(str_contains(url()->current(), 'crear'))
    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="pais" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-4">Contraseña:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8 align-items-center">
            <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">
        </div>
    </div>
    @endif
</div>
<input id="rol" type="hidden" name="rol" value=2 required autocomplete="apellidos" autofocus>
