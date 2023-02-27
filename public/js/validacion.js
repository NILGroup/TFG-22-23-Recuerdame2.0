"use strict"

$(function(){


    $(".guardar").each(function(i, e){
        $(e).on("click", function(event){
            let form = $(event.target).parents("form")[0]

            if (!form.checkValidity()){
                event.stopPropagation()
                event.preventDefault()
            }

            form.classList.add('was-validated')
        })
    })



})