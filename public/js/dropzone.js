/* Configuración y funciones del dropzone */

Dropzone.autoDiscover = false
document.addEventListener("DOMContentLoaded", function () {

    if (Array.isArray(dropzone_config)){
        dropzone_config.forEach(e => createDropzone(e))
    }
    else{
        createDropzone(dropzone_config)
    }
    
})


function createDropzone(config){

    let customId = "#d"
    let customSubmit = "#guardar"
    let max = 100
    let limit = false
    let ruta = null
    let silenceMode = false
    let previewZone = ".dropzone-previews"

    if (config.form_id) customId = config.form_id
    if (config.submit_id) customSubmit = config.submit_id
    if (config.max) max = config.max
    if (config.limit) limit = config.limit
    if (config.silenceMode) silenceMode = config.silenceMode
    if (config.previewZone) previewZone = config.previewZone
    ruta = config.ruta

    $(customId).dropzone({

        previewsContainer: ".dropzone-previews",
        maxFilesize: 10, //mb
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: (limit) ? '.jpeg,.jpg,.png,.gif': '',
        uploadMultiple: true,
        parallelUploads: 100,
        dictInvalidFileType: "Tipo Inválido",
        dictRemoveFile: "Eliminar archivo",
        dictFileTooBig: "Archivo demasiado grande",
        maxFiles: max,
        previewsContainer: previewZone,
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


            var myDropzone = this
 
            if (!silenceMode){

                function evento (e){
                    const form = document.querySelector(customId)
        
                    e.preventDefault()
                    e.stopPropagation()

                 
                    if (form.checkValidity()) {
    
                        if (myDropzone.getQueuedFiles().length > 0) myDropzone.processQueue();       
                        else  myDropzone._uploadData([{upload: {filename: ''}}],[{filename: '', name: '', data: new Blob()}]);
    
                    }
    
                    form.classList.add('was-validated')
                }
                if (Array.isArray(customSubmit)){
              
                    customSubmit.forEach(e => $(e)[0].addEventListener("click", evento))
                }
                else $(customSubmit)[0].addEventListener("click", evento)
                
                
            }

            


        },
        success: function (file, response) {
            window.location.href = ruta
        },
        
        complete: function (file, response) {
            console.log("Upload Attempt Finished");
        }
    })

}