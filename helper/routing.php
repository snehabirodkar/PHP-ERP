<?php
require_once 'init.php';
if(isset($_POST['add_category']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('category')->addCategory($_POST);
        
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR,"Add Category Error");
                Util::redirect("manage-category.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS,"Add Category Success");
                Util::redirect("manage-category.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation',"Validation Error");
                Session::setSession('old',$_POST);
                ?>
                <h2>Session Serial</h2>
                <?php
                Session::setSession('errors',serialize($di->get('category')->getValidator()->errors()));//object mai hai ya array hai to text mai store kar sakeee!
                Util::redirect("add-category.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-category.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}
if(isset($_POST['add_customer']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('customer')->addCustomer($_POST);
        
        
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR,"Add Customer Error");
                Util::redirect("manage-customer.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS,"Add customer Success");
                Util::redirect("manage-customer.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation',"Validation Error");
                Session::setSession('old',$_POST);
                ?>
                <h2>Session Serial</h2>
                <?php
                Session::setSession('errors',serialize($di->get('customer')->getValidator()->errors()));//object mai hai ya array hai to text mai store kar sakeee!
                Util::redirect("add-customer.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-customer.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}


if(isset($_POST['page']))
{
    if($_POST['page'] == 'manage_category')
    {
        $dependency = 'category';
    }
    elseif($_POST['page'] == 'manage_customer'){
        
        $dependency = 'customer';
    }
    elseif($_POST['page'] == 'manage_supplier'){
        
        $dependency = 'supplier';
    }
    elseif($_POST['page'] == 'manage_product'){
        
        $dependency = 'product';
    }
    //&_POST['search']['value']
    //&_POST['start']
    //&_POST['length']
    //&_POST['order']
    //&_POST['draw']
    // Util::dd($dependency);
    $search_parameter = $_POST['search']['value'] ?? null;
    $order_by = $_POST['order'] ?? null;
    $start = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];
    
    $di->get($dependency)->getJSONDataForDataTable($draw,$search_parameter,$order_by,$start,$length);
    
}
if(isset($_POST['fetch']))
{
    if($_POST['fetch'] == 'category')
    {
        $category_id = $_POST['category_id'];
        $result = $di->get('category')->getCategoryByID($category_id,PDO::FETCH_ASSOC);
        echo json_encode($result[0]);
    }

    if($_POST['fetch'] == 'customer')
    {
        $customer_id = $_POST['customer_id'];
        $result = $di->get('customer')->getCustomerByID($customer_id, PDO::FETCH_ASSOC);
        echo json_encode($result[0]);
    }

    if($_POST['fetch'] == 'supplier')
    {
        $supplier_id = $_POST['supplier_id'];
        $result = $di->get('supplier')->getSupplierByID($supplier_id, PDO::FETCH_ASSOC);
        echo json_encode($result[0]);
    }
}


if(isset($_POST['editCategory']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('category')->update($_POST,$_POST['category_id']);

        
        switch($result)
        {
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR,"Update Category Error");
                Util::redirect("manage-category.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS,"Update Category Success");
                Util::redirect("manage-category.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation',"Validation Error");
                Session::setSession('old',$_POST);
                Session::setSession('errors',serialize($di->get('category')->getValidator()->errors()));//object mai hai ya array hai to text mai store kar sakeee!
                Util::redirect("manage-category.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-category.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}


if(isset($_POST['editCustomer']))
{
    // Util::dd("isha");
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('customer')->update($_POST,$_POST['id']);

        // Util::dd($result);
        switch($result)
        {
            
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR,"Update Customer Error");
                Util::redirect("edit-customer.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS,"Update Customer Success");
                Util::redirect("manage-customer.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation',"Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors',serialize($di->get('customer')->getValidator()->errors()));//object mai hai ya array hai to text mai store kar sakeee!
                Util::redirect("edit-customer.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-customer.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}



if(isset($_POST['deleteCategory']))
{
    // Util::dd("isha");
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('category')->delete($_POST['record_id']);

        // Util::dd($result);
        switch($result)
        {
            
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR,"Update Category Error");
                Util::redirect("edit-category.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS,"Update Category Success");
                Util::redirect("manage-category.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-category.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}




if(isset($_POST['deleteCustomer']))
{
    // Util::dd("isha");
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('customer')->delete($_POST['record_id']);

        // Util::dd($result);
        switch($result)
        {
            
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR,"Update customer Error");
                Util::redirect("edit-customer.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS,"Update customer Success");
                Util::redirect("manage-customer.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-customer.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}


if(isset($_POST['add_supplier']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('supplier')->addSupplier($_POST);
        
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR,"Add supplier Error");
                Util::redirect("manage-supplier.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS,"Add supplier Success");
                Util::redirect("manage-supplier.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation',"Validation Error");
                Session::setSession('old',$_POST);
                ?>
                <h2>Session Serial</h2>
                <?php
                Session::setSession('errors',serialize($di->get('supplier')->getValidator()->errors()));//object mai hai ya array hai to text mai store kar sakeee!
                Util::redirect("add-supplier.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-customer.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}

if(isset($_POST['editSupplier']))
{
    // Util::dd("isha");
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('supplier')->update($_POST,$_POST['id']);

        // Util::dd($result);
        switch($result)
        {
            
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR,"Update supplier Error");
                Util::redirect("edit-supplier.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS,"Update supplier Success");
                Util::redirect("manage-supplier.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation',"Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors',serialize($di->get('supplier')->getValidator()->errors()));//object mai hai ya array hai to text mai store kar sakeee!
                Util::redirect("edit-supplier.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-supplier.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}



if(isset($_POST['deleteCategory']))
{
    // Util::dd("isha");
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('category')->delete($_POST['record_id']);

        // Util::dd($result);
        switch($result)
        {
            
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR,"Update Category Error");
                Util::redirect("edit-category.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS,"Update Category Success");
                Util::redirect("manage-category.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-category.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}


if(isset($_POST['deleteSupplier']))
{
    // Util::dd("isha");
    if(Util::verifyCSRFToken($_POST))
    {
        
        $result = $di->get('supplier')->delete($_POST['record_id']);

        // Util::dd($result);
        switch($result)
        {
            
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR,"Update supplier Error");
                Util::redirect("edit-supplier.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS,"Update supplier Success");
                Util::redirect("manage-supplier.php");
                break;
        }
    }else{
        //errorpage 
        Session::setSession("csrf","CSRF ERROR");
        Util::redirect("manage-supplier.php");//Need to change this, actually we be redirecting to some error page indicating Unauthorized access.

    }
}
?>