<?php
require_once 'init.php';

if(isset($_POST['add_category']))
{
    //USER HAS REQUESTED TO ADD A NEW CATEGORY
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('category')->addCategory($_POST);
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, 'There was problem while inserting record, please try again later!');
                Util::redirect('manage-category.php');
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, 'The record have been added successfully!');
                // Util::dd();
                Util::redirect('manage-category.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                Util::redirect('add-category.php');
                break;
        }
    }
}
if(isset($_POST['edit_category']))
{
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('category')->update($_POST, $_POST['category_id']);
        switch($result)
        {
            case EDIT_ERROR:
                Session::setSession(EDIT_ERROR, 'There was problem while editing record, please try again later!');
                Util::redirect('manage-category.php');
                break;
            case EDIT_SUCCESS:
                Session::setSession(EDIT_SUCCESS, 'The record have been updated successfully!');
                // Util::dd();
                Util::redirect('manage-category.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                Util::redirect('manage-category.php');
                break;
        }
    }
}
if(isset($_POST["add_customer"]))
{
    //USER HAS REQUESTED TO ADD A NEW CUSTOMER
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('customer')->addCustomer($_POST);
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "There was problem while inserting record, please try again later!");
                Util::redirect('manage-customer.php');
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "The record have been added successfully!");
                Util::redirect('manage-customer.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                Util::redirect('add-customer.php');
                break;
        }
    }
}
if(isset($_POST["edit_customer"]))
{
    //USER HAS REQUESTED TO ADD A NEW CUSTOMER
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('customer')->editCustomer($_POST);
        switch($result)
        {
            case EDIT_ERROR:
                Session::setSession(EDIT_ERROR, "There was problem while inserting record, please try again later!");
                Util::redirect('manage-customer.php');
                break;
            case EDIT_SUCCESS:
                Session::setSession(EDIT_SUCCESS, "The record have been updated successfully!");
                Util::redirect('manage-customer.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                $id = $_POST['id'];
                Util::redirect('edit-customer.php?id='.$id);
                break;
        }
    }
}
if(isset($_POST["add_supplier"]))
{
    //USER HAS REQUESTED TO ADD A NEW CUSTOMER
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('supplier')->addSupplier($_POST);
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "There was problem while inserting record, please try again later!");
                Util::redirect('manage-supplier.php');
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "The record have been added successfully!");
                Util::redirect('manage-supplier.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                Util::redirect('add-supplier.php');
                break;
        }
    }
}
if(isset($_POST["edit_supplier"]))
{
    //USER HAS REQUESTED TO ADD A NEW CUSTOMER
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('supplier')->editSupplier($_POST);
        switch($result)
        {
            case EDIT_ERROR:
                Session::setSession(EDIT_ERROR, "There was problem while inserting record, please try again later!");
                Util::redirect('manage-supplier.php');
                break;
            case EDIT_SUCCESS:
                Session::setSession(EDIT_SUCCESS, "The record have been updated successfully!");
                Util::redirect('manage-supplier.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                $id = $_POST['id'];
                Util::redirect('edit-supplier.php?id='.$id);
                break;
        }
    }
}
if(isset($_POST["add_employee"]))
{
    //USER HAS REQUESTED TO ADD A NEW CUSTOMER
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('employee')->addEmployee($_POST);
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "There was problem while inserting record, please try again later!");
                Util::redirect('manage-employee.php');
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "The record have been added successfully!");
                Util::redirect('manage-employee.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                Util::redirect('add-employee.php');
                break;
        }
    }
}
if(isset($_POST["edit_employee"]))
{
    //USER HAS REQUESTED TO ADD A NEW CUSTOMER
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('employee')->editEmployee($_POST);
        switch($result)
        {
            case EDIT_ERROR:
                Session::setSession(EDIT_ERROR, "There was problem while inserting record, please try again later!");
                Util::redirect('manage-employee.php');
                break;
            case EDIT_SUCCESS:
                Session::setSession(EDIT_SUCCESS, "The record have been updated successfully!");
                Util::redirect('manage-employee.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, "There was some problem in validating your data at server side!");
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                $id = $_POST['id'];
                Util::redirect('edit-employee.php?id='.$id);
                break;
        }
    }
}

