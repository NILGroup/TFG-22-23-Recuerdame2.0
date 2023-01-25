Dropzone.autoDiscover = false
document.addEventListener("DOMContentLoaded", function() {
    
    $().ready(function() {
        $("#d").validate({
            rules: {
                nombre: { required: true},
                apellidos: { required: true},
                ocupacion: { required: true},
                email: { required: true, email: true},
                localidad: { required: true},
                contacto: { required: true}
            },
            errorClass: 'contactFormTextError',
            errorPlacement: function(error, element) {
                // Don't show error
            },  
        });
    });


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