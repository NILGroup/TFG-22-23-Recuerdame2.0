
@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear nueva persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0" style="border:none !important; background-color: #00000000;" id="d" method="post" action="/crearPersona">
        {{csrf_field()}}
        
            <div style="padding: 20px;">
                @include('personasrelacionadas.listaItems')
                <div style="border: 1px solid #868e96;" class="dz-default dz-message" id="dzp">
                    <div class="container" style="height: 10em;">
                        <h2 style="color: #868e96;">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">
                    
                </div>
            </div>
        
        <div class="form-group">
            <button id="guardar"  type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/{{$idPaciente}}/personas"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
        
</div>
<script>

document.addEventListener("DOMContentLoaded", function() {


    $().ready(function() {
	$("#d").validate({
		rules: {
			nombre: { required: true},
            apellidos: { required: true},
            ocupacion: { required: true},
            email: { required: true, email: true},
            localidad: { required: true},
            contacto: { required: true},
		},
		errorClass: 'contactFormTextError',
        errorPlacement: function(error, element) {
            // Don't show error
        },
	});
});


    Dropzone.autoDiscover = false

    $('#d').dropzone({

        previewsContainer: ".dropzone-previews",
        maxFilesize: 10, //mb
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: '',
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        paramName: "file",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        init: function(){
            
            var submitBtn = document.querySelector("#guardar");
            var myDropzone = this

            submitBtn.addEventListener("click", function(e){
               
                if ($("#d").valid()){

                    e.preventDefault();
                    e.stopPropagation();

                    if (myDropzone.files.length > 0) {                        
                        myDropzone.processQueue();  
                    } 
                    else {    
                        $("#d").submit()
                    } 

                }
                 
                   
            });
         },
        success: function (file, response) {
            //No le manda los archivos al controlador
            let id = document.getElementById("paciente_id").value;
            window.location.href = "/pacientes/"+id+"/personas";
        },
        error: function (file, xhr, formData) {
            console.log("Upload Attempt Error - " + formData.status + " " + formData.statusText);
        },
        complete: function (file, response) {
            console.log("Upload Attempt Finished");
        }
        
        

    });

})


</script>
  

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script>
        function especifique(){
            let select = document.getElementById("tiporelacion_id")
            if (select.value === "7"){
                $("#tipo_custom").show()
            }
            else{
                $("#tipo_custom").hide()
            }
        }
    </script>
@endpush