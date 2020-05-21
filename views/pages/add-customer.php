<?php
require_once __DIR__."/../../helper/init.php";
$page_title ="Quick ERP | ADD Customer";
    $sidebarSection = 'customer';
    $sidebarSubSection = 'add';
    Util::createCSRFToken();
  $errors="";
  $old="";
  if(Session::hasSession('old'))
  {
    $old = Session::getSession('old');
    Session::unsetSession('old');
  }
  if(Session::hasSession('errors'))
  {
    $errors = unserialize(Session::getSession('errors'));
    Session::unsetSession('errors');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
    require_once __DIR__."/../includes/head-section.php";
  ?>
  

</head>

<body id="page-top">
  <style>.m-10{margin:10px 0;}</style>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once __DIR__."/../includes/sidebar.php"; ?>
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

        <!-- Begin Page Content-->
        
        <!-- Page Heading -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Add Customer</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-list-ul fa-sm text-white"></i>Manage Customer</a>
            </div>
        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card show mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fa fa-plus"></i>Add Customer
                            </h6>
                        </div>
                        <!--END OF CARD HEADER-->

                        <!--CARD BODY-->
                        <div class="card-body">
                          <form id="add-customer" action="<?= BASEURL?>helper/routing.php" method="POST">
                            <input type="hidden"
                              name="csrf_token"
                              value="<?= Session::getSession('csrf_token');?>">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="row">
                                  <div class="col-md-6 m-10">
                                  <label for="fisrt_name">First Name</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('first_name') ? 'error is-invalid' : '') : '';?>"
                                    name="first_name"
                                    id="first_name"  
                                    placeholder="Enter First Name"
                                    value="<?= $old != '' ?$old['first_name']: '';?>"
                                  >

                                  <?php
                                if($errors!="" && $errors->has('first_name')):
                                  echo "<span class='error'> {$errors->first('first_name')}</span>";endif;
                                  ?>
                                  </div>
<br>
                                <div class="col-md-6 m-10">
                                  <label for="last_name">Last Name</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('last_name') ? 'error is-invalid' : '') : '';?>"
                                    name="last_name"
                                    id="last_name"  
                                    placeholder="Enter Last Name"
                                    value="<?= $old != '' ?$old['last_name']: '';?>"
                                  >

                                  <?php 
                                    if($errors!="" && $errors->has('last_name')):
                                        echo "<span class='error'> {$errors->first('last_name')}</span>";
                                    endif;
                                  ?>
                                </div>

                                 <br><br>
                                 <div class="col-md-6 m-10">
                                  <label for="gst_no">GST NO</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('gst_no') ? 'error is-invalid' : '') : '';?>"
                                    name="gst_no"
                                    id="gst_no"  
                                    placeholder="Enter GST NO."
                                    value="<?= $old != '' ?$old['gst_no']: '';?>"
                                  >

                                  <?php                                  
                                  if($errors!="" && $errors->has('gst_no')):
                                    echo "<span class='error'> {$errors->first('gst_no')}</span>";
                                  endif;
                                  
                                  ?>
                                 </div>
<br>
                                <div class="col-md-6 m-10">       
                                  <label for="phone_no">Phone</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('phone_no') ? 'error is-invalid' : '') : '';?>"
                                    name="phone_no"
                                    id="phone_no"  
                                    placeholder="Enter Phone Number"
                                    value="<?= $old != '' ?$old['phone_no']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('phone_no')):
                                        echo "<span class='error'> {$errors->first('phone_no')}</span>";
                                     endif;
                                  ?>
                                </div>

<br>                              
                                <div class="col-md-6 m-10">       
                                <label for="email_id">Email Id</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('email_id') ? 'error is-invalid' : '') : '';?>"
                                    name="email_id"
                                    id="email_id"  
                                    placeholder="Enter Email"
                                    value="<?= $old != '' ?$old['email_id']: '';?>"
                                  >
                                  <?php 
                                     if($errors!="" && $errors->has('email_id')):
                                        echo "<span class='error'> {$errors->first('email_id')}</span>";
                                     endif;
                                  ?>
                                </div>

