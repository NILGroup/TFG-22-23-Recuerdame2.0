/*function setValue() {
    const
        newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
        newPosition = 10 - (newValue * 0.2);
    rangeV.innerHTML = `<span>${range.value}</span>`;
    rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
};
const
    range = document.getElementById('puntuacion'),
    rangeV = document.getElementById('rangeV');
document.addEventListener("DOMContentLoaded", setValue);
range.addEventListener('input', setValue); */

var slider = document.getElementById("puntuacion");
var output = document.getElementById("demo-puntuacion");
var style = document.querySelector('[data="test"]');


//output.innerHTML = slider.value;
setData(slider.value);

slider.oninput = function () {
    //output.innerHTML = this.value;
    setData(slider.value);
}



function setData(x) {
  /*  var declaration = document.styleSheets[6].cssRules[0].style;
    var setprop = declaration.setProperty("background", "yellow", "important");*/

    /*!!!!NO TOCAAAAAAAAAAAAAAAAAAAAAAAAAAR!!!!!!!!!!!!!!!!!!!!!!!!!
    stylesheet=6 (si cambia structure cambiará) */
    var declaration = document.styleSheets[5].cssRules[1].style;
    if(x==0){
        var setprop = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/0.png)", "important");
    }else if(x==1){
        var setprop1 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/1.png)", "important");
    }else if(x==2){
        var setprop2 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/2.png)", "important");
    }else if(x==3){
        var setprop3 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/3.png)", "important");
    }else if(x==4){
        var setprop4 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/4.png)", "important");
    }else if(x==5){
        var setprop5 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/5.png)", "important");
    }else if(x==6){
        var setprop6 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/6.png)", "important");
    }else if(x==7){
        var setprop7 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/7.png)", "important");
    }else if(x==8){
        var setprop8 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/8.png)", "important");
    }else if(x==9){
        var setprop9 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/9.png)", "important");
    }else {
        var setprop10 = declaration.setProperty("--webkit-slider-thumb-background", "url(../img/10.png)", "important");
    }
    
    
    
    
    
    
   
    //var prueba = document.getElementById("#pruebaa");
    //alert(prueba)
    //.style.setProperty("background-color", "yellow", "important");
    //document.getElementById("#puntuacion").style.setProperty('--webkit-slider-thumb-background', url(..\img\2.png));
    //style.innerHTML = ".slider::-webkit-slider-thumb { background: url(../img/2.png) !important;  }";


}