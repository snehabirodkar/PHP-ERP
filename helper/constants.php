<?php

define('BASEURL',$di->get('config')->get('base_url'));
define('BASEASSETS',BASEURL."assets/");
define('BASEPAGES',BASEURL."views/pages/");

define("ADD_SUCCESS", "add success");
define("ADD_ERROR", "add error");
define("VALIDATION_ERROR", "validation error");