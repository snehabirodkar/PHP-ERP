<?php

$app = __DIR__;

require_once "$app/../classes/helper_classes/Session.class.php";
require_once "$app/../classes/helper_classes/DependencyInjector.class.php";
require_once "$app/../classes/helper_classes/Config.class.php";
require_once "$app/../classes/helper_classes/Database.class.php";
require_once "$app/../classes/helper_classes/Hash.class.php";
require_once "$app/../classes/helper_classes/ErrorHandler.class.php";
require_once "$app/../classes/helper_classes/Validator.class.php";
require_once "$app/../classes/helper_classes/TokenHandler.class.php";
require_once "$app/../classes/helper_classes/Util.class.php";
// require_once "$app/../classes/helper_classes/MailConfigHelper.class.php";

require_once "$app/../classes/Address.class.php";
require_once "$app/../classes/Category.class.php";
require_once "$app/../classes/Customer.class.php";
require_once "$app/../classes/Supplier.class.php";
require_once "$app/../classes/Employee.class.php";
require_once "$app/../classes/Product.class.php";
?>