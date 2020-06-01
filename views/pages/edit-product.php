<?php
require_once __DIR__ . '/../../helper/init.php';
$pageTitle = "Easy ERP | Edit Product";
$sidebarSection = "product";
$sidebarSubSection = "edit";

if (isset($_GET['id']) && $_GET['id'] != '' && $di->get('database')->exists('products', ["id" => $_GET['id']])) {
    $id = $_GET['id'];
} else {
    Util::redirect("404.html");
}

Util::createCSRFToken();
$errors = "";
if (Session::hasSession('errors')) {
    $errors = unserialize(Session::getSession('errors'));
    Session::unsetSession('errors');
}
$old = $di->get('product')->getProductDetailsById($id);
if (Session::hasSession('old')) {
    $old = Session::getSession('old');
    Session::unsetSession('old');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once __DIR__ . "/../includes/head-section.php";
    ?>

    <!--PLACE TO ADD YOUR CUSTOM CSS-->

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once(__DIR__ . "/../includes/sidebar.php"); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once(__DIR__ . "/../includes/navbar.php"); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product</h1>
                        <a href="<?= BASEPAGES; ?>manage-product.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fa fa-list-ul fa-sm text-white-75"></i> Manage Product
                        </a>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">

                                        <form action="<?= BASEURL; ?>helper/routing.php" method="POST" id="edit-product">
                                            <input type="hidden" name="csrf_token" value="<?= Session::getSession('csrf_token'); ?>">
                                            <input type="hidden" name="id" value="<?= $id; ?>">
                                            <div class="row">
                                                <!--PRODUCT NAME-->
                                                <div class="form-group col-6">
                                                    <label for="name">Product Name</label>
                                                    <input type="text" name="name" id="name" class="form-control <?= $errors != '' && $errors->has('name') ? 'error' : ''; ?>" placeholder="Enter Product Name" value="<?= $old != '' && isset($old['name']) ? $old['name'] : ''; ?>" />
                                                    <?php
                                                    if ($errors != "" && $errors->has('name')) {
                                                        echo "<span class='error'>{$errors->first('name')}</span>";
                                                    }
                                                    ?>
                                                </div>
                                                <!--/PRODUCT NAME-->
                                                <!--SPECIFICATIONS-->
                                                <div class="form-group col-6">
                                                    <label for="specification">Specifications</label>
                                                    <input type="text" name="specification" id="specification" class="form-control <?= $errors != '' && $errors->has('specification') ? 'error' : ''; ?>" placeholder="Enter Product Specifications" value="<?= $old != '' && isset($old['specification']) ? $old['specification'] : ''; ?>" />
                                                    <?php
                                                    if ($errors != "" && $errors->has('specification')) {
                                                        echo "<span class='error'>{$errors->first('specification')}</span>";
                                                    }
                                                    ?>
                                                </div>
                                                <!--/SPECIFICATIONS-->
                                            </div>
                                            <div class="row">
                                                <!--HSN CODE-->
                                                <div class="form-group col-6">
                                                    <label for="hsn_code">HSN Code</label>
                                                    <input type="text" name="hsn_code" id="hsn_code" class="form-control <?= $errors != '' && $errors->has('hsn_code') ? 'error' : ''; ?>" placeholder="Enter HSN Code" value="<?= $old != '' && isset($old['hsn_code']) ? $old['hsn_code'] : ''; ?>" />
                                                    <?php
                                                    if ($errors != "" && $errors->has('hsn_code')) {
                                                        echo "<span class='error'>{$errors->first('hsn_code')}</span>";
                                                    }
                                                    ?>
                                                </div>
                                                <!--/HSN CODE-->

                                                <!-- CATEGORY-->
                                                <div class="form-group col-6">
                                                    <label for="category_id">Category</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        <?php
                                                        $categories = $di->get('database')->readData('category', ["id", "name"], "deleted=0");
                                                        $selected_category_id = $old['category_id'];

                                                        foreach ($categories as $category) {

                                                            if($category->id == $selected_category_id){
                                                                echo "<option value='{$category->id}' selected>{$category->name}</option>";
                                                            }else{
                                                                echo "<option value='{$category->id}'>{$category->name}</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!--/CATEGORY -->

                                            </div>
                                            <div class="row">
                                                <!--SUPPLIERS-->
                                                <div class="form-group col-6">
                                                    <label for="supplier_id">Suppliers</label>
                                                    <select name="supplier_id[]" id="supplier_id" class="form-control" multiple>
                                                        <?php
                                                        $suppliers = $di->get('database')->readData('suppliers', ["id", "first_name", "last_name"], "deleted=0");

                                                        $selected_suppliers = $old["supplier_id"];
                                                        $selected_suppliers = explode(",", $selected_suppliers);

                                                        foreach ($suppliers as $supplier) {
                                                            if(in_array($supplier->id,$selected_suppliers)){
                                                                echo "<option selected value='{$supplier->id}'>{$supplier->first_name} {$supplier->last_name}</option>";
                                                            }else{
                                                                echo "<option value='{$supplier->id}'>{$supplier->first_name} {$supplier->last_name}</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!--/SUPPLIERS-->

                                                <!--EOQ Level-->
                                                <div class="form-group col-6">
                                                    <label for="eoq_level">EOQ Level</label>
                                                    <input type="text" name="eoq_level" id="eoq_level" class="form-control <?= $errors != '' && $errors->has('eoq_level') ? 'error' : ''; ?>" placeholder="Enter Product EOQ Level" value="<?= $old != '' && isset($old['eoq_level']) ? $old['eoq_level'] : ''; ?>" />
                                                    <?php
                                                    if ($errors != "" && $errors->has('eoq_level')) {
                                                        echo "<span class='error'>{$errors->first('eoq_level')}</span>";
                                                    }
                                                    ?>
                                                </div>
                                                <!--/EOQ Level-->
                                            </div>
                                            <div class="row">
                                                <!--Danger Level-->
                                                <div class="form-group col-6">
                                                    <label for="danger_level">Danger Level</label>
                                                    <input type="text" name="danger_level" id="danger_level" class="form-control <?= $errors != '' && $errors->has('danger_level') ? 'error' : ''; ?>" placeholder="Enter Product Danger Level" value="<?= $old != '' && isset($old['danger_level']) ? $old['danger_level'] : ''; ?>" />
                                                    <?php
                                                    if ($errors != "" && $errors->has('danger_level')) {
                                                        echo "<span class='error'>{$errors->first('danger_level')}</span>";
                                                    }
                                                    ?>
                                                </div>
                                                <!--/Danger Level-->

                                                <!--SELLING RATE-->
                                                <div class="form-group col-6">
                                                    <label for="selling_rate">Selling Rate</label>
                                                    <input type="text" name="selling_rate" id="selling_rate" class="form-control <?= $errors != '' && $errors->has('selling_rate') ? 'error' : ''; ?>" placeholder="Enter Product Selling Rate" value="<?= $old != '' && isset($old['selling_rate']) ? $old['selling_rate'] : ''; ?>" />
                                                    <?php
                                                    if ($errors != "" && $errors->has('selling_rate')) {
                                                        echo "<span class='error'>{$errors->first('selling_rate')}</span>";
                                                    }
                                                    ?>
                                                </div>
                                                <!--/SELLING RATE-->
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="edit_product" value="editProduct"><i class="fa fa-bookmark"></i> Save Changes</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php require_once(__DIR__ . "/../includes/footer.php"); ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php
    require_once(__DIR__ . "/../includes/scroll-to-top.php");
    ?>
    <?php require_once(__DIR__ . "/../includes/core-scripts.php"); ?>

    <!--PAGE LEVEL SCRIPTS-->
    <?php require_once(__DIR__ . "/../includes/page-level/product/edit-product-scripts.php"); ?>
</body>

</html>