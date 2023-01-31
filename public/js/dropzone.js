Dropzone.autoDiscover = false
document.addEventListener("DOMContentLoaded", function () {

    if (!max)
        max = 100


    $('#d').dropzone({

        previewsContainer: ".dropzone-previews",
        maxFilesize: 10, //mb
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: '',
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: max,
        paramName: "file",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        init: function () {

            this.on('maxfilesreached', function() {
                $('.dropzone').removeClass('dz-clickable'); 
                $("#dzp").removeClass("dropzone-correct").addClass("dropzone-incorrect")
                $("#dropzone-title").removeClass("dropzone-title-correct").addClass("dropzone-title-incorrect").text("Limite de archivos alcanzado")
                $("#dropzone-img").hide()
                this.removeEventListeners();
            });

            this.on('removedfile', function(){
                $('.dropzone').addClass('dz-clickable'); 
                $("#dzp").addClass("dropzone-correct").removeClass("dropzone-incorrect")
                $("#dropzone-title").addClass("dropzone-title-correct").removeClass("dropzone-title-incorrect").text("Arrastre sus archivos")
                $("#dropzone-img").show()
                this.setupEventListeners()
            })

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