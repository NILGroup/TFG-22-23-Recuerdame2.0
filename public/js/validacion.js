"use strict"

$(function(){

    $("#guardar").on("click", function(event){

        let form = document.querySelector("#formulario")

        if (!form.checkValidity()){
            event.stopPropagation()
            event.preventDefault()
        }

        form.classList.add('was-validated')

    })


})