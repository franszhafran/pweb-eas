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
// Admin
$route_map->addRouteMap("/login", Controller\AdminController::class, "login");
$route_map->addRouteMap("/studentcreate", Controller\AdminController::class, "studentcreate");
$route_map->addRouteMap("/studentmanage", Controller\AdminController::class, "studentManage");

// Student
$route_map->addRouteMap("/classview", Controller\StudentController::class, "classview");
$route_map->addRouteMap("/create_student", Controller\AdminController::class, "createStudent");
$route_map->addRouteMap("/assignment", Controller\StudentController::class, "assignment");
$route_map->addRouteMap("/attendance", Controller\StudentController::class, "attendance");
$route_map->addRouteMap("/academiccalendar", Controller\StudentController::class, "academiccalendar");
$route_map->addRouteMap("/sourcematerial", Controller\StudentController::class, "sourcematerial");

$router = new Kernel\Router();
$router->solve($_SERVER['REQUEST_URI'], $route_map);
?>