if(isset($_POST['page']))
{
    $search_parameter = $_POST['search']['value'] ?? null;
    $order_by = $_POST['order'] ?? null;
    $start = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];
    if( $_POST['page'] == 'manage_category'){
        $di->get("category")->getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length);
    }else if($_POST['page'] == 'manage_supplier'){
        $di->get("supplier")->getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length);
    }else if($_POST['page'] == 'manage_customer'){
        $di->get("customer")->getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length);
    }else if($_POST['page'] == 'manage_employee'){
        $di->get("employee")->getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length);
    }else if($_POST['page'] == 'manage_product'){
        $di->get("product")->getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length);
    }
}

if(isset($_POST['fetch']) && $_POST['fetch'] == 'category')
{
    // Util::dd($_POST);
    $category_id = $_POST['category_id'];
    $result = $di->get('category')->getCategoryById($category_id, PDO::FETCH_ASSOC);
    echo json_encode($result);
}

if(isset($_POST['delete_category']))
{
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('category')->delete($_POST['record_id']);
        switch($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, 'There was problem while deleting record, please try again later!');
                Util::redirect('manage-category.php');
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, 'The record have been deleted successfully!');
                // Util::dd();
                Util::redirect('manage-category.php');
                break;
        }
    }
}

if(isset($_POST['delete_customer']))
{
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('customer')->delete($_POST['record_id']);
        switch($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, 'There was problem while deleting record, please try again later!');
                Util::redirect('manage-customer.php');
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, 'The record have been deleted successfully!');
                Util::redirect('manage-customer.php');
                break;
        }
    }
}

if(isset($_POST['delete_supplier']))
{
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('supplier')->delete($_POST['record_id']);
        switch($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, 'There was problem while deleting record, please try again later!');
                Util::redirect('manage-supplier.php');
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, 'The record have been deleted successfully!');
                Util::redirect('manage-supplier.php');
                break;
        }
    }
}

if(isset($_POST['delete_employee']))
{
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('employee')->delete($_POST['record_id']);
        switch($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, 'There was problem while deleting record, please try again later!');
                Util::redirect('manage-employee.php');
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, 'The record have been deleted successfully!');
                Util::redirect('manage-employee.php');
                break;
        }
    }
}

if(isset($_POST['delete_product']))
{
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('product')->delete($_POST['record_id']);
        switch($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, 'There was problem while deleting record, please try again later!');
                Util::redirect('manage-product.php');
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, 'The record have been deleted successfully!');
                Util::redirect('manage-product.php');
                break;
        }
    }
}

/****************************************************************
 ****************************PRODUCT MANAGEMENT******************
 ****************************************************************/

if(isset($_POST['add_product']))
{
    //USER HAS REQUESTED TO ADD A NEW CATEGORY
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('product')->addProduct($_POST);
        switch($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, 'There was problem while inserting record, please try again later!');
                Util::redirect('manage-product.php');
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, 'The record have been added successfully!');
                // Util::dd();
                Util::redirect('manage-product.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, 'There was some problem in validating your data at server side!');
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                Util::redirect('add-product.php');
                break;
        }
    }
}

if(isset($_POST['edit_product']))
{
    //USER HAS REQUESTED TO ADD A NEW CATEGORY
    if(isset($_POST['csrf_token']) && Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('product')->editProduct($_POST);
        switch($result)
        {
            case EDIT_ERROR:
                Session::setSession(EDIT_ERROR, 'There was problem while editing record, please try again later!');
                Util::redirect('manage-product.php');
                break;
            case EDIT_SUCCESS:
                Session::setSession(EDIT_SUCCESS, 'The record have been edited successfully!');
                // Util::dd();
                Util::redirect('manage-product.php');
                break;
            case VALIDATION_ERROR:
                Session::setSession(VALIDATION_ERROR, 'There was some problem in validating your data at server side!');
                Session::setSession('errors', serialize($di->get('validator')->errors()));
                Session::setSession('old', $_POST);
                $id = $_POST['id'];
                Util::redirect('edit-product.php?id='.$id);
                break;
        }
    }
}