<br>
                                  <div class="col-md-6 m-10">       
                                  <label for="gender">Gender</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('gender') ? 'error is-invalid' : '') : '';?>"
                                    name="gender"
                                    id="gender"  
                                    placeholder="Enter Gender"
                                    value="<?= $old != '' ?$old['gender']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('gender')):
                                        echo "<span class='error'> {$errors->first('gender')}</span>";
                                     endif;
                                  ?>
                                  </div>
<br>
                                  <h2 class="col-md-12 m-10">Address</h2>
                                  <div class="col-md-6 m-10">       
                                  <label for="block_no">Block No.</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('block_no') ? 'error is-invalid' : '') : '';?>"
                                    name="block_no"
                                    id="block_no"  
                                    placeholder="Enter block_no"
                                    value="<?= $old != '' ?$old['block_no']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('block_no')):
                                        echo "<span class='error'> {$errors->first('block_no')}</span>";
                                     endif;
                                  ?>
                                  </div>
<br>
                                  <div class="col-md-6 m-10">       
                                  <label for="street">Street</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('street') ? 'error is-invalid' : '') : '';?>"
                                    name="street"
                                    id="street"  
                                    placeholder="Enter street"
                                    value="<?= $old != '' ?$old['street']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('street')):
                                        echo "<span class='error'> {$errors->first('street')}</span>";
                                     endif;
                                  ?>
                                  </div>
<br>
                                  <div class="col-md-6 m-10">       
                                  <label for="city">City</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('city') ? 'error is-invalid' : '') : '';?>"
                                    name="city"
                                    id="city"  
                                    placeholder="Enter city"
                                    value="<?= $old != '' ?$old['city']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('city')):
                                        echo "<span class='error'> {$errors->first('city')}</span>";
                                     endif;
                                  ?>
                                  </div>
<br>
                                  <div class="col-md-6 m-10">       
                                  <label for="pincode">Pincode</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('pincode') ? 'error is-invalid' : '') : '';?>"
                                    name="pincode"
                                    id="pincode"  
                                    placeholder="Enter pincode"
                                    value="<?= $old != '' ?$old['pincode']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('pincode')):
                                        echo "<span class='error'> {$errors->first('pincode')}</span>";
                                     endif;
                                  ?>
                                  </div>
<br>

                                  <div class="col-md-6 m-10">       
                                  <label for="state">State</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('state') ? 'error is-invalid' : '') : '';?>"
                                    name="state"
                                    id="state"  
                                    placeholder="Enter state"
                                    value="<?= $old != '' ?$old['state']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('state')):
                                        echo "<span class='error'> {$errors->first('state')}</span>";
                                     endif;
                                  ?>
                                  </div>
<br>
                                  <div class="col-md-6 m-10">       
                                  <label for="country">Country</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('country') ? 'error is-invalid' : '') : '';?>"
                                    name="country"
                                    id="country"  
                                    placeholder="Enter country"
                                    value="<?= $old != '' ?$old['country']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('country')):
                                        echo "<span class='error'> {$errors->first('country')}</span>";
                                     endif;
                                  ?>
                                  </div>

                                  <div class="col-md-6 m-10">       
                                  <label for="town">Town</label>
                                  <input type="text" 
                                    class="form-control <?= $errors!= '' ? ($errors->has('town') ? 'error is-invalid' : '') : '';?>"
                                    name="town"
                                    id="town"  
                                    placeholder="Enter town"
                                    value="<?= $old != '' ?$old['town']: '';?>"
                                  >

                                  <?php 
                                     if($errors!="" && $errors->has('town')):
                                        echo "<span class='error'> {$errors->first('town')}</span>";
                                     endif;
                                  ?>
                                  </div>
                                </div>
                                </div>
                              </div>
                            </div>
                            
                            <input type="submit" class="btn btn-primary" name="add_customer" value="submit">
                            
                          </form>
                        </div>
                        <!--END OF CARD BODY-->
                    </div>
                </div>
            </div>
        </div>
      <!-- End of Main Content -->
</div>
      <!-- Footer -->
      <?php require_once __DIR__."/../includes/footer.php"; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  
  <?php require_once __DIR__."/../includes/scroll-to-top.php"; ?>
  <?php require_once __DIR__."/../includes/core-scripts.php"; ?>

  <?php require_once __DIR__."/../includes/page-level/index-scripts.php"; ?>
  <script src="<?=BASEASSETS?>js/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?=BASEASSETS?>js/pages/customer/add-customer.js"></script>


</body>

</html>