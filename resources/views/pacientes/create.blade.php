@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear paciente</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0"  style="border:none !important; background-color: #00000000;" id="pacienteForm" method="post" action="/pacientes">
        {{csrf_field()}}

        <div style="padding: 20px;">
            @include('pacientes.listaItems')
            <div style="border: 1px solid #868e96;" class="dz-default dz-message" id="dzp">
                <div class="container" style="height: 10em;">
                    <h2 style="color: #868e96;">Arrastre sus archivos</h1>
                </div>
            </div>
            <div class="dropzone-previews">

            </div>
        </div>

        <div class="col-12">
            <button id="guardar" type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        $().ready(function() {
            $("#pacienteForm").validate({
                rules: {
                    nombre: { required: true},
                },
                errorClass: 'contactFormTextError',
                errorPlacement: function(error, element) {
                    // Don't show error
                },
            });
        });


        Dropzone.autoDiscover = false

        $('#pacienteForm').dropzone({

            previewsContainer: ".dropzone-previews",
            maxFilesize: 10, //mb
            addRemoveLinks: true,
            autoProcessQueue: false,
            acceptedFiles: '',
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function() {

                var submitBtn = document.querySelector("#guardar");
                var myDropzone = this

                submitBtn.addEventListener("click", function(e) {

                    if ($("#pacienteForm").valid()) {

                        e.preventDefault();
                        e.stopPropagation();

                        if (myDropzone.files.length > 0) {
                            myDropzone.processQueue();
                        } else {
                            $("#pacienteForm").submit()
                        }

                    }


                });
            },
            success: function(file, response) {
                //No le manda los archivos al controlador
                window.location.href = "/pacientes";
            },
            error: function(file, xhr, formData) {
                console.log("Upload Attempt Error - " + formData.status + " " + formData.statusText);
            },
            complete: function(file, response) {
                console.log("Upload Attempt Finished");
            }



        });

    })
</script>
@endsection

@push('scripts')
@include('layouts.scripts')
<script>
    function especifiqueResidencia() {
        let select = document.getElementById("residencia")
        if (select.value === "5") {
            //console.log($("#fecha_inscipcion").show())
        } else {
            //console.log($("#fecha_inscipcion").hide())
            //$("#fecha_inscripcion").hide()
        }
        if (select.value === "6") {
            $("#residencia_custom").show()
        } else {
            $("#residencia_custom").hide()
        }
    }
</script>
@endpush