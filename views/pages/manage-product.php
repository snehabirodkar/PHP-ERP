<?php
require_once __DIR__."/../../helper/init.php";
$page_title = "Quick ERP | Manage product";
$sidebarSection = 'product';
$sidebarSubSection = 'manage';
Util::createCSRFToken();

$sidebarTitle = "Quick ERP";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <?php
  require_once __DIR__."/../includes/head-section.php";
  ?>
  <link rel="stylesheet" type="text/css" href="<?=BASEASSETS;?>css/plugins/toastr/toaster.min.css">
  <link rel="stylesheet" type="text/css" href="<?=BASEASSETS;?>vendor/datatables/datatables.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once __DIR__."/../includes/sidebar.php" ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
        <?php require_once __DIR__."/../includes/navbar.php"; ?>

        </nav>
        <!-- End of Topbar -->


        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h1 class="h3 mb-4 text-gray-888">Manage product</h1>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">product</h6>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-responsive" id="manage-product-table">
                <div id="export-buttons"></div>
                <thead>

                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Specification</th>
                    <th>Quantity</th>
                    <th>Selling Rate</th>
                    <th>WEF</th>
                    <th>Category</th>
                    <th>EOQ</th>
                    <th>Danger Level</th>
                    <th>Supplier Names</th>  
                    <th>Actions</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          

          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
      require_once __DIR__."/../includes/footer.php";
      ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php
  require_once __DIR__."/../includes/scroll-to-top.php";
  ?>

  <!-- Logout Modal-->
  

  <?php
  require_once __DIR__."/../includes/core-scripts.php";
  ?>
  <?php
  // require_once __DIR__."/../includes/page-level/index-scripts.php";?>
  <?php
  require_once __DIR__."/../includes/page-level/product/manage-product-scripts.php";
  ?>
  

</body>

</html>