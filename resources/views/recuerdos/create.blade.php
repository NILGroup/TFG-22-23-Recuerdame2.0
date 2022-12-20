@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form class="dropzone p-0"  style="border:none !important; background-color: #00000000;" id="recuerdoForm" method="post" action="/recuerdo"  >
        {{csrf_field()}}

        <div style="padding: 20px;">
                @include('recuerdos.listaItems')
                <div style="border: 1px solid #868e96;" class="dz-default dz-message" id="dzp">
                    <div class="container" style="height: 10em;">
                        <h2 style="color: #868e96;">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">


                </div>
        </div>

        <div class="col-12 ">
            <button id="guardar" type="submit" value="Guardar" class="btn btn-outline-primary btn">Guardar</button>
            <a href="/pacientes/{{$paciente->id}}/recuerdos"><button type="button" class="btn btn-primary btn">Atrás</button></a>
        </div>
    </form>
</div>

@include('recuerdos.models')
<script>

document.addEventListener("DOMContentLoaded", function() {

    $().ready(function() {
	$("#recuerdoForm").validate({
		rules: {
			nombre: { required: true},
            fecha: { required: true},
            idEtapa: { required: true}
		},
		errorClass: 'contactFormTextError',
        errorPlacement: function(error, element) {
            // Don't show error
        },
	});
});


    Dropzone.autoDiscover = false

    $('#recuerdoForm').dropzone({

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
               
                if ($("#recuerdoForm").valid()){

                    e.preventDefault();
                    e.stopPropagation();

                    if (myDropzone.files.length > 0) {                        
                        myDropzone.processQueue();  
                    } 
                    else {    
                        $("#recuerdoForm").submit()
                    } 

                }
                 
                   
            });
         },
        success: function (file, response) {
            //No le manda los archivos al controlador
            let id = document.getElementById("paciente_id").value;
            window.location.href = "/pacientes/"+id+"/recuerdos";
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

@push('styles')
<link rel="stylesheet" href="/css/slider.css">
@endpush

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script>
        $(document).ready(function () {
            $('#tabla').DataTable({
                paging: false,
                info: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });
        });
    </script>
   
@endpush