<div>
    <input type="hidden" class="form-control form-control-sm" id="fecha" name="id" value="{{$evaluacion->id}}">
    <input type="hidden" class="form-control form-control-sm" id="id" name="paciente_id" value="{{$paciente->id}}">
    <div class="d-flex flex-row justify-content-start  align-items-center" >
        <label for="fecha" class=" form-label col-form-label negrita">Fecha:<span class="asterisco">*</span></label>
        <div class="col p-2" >
            <input type="date" style="width: fit-content;" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$evaluacion->fecha}}" required>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="diagnostico" class="form-label col-form-label negrita">Diagnostico:<span class="asterisco">*</span></label>
        <textarea class="form-control form-control-sm" id="diagnostico" name="diagnostico" rows="3" required >{{$evaluacion->diagnostico}}</textarea>
    </div>

    <div class="mb-3">
        <label for="observaciones" class="form-label col-form-label negrita">Observaciones:</label>
        <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3" >{{$evaluacion->observaciones}}</textarea>
    </div>

    <div class="row ">
        <label for="escalas" class="form-label col-form-label col-sm-3 col-md-2 col-lg-2"><b>Escalas:</b></label>
        <div><hr class="w-50 mt-0"></div>
    </div>
    <div class="row">
        <label for="escala" class="form-label col col-form-label-sm col-sm-2 col-md-2 col-lg-2"><b>Escala</b></label>
        <label for="valor" class="form-label col col-form-label-sm col-sm-2 col-md-2 col-lg-2"><b>Valor</b></label>
        <label for="fecha" class="form-label col col-form-label-sm col-sm-2 col-md-2 col-lg-2"><b>Fecha</b></label>
    </div>
    <div class="row">
        <label for="GDS" class="col form-label col-form-label-sm col-sm-2 col-md-2 col-lg-2" style="min-width: 100px;">GDS</label>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <input type="number" min="1" max="7" class="form-control form-control-sm gds" id="gds" name="gds" value="{{$evaluacion->gds}}">
        </div>
        <div class="col col-sm-3 col-md-2 col-lg-2">
            <input type="date" class="form-control form-control-sm gds" id="gds_fecha" name="gds_fecha" value="{{$evaluacion->gds_fecha}}">
        </div>
    </div>
    <div class="row">
        <label for="Mental" class="col form-label col-form-label-sm col-sm-2 col-md-2 col-lg-2" style="min-width: 100px;">Mini mental/MEC de Lobo</label>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <input type="number" min="0" max="25" class="form-control form-control-sm mental" id="mental" name="mental" value="{{$evaluacion->mental}}">
        </div>
        <div class="col col-sm-3 col-md-2 col-lg-2">
            <input type="date" class="form-control form-control-sm mental" id="mental_fecha" name="mental_fecha" value="{{$evaluacion->mental_fecha}}">
        </div>
    </div>
    <div class="row mb-3">
        <label for="CDR" class="col form-label col-form-label-sm col-sm-2 col-md-2 col-lg-2" style="min-width: 100px;">CDR</span></label>
        <div class="col col-sm-2 col-md-2 col-lg-2">
            <input type="number" min="0" max="3" class="form-control form-control-sm nombre_escala" id="cdr" name="cdr" value="{{$evaluacion->cdr}}">
        </div>
        <div class="col col-sm-3 col-md-2 col-lg-2">
            <input type="date" class="form-control form-control-sm" id="cdr_fecha" name="cdr_fecha" value="{{$evaluacion->cdr_fecha}}">
        </div>
    </div>
    @if(!$show || !is_null($evaluacion->nombre_escala))
        <div class="row d-inline m-0">
            <hr class="w-50 m-0">
        </div>
        <div class="row mt-3">
            <label for="escala" class="form-label col col-form-label-sm col-sm-2 col-md-2 col-lg-2"><b>Escala personalizada</b></label>
            <label for="valor" class="form-label col col-form-label-sm col-sm-2 col-md-2 col-lg-2"><b>Valor</b></label>
            <label for="fecha" class="form-label col col-form-label-sm col-sm-2 col-md-2 col-lg-2"><b>Fecha</b></label>
        </div>
        <div class="row">
            <div class="col col-sm-2 col-md-2 col-lg-2">
                    <input type="text" class="col form-control form-control-sm escalaPersonalizada" name="nombre_escala" value="{{$evaluacion->nombre_escala}}">
            </div>
            <div class="col col-sm-2 col-md-2 col-lg-2">
                    <input type="number" class="col form-control form-control-sm escalaPersonalizada" name="escala" value="{{$evaluacion->escala}}">
            </div>
            <div class="col col-sm-3 col-md-2 col-lg-2">
                <input type="date" class=" form-control form-control-sm escalaPersonalizada" name="fecha_escala" value="{{$evaluacion->fecha_escala}}">
            </div>
        </div>
        <div class="row mb-3"></div>
    @endif
</div>