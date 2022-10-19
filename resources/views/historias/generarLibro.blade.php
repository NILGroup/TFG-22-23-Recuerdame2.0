@extends('layouts.structure')

@section('content')

<div class="container-fluid" style="height: 75%">
    <?php
    if ($listaRecuerdos == null || empty($listaRecuerdos) || $listaRecuerdos=='[]') {
    ?>
    <div class="carousel-inner container pt-4 pb-4">
        <div class="hv-box p-4">
            <span class="align-middle text-muted">No se han encontrado recuerdos para esos filtros.</span>
        </div>
    </div>
    <?php
        } else {   
        ?>
            <h1 value="{{$listaRecuerdos}}">{{$listaRecuerdos}}</h1>
            <!--<div id="carouselPrincipal" style="height: 85%" class="carousel carousel-dark slide" data-bs-interval="false" data-bs-ride="carousel">
                <div class="carousel-inner container pt-4">
                    <div class="hv-box p-4">
                        <!?php
                        $i = 1;
                        $totalRecuerdos = count($listaRecuerdos);  ?>
                        
                    </div>
                </div>
            </div>-->
        <?php
        } 
        ?>
</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush