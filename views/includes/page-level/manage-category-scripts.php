
<script src ="<?=BASEASSETS?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?=BASEASSETS?>vendor/datatables/jquery.dataTables.js"></script>
<script src="<?=BASEASSETS?>vendor/datatables/dataTables.min.js"></script>
<script src="<?=BASEASSETS?>js/pages/category/manage-category.js"></script>

<script>

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

<?php

    if(Session::hasSession(ADD_SUCCESS)):
?>
    toastr.success("New Category has been Added Succesfully!!","Added");

<?php
    Session::unsetSession(ADD_SUCCESS);
    elseif(Session::hasSession(ADD_ERROR)):
?>

toastr.error("Adding new Category Faild!!","Failed");

<?php
    Session::unsetSession(ADD_ERROR);
    elseif(Session::hasSession('csrf')):
?>

toastr.error("Unauthorized Access, Token Mismatch","Unauthorized Access");

<?php
Session::unsetSession('csrf');
    endif;
?>

</script>