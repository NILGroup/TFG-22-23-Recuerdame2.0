Dropzone.autoDiscover = false
document.addEventListener("DOMContentLoaded", function () {

    


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
        init: function () {

            var submitBtn = document.querySelector("#guardar");
            var myDropzone = this

            submitBtn.addEventListener("click", function (e) {

                
                const form = document.querySelector("#d")

                e.preventDefault()
                e.stopPropagation()
                console.log(form.checkValidity())
                if (form.checkValidity()) {
                    
                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    }
                    else {
                        console.log("hola")
                        myDropzone._uploadData([{upload: {filename: ''}}],[{filename: '', name: '', data: new Blob()}]);
                    }

                }

            

                form.classList.add('was-validated')


            });


        },
        success: function (file, response) {
            window.location.href = ruta
        },
        error: function (file, xhr, formData) {
            console.log("Upload Attempt Error - " + formData.status + " " + formData.statusText);
        },
        complete: function (file, response) {
            console.log("Upload Attempt Finished");
        }
    });
})