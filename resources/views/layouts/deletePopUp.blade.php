@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush

<template id="borrado" class="d-inline">
  <swal-title> </swal-title>
  <swal-html>
    <b class="d-inline"> Borrado satisfactoriamente</b> 
    <button type="button" data-cancel onclick="Swal.clickDeny()" class="btn btn-secondary swal2-cancel d-inline">Deshacer</button>
 </swal-html>

  <swal-param name="allowEscapeKey" value="false" />
  <swal-function-param name="didOpen" value="popup => console.log(popup)" />
</template>
