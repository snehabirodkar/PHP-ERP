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
if(isset($_POST['page']))
{
    //Util::dd($_POST);
    $search_parameter = $_POST['search']['value'] ?? null;
    $order_by = $_POST['order'] ?? null;
    $start = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];
    $di->get('category')->getJSONDataForDataTable($draw,$search_parameter,$order_by,$start,$length);
}
?>