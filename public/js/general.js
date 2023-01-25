// Get the button
let mybutton = document.getElementById("scrollBtn");
mybutton.style.display = "none";
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
  scrollHider()
};

function scrollHider() {
  //console.log("scrollTop= " + document.body.scrollTop + "Element = "+ document.documentElement.scrollTop);
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 300) {
    mybutton.style.display = "inline";
  } else {
    mybutton.style.display = "none";
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