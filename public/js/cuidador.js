"use strict"
$(function(){
    $("#guardar").on("click", function(event){
        event.preventDefault();
        event.stopPropagation();
        const form = document.querySelector("#formulario");

        if (!form.checkValidity()){
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')

        console.log("LLEGO");

        //comprobación de si ya se ha registrado el usuario
        var fd = new FormData();
        let email = document.getElementById("email").value;
        console.log(email)
        fd.append('email', email);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: "post",
            url: '/repeatedCuidador',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            data: fd,
            success: function(data) {
                console.log("SUCCESS")
                event.preventDefault();
                event.stopPropagation();
                if(data == true) alert("se ha encontrado el correo")
                if(data == false) alert("el correo es nuevo")
                event.preventDefault();
                event.stopPropagation();
            },
            error: function(data) {
                event.preventDefault();
                event.stopPropagation();
                console.log('Error:', data);
                console.log("SALE MAL");
                
            }
        });
    });
});