<div style="height:100px;">
</div>
<footer class="mt-auto text-end">
    <a id="scrollBtn"href="#"><i class="fa-solid fa-circle-arrow-up mx-3 mb-2 scrollUp"></i></button>
    <div class="p-2 bg-secondary text-lg-start">
        <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a>
        <?php echo date('Y'); ?> Recuérdame 2.0
    </div>
</footer>
<script>
// Get the button
let mybutton = document.getElementById("scrollBtn");
mybutton.style.display = "none";
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollHider()};

function scrollHider() {
    console.log(document.documentElement.scrollTop);
  if (document.documentElement.scrollTop > 300) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
</script>