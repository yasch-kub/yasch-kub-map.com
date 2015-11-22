<?php
define('root',dirname(__FILE__));
require_once(root.'/application/components/autoload.php');
place_model::getAllPlace();
$router = new Router();
$router->run();
?>

