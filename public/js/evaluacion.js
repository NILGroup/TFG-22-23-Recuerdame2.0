$('.escalaPersonalizada').change(function (){
    var nombreEscala = document.getElementById('nombre_escala').value, 
        escala = document.getElementById('escala').value;
    if((nombreEscala == null && escala == null) || (nombreEscala == "" && escala == "") ){
        document.getElementById('nombre_escala').required = false;
        escala = document.getElementById('escala').required = false;
        fechaEscala = document.getElementById('fecha_escala').required = false;
    }
    else{
        document.getElementById('nombre_escala').required = true;
        escala = document.getElementById('escala').required = true;
        fechaEscala = document.getElementById('fecha_escala').required = true;
    }
});
$('.gds').change(function (){
    var nombreEscala = document.getElementById('gds').value
    if(nombreEscala == null || nombreEscala == ""){
        escala = document.getElementById('gds').required = false;
        fechaEscala = document.getElementById('gds_fecha').required = false;
    }
    else{
        escala = document.getElementById('gds').required = true;
        fechaEscala = document.getElementById('gds_fecha').required = true;
    }
});

$('.mental').change(function (){
    var nombreEscala = document.getElementById('mental').value
    if(nombreEscala == null || nombreEscala == ""){
        escala = document.getElementById('mental').required = false;
        fechaEscala = document.getElementById('mental_fecha').required = false;
    }
    else{
        escala = document.getElementById('mental').required = true;
        fechaEscala = document.getElementById('mental_fecha').required = true;
    }
});

$('.cdr').change(function (){
    var nombreEscala = document.getElementById('mental').value
    if(nombreEscala == null || nombreEscala == ""){
        escala = document.getElementById('cdr').required = false;
        fechaEscala = document.getElementById('cdr_fecha').required = false;
    }
    else{
        escala = document.getElementById('cdr').required = true;
        fechaEscala = document.getElementById('cdr_fecha').required = true;
    }
});

$(document).ready(function () {
    $("input[type='number']").each(function(){
        if($(this).attr("max")){
            var v =  "/ " + $(this).attr('max');
            if(v.length < 4){
                v = v+"  "
            }
            $(this).TouchSpin({
                buttondown_class:"hidden",
                buttonup_class:"hidden",
                postfix: v
            });
        }
        
    })
});