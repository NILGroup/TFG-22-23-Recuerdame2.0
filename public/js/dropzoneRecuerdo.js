Dropzone.autoDiscover = false
document.addEventListener("DOMContentLoaded", function () {

    $("#d").dropzone({

        
        maxFilesize: 10, //mb
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: '',
        uploadMultiple: true,
        parallelUploads: 100,
        dictInvalidFileType: "Tipo Inválido",
        dictRemoveFile: "Eliminar archivo",
        dictFileTooBig: "Archivo demasiado grande",
        maxFiles: 100,
        previewsContainer: ".dropzone-previews",
        paramName: "file",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },


        init: function () {


            this.on('maxfilesreached', function() {
                $("#dzp").hide()
                this.removeEventListeners();
            });

            this.on('removedfile', function(){
               
                if (this.files.length < this.options.maxFiles){
                    $("#dzp").show()
                    this.setupEventListeners()
                }
         
            })

            this.on("error", function(file, msg){
                console.log(msg)
            })

            this.on("thumbnail", function(file, dataURL){
                $("#imagen-modal").append($(`<img style="width: 10em;" alt="" src="${dataURL}">`))
            })

            this.on("addedfile", function(file){
                $("#imagen-modal").children().detach()
                $("#modalDescripcion").modal("show")

                let ruta = getRuta({fichero: file.name})
                
                if (!file.type.includes("image")){
                    $("#imagen-modal").append($(`<img style="width: 10em;" alt="" src="${ruta}">`))
                }

                $("#imagen-nombre").text(file.name.slice(0, 20))
                
            })


            var myDropzone = this
 
         

                function evento (e){
                    const form = document.querySelector("#d")
        
                    e.preventDefault()
                    e.stopPropagation()

                 
                    if (form.checkValidity()) {
    
                        if (myDropzone.getQueuedFiles().length > 0) myDropzone.processQueue();       
                        else  myDropzone._uploadData([{upload: {filename: ''}}],[{filename: '', name: '', data: new Blob()}]);
    
                    }
    
                    form.classList.add('was-validated')
                }
                
                
                $("#guardar")[0].addEventListener("click", evento)
                
   

        },
        success: function (file, response) {
            window.location.href = ruta
        },
        
        complete: function (file, response) {
            console.log("Upload Attempt Finished");
        }
    })
    
})


