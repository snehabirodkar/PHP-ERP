<?php
require_once __DIR__ . "/../../helper/init.php";
$pageTitle = "Easy ERP | View Supplier";
$sidebarSection = "supplier";
$sidebarSubSection = "view";

if (isset($_GET['id']) && $_GET['id'] != '' && $di->get('database')->exists('suppliers', ["id" => $_GET['id']])) {
  $id = $_GET['id'];
} else {
  Util::redirect("404.html");
}

$data = $di->get('supplier')->getSupplierDetailsById($id);

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
            <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
          </div>

          <!-- Basic Card Example -->
          <form action="<?= BASEPAGES; ?>edit-supplier.php?id=<?= $id ?>" method="POST" id="view-supplier">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="mt-2 font-weight-bold text-primary">View Supplier</h6>
                  </div>

                  <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary" name="edit_supplier" value="editSupplier"><i class="fa fa-pencil-alt"></i> Edit</button>
                    <button type="button" class="btn btn-danger" name="delete_supplier" value="deleteSupplier" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">

                      <input type="hidden" name="id" value="<?= $id; ?>">
                      <div class="row">
                        <!-- FIRST NAME -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="first_name">First Name</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="first_name" class="form-control <?= $errors != '' && $errors->has("first_name") ? 'error' : '' ?>" placeholder="Enter First Name" value="<?= $data != '' && isset($data["first_name"]) ? $data["first_name"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/FIRST NAME -->

                        <!-- LAST NAME -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="last_name">Last Name</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="last_name" class="form-control <?= $errors != '' && $errors->has("last_name") ? 'error' : '' ?>" placeholder="Enter Last Name" value="<?= $data != '' && isset($data["last_name"]) ? $data["last_name"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/LAST NAME -->

                        <!-- GST NO -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="gst_no">GST No</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="gst_no" class="form-control <?= $errors != '' && $errors->has("gst_no") ? 'error' : ''; ?>" placeholder="Enter GST Number" value="<?= $data != '' && isset($data["gst_no"]) ? $data["gst_no"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/GST NO -->

                        <!-- PHONE NO -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="phone_no">Phone No</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="phone_no" class="form-control <?= $errors != '' && $errors->has('phone_no') ? 'error' : ''; ?>" placeholder="Enter Phone Number" value="<?= $data != '' && isset($data["phone_no"]) ? $data["phone_no"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/PHONE NO -->

                        <!-- EMAIL ID -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="email_id">Email Id</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="email" name="email_id" class="form-control <?= $errors != '' && $errors->has('email_id') ? 'error' : ''; ?>" placeholder="Enter Email ID" value="<?= $data != '' && isset($data['email_id']) ? $data['email_id'] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/EMAIL ID -->

                        <!-- COMPANY NAME -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="company_name">First Name</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="company_name" class="form-control <?= $errors != '' && $errors->has("company_name") ? 'error' : '' ?>" placeholder="Enter First Name" value="<?= $data != '' && isset($data["company_name"]) ? $data["company_name"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/COMPANY NAME -->

                        <!-- BLOCK NO -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="block_no">Block Number</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="block_no" class="form-control <?= $errors != '' && $errors->has("block_no") ? 'error' : '' ?>" placeholder="Enter Block Number" value="<?= $data != '' && isset($data["block_no"]) ? $data["block_no"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/BLOCK NO -->

                        <!-- STREET -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="street">Street</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="street" class="form-control <?= $errors != '' && $errors->has("street") ? 'error' : '' ?>" placeholder="Enter Street" value="<?= $data != '' && isset($data["street"]) ? $data["street"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/STREET -->

                        <!-- TOWN -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="town">Town</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="town" class="form-control <?= $errors != '' && $errors->has("town") ? 'error' : '' ?>" placeholder="Enter Town" value="<?= $data != '' && isset($data["town"]) ? $data["town"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/TOWN -->

                        <!-- CITY -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="city">City</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="city" class="form-control <?= $errors != '' && $errors->has("city") ? 'error' : '' ?>" placeholder="Enter City" value="<?= $data != '' && isset($data["city"]) ? $data["city"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/CITY -->

                        <!-- PINCODE -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="pincode">Pincode</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="pincode" class="form-control <?= $errors != '' && $errors->has("pincode") ? 'error' : '' ?>" placeholder="Enter Pincode" value="<?= $data != '' && isset($data["pincode"]) ? $data["pincode"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/PINCODE -->

                        <!-- STATE -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="state">State</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="state" class="form-control <?= $errors != '' && $errors->has("state") ? 'error' : '' ?>" placeholder="Enter State" value="<?= $data != '' && isset($data["state"]) ? $data["state"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/STATE -->

                        <!-- COUNTRY -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="country">Country</label>
                              </div>
                              <div class="col-md-9">
                                <input readonly type="text" name="country" class="form-control <?= $errors != '' && $errors->has("country") ? 'error' : '' ?>" placeholder="Enter Country" value="<?= $data != '' && isset($data["country"]) ? $data["country"] : ''; ?>" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/COUNTRY -->
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
                <button type="submit" class="btn btn-danger" name="delete_supplier">Delete</button>
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