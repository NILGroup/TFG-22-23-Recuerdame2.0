/* Todo lo relacionado al botón de scroll up */


$(() => {
  var mybuttonn = document.getElementById("scrollBtn");
  mybuttonn.style.display = "none";

  window.onscroll = function () {
    scrollHider()
  };

  function scrollHider() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 300) {
      mybuttonn.style.display = "inline";
    } else {
      mybuttonn.style.display = "none";
    }
  }

});


//Funcion que no sirve de nada?
function toTopFunction() {
  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
});