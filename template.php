<?php
require_once __DIR__."/../../helper/init.php";
$pageTitle = "";
$sidebarSection = "";
$sidebarSubSection = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php 
  require_once __DIR__."/../includes/head-section.php";
  ?>

  <!-- PLACE TO ADD YOUR CUSTOM CSS -->
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    require_once __DIR__."/../includes/sidebar.php";
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php
        require_once __DIR__."/../includes/navbar.php";
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php
      require_once __DIR__."/../includes/footer.php";
      ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php
  require_once __DIR__."/../includes/scroll-to-top.php";
  ?>

  <?php
  require_once __DIR__."/../includes/core-scripts.php";
  ?>

</body>

</html>
