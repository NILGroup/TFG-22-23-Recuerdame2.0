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