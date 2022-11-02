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
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
</script>

