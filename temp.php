<?php

require_once "helper\init.php";

// $config = new Config();

// echo $config->get("port");

// $db = new Database($di);

// print_r($db->readData("suppliers", ["first_name", "last_name"]));

// $db->delete("suppliers", "1");

// $data = [
//     "first_name" => "Vignesh"
// ];

// $db->update("suppliers", $data, "id = '1'")

// echo $db->exists("suppliers", $data);

echo $di->get("util")->redirect("demo.php");

?>

<?php
require_once __DIR__ . '/../../helper/init.php';
$pageTitle = "Easy ERP | Manage Category";
$sidebarSection = "category";
$sidebarSubSection = "manage";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php  require_once __DIR__ . "/../includes/head-section.php"; ?>
  <!--PLACE TO ADD YOUR CUSTOM CSS-->
  <link rel="stylesheet" href="<?=BASEASSETS;?>vendor/toastr/toastr.min.css">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php require_once(__DIR__. "/../includes/sidebar.php");?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php require_once(__DIR__. "/../includes/navbar.php");?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <a href="<?= BASEPAGES;?>add-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
              <i class="fa fa-plus fa-sm text-white-75"></i> Add Category
            </a>
          </div>
          <!--
          
          YOUR
          ACTUAL
          UI
          CODE
          GOES
          HERE

          -->

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require_once(__DIR__. "/../includes/footer.php");?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->


  <?php
  require_once(__DIR__ . "/../includes/scroll-to-top.php");
  ?>
  <?php require_once(__DIR__."/../includes/core-scripts.php");?>
  <!--PAGE LEVEL SCRIPTS-->
  <?php require_once(__DIR__."/../includes/page-level/category/manage-category-scripts.php");?>


</body>
