// Get the button
var mybuttonn = document.getElementById("scrollBtn");
mybuttonn.style.display = "none";
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
  scrollHider()
};

function scrollHider() {
  //console.log("scrollTop= " + document.body.scrollTop + "Element = "+ document.documentElement.scrollTop);
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 300) {
    mybuttonn.style.display = "inline";
  } else {
    mybuttonn.style.display = "none";
  }
}

//Funcion que no sirve de nada?
function toTopFunction() {
  document.documentElement.scrollTop = 0;
  document.body.scrollTop = 0;
}

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});