"use strict"

$(function(){
    $("#guardar").on("click", function(event){
        

        const form = document.querySelector("#formulario")

        if (!form.checkValidity()){
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
       
    })
})