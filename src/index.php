<?php
namespace App;

function load_classphp($directory) {
    if(is_dir($directory)) {
        $scan = scandir($directory);
        unset($scan[0], $scan[1]); //unset . and ..
        foreach($scan as $file) {
            if(is_dir($directory."/".$file)) {
                load_classphp($directory."/".$file);
            } else {
                if(strpos($file, '.php') !== false) {
                    include_once($directory."/".$file);
                }
            }
        }
    }
}

load_classphp('./');

$route_map = new Kernel\RouteMap();
$route_map->addRouteMap("/login", Controller\AdminController::class, "login");
$route_map->addRouteMap("/classview", Controller\StudentController::class, "classview");
$route_map->addRouteMap("/assignment", Controller\StudentController::class, "assignment");
$route_map->addRouteMap("/attendance", Controller\StudentController::class, "attendance");
$router = new Kernel\Router();
$router->solve($_SERVER['REQUEST_URI'], $route_map);
?>