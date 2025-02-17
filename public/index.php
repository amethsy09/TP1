<?php
define("WEBROOT", "http://mouhamed.sy.ecole221.sn:8000/?");
require_once "../model.php";

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if ($controller=="clients") {
        require_once "../controllers/clients.controller.php";
   
    }elseif ($controller=="commandes") {
        require_once "../controllers/commandes.controller.php";

    }
}else{
    require_once "../controllers/clients.controller.php";

}