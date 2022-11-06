<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>
  function confirmar(e) {
      if (!confirm('¿Seguro que desea eliminar?')) {
          e.preventDefault();
      }
  }
</script>

<script>
  // Get the button
  let mybutton = document.getElementById("scrollBtn");
  mybutton.style.display = "none";
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollHider()};

  function scrollHider() {
    if (document.documentElement.scrollTop > 300) {
      mybutton.style.display = "inline";
    } else {
      mybutton.style.display = "none";
    }
  }

  //multiple seleccion con checkbox en generar Historia de vida
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

const array = [];
function onSelect(string) {
  var select = document.getElementById("seleccionado");
  const index = array.indexOf(string);
  if (index > -1) { // only splice array when item is found
  array.splice(index, 1); // 2nd parameter means remove one item only
  }else  array.push(string);
  
  select.textContent= array;
  //select.textContent= select.textContent+ ' ' + string;
}


</script>

