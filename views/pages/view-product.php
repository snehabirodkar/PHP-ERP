<?php
require_once __DIR__ . "/../../helper/init.php";
$pageTitle = "Easy ERP | View Product";
$sidebarSection = "product";
$sidebarSubSection = "view";

if (isset($_GET['id']) && $_GET['id'] != '' && $di->get('database')->exists('products', ["id" => $_GET['id']])) {
  $id = $_GET['id'];
} else {
  Util::redirect("404.html");
}

$data = $di->get('product')->getProductDetailsById($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  require_once __DIR__ . "/../includes/head-section.php";
  ?>

  <!-- PLACE TO ADD YOUR CUSTOM CSS -->
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    require_once __DIR__ . "/../includes/sidebar.php";
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php
        require_once __DIR__ . "/../includes/navbar.php";
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
          </div>

          <!-- Basic Card Example -->
          <form action="<?= BASEPAGES; ?>edit-product.php?id=<?= $id ?>" method="POST" id="view-product">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mt-2 font-weight-bold text-primary">View Product</h6>
                  </div>

                  <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary" name="edit_product" value="editCustomer"><i class="fa fa-pencil-alt"></i> Edit</button>
                    <button type="button" class="btn btn-danger" name="delete_product" value="deleteCustomer" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">

                      <input type="hidden" name="id" value="<?= $id; ?>">
                      <div class="row">
                        <!-- PRODUCT NAME -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="name">Product Name</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="name" class="form-control <?= $errors != '' && $errors->has("name") ? 'error' : '' ?>" value="<?= $data != '' && isset($data["name"]) ? $data["name"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/PRODUCT NAME -->

                        <!-- SPECIFICATION -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="specification">Specifications</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="specification" class="form-control <?= $errors != '' && $errors->has("specification") ? 'error' : '' ?>" value="<?= $data != '' && isset($data["specification"]) ? $data["specification"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/SPECIFICATION -->

                        <!-- CATEGORY NAME -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="category_name">Category Name</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="category_name" class="form-control <?= $errors != '' && $errors->has("category_name") ? 'error' : ''; ?>" value="<?= $data != '' && isset($data["category_name"]) ? $data["category_name"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/CATEGORY NAME -->

                        <!-- HSN CODE -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="hsn_code">HSN Code</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="hsn_code" class="form-control <?= $errors != '' && $errors->has('hsn_code') ? 'error' : ''; ?>"value="<?= $data != '' && isset($data["hsn_code"]) ? $data["hsn_code"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/HSN CODE -->

                        <!-- EOQ LEVEL -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="eoq_level">EOQ Level</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="eoq_level" class="form-control <?= $errors != '' && $errors->has('eoq_level') ? 'error' : ''; ?>" value="<?= $data != '' && isset($data['eoq_level']) ? $data['eoq_level'] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/EOQ LEVEL -->

                        <!-- DANGER LEVEL -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="danger_level">Danger Level</label>
                              </div>
                              <div class="col-md-9">
                              <input readonly type="text" name="danger_level" class="form-control <?= $errors != '' && $errors->has('danger_level') ? 'error' : ''; ?>" value="<?= $data != '' && isset($data['danger_level']) ? $data['danger_level'] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/DANGER LEVEL -->

                        <!-- SELLING RATE -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="selling_rate">Selling Rate</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="selling_rate" class="form-control <?= $errors != '' && $errors->has("selling_rate") ? 'error' : '' ?>" value="<?= $data != '' && isset($data["selling_rate"]) ? $data["selling_rate"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/SELLING RATE -->

                        <!-- WITH EFFECT FROM -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="with_effect_from">With Effect From</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="with_effect_from" class="form-control <?= $errors != '' && $errors->has("with_effect_from") ? 'error' : '' ?>" value="<?= $data != '' && isset($data["with_effect_from"]) ? $data["with_effect_from"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/WITH EFFECT FROM -->

                        <!-- SUPPLIERS -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="supplier_name">Suppliers</label>
                              </div>
                              <div class="col-md-9">
                                <textarea readonly type="text" name="supplier_name" class="form-control <?= $errors != '' && $errors->has("supplier_name") ? 'error' : '' ?>" rows="5"><?= $data != '' && isset($data["supplier_name"]) ? $data["supplier_name"] : ''; ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/SUPPLIERS -->

                        <!-- QUANTITY -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="quantity">Quantity</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="quantity" class="form-control <?= $errors != '' && $errors->has("quantity") ? 'error' : '' ?>" value="<?= $data != '' && isset($data["quantity"]) ? $data["quantity"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/QUANTITY -->

                       
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.container-fluid -->
              </div>
            </div>
          </form>
          <!-- End of Main Content -->

          <?php
          require_once __DIR__ . "/../includes/footer.php";
          ?>

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!--DELETE MODAL-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= BASEURL; ?>helper/routing.php" method="POST">
              <div class="modal-body">
                <input type="hidden" name="csrf_token" id="csrf_token" value="<?= Session::getSession('csrf_token'); ?>">
                <input type="hidden" name="record_id" id="record_id" value="<?= $id; ?>">
                <p>Are you sure you want to delete this record?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" name="delete_product">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--/DELETE MODAL-->
      <?php
      require_once __DIR__ . "/../includes/scroll-to-top.php";
      ?>

      <?php
      require_once __DIR__ . "/../includes/core-scripts.php";
      ?>


</body>

</html>