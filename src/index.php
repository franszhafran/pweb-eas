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

session_start();

$route_map = new Kernel\RouteMap();
// Admin
$route_map->addRouteMap("/login", Controller\AdminController::class, "login");
$route_map->addRouteMap("/studentcreate", Controller\AdminController::class, "studentcreate");
$route_map->addRouteMap("/studentmanage", Controller\AdminController::class, "studentManage");

// Student
$route_map->addRouteMap("/student/classview", Controller\StudentController::class, "classview");
$route_map->addRouteMap("/student/create_student", Controller\AdminController::class, "createStudent");
$route_map->addRouteMap("/student/assignment", Controller\StudentController::class, "assignment");
$route_map->addRouteMap("/student/attendance", Controller\StudentController::class, "attendance");
$route_map->addRouteMap("/student/academiccalendar", Controller\StudentController::class, "academiccalendar");
$route_map->addRouteMap("/student/sourcematerial", Controller\StudentController::class, "sourcematerial");
$route_map->addRouteMap("/student/login", Controller\StudentController::class, "login");

// Teacher
$route_map->addRouteMap("/teacher/login", Controller\TeacherController::class, "login");
$route_map->addRouteMap("/teacher/classes", Controller\TeacherController::class, "classList");
$route_map->addRouteMap("/teacher/classes/create", Controller\TeacherController::class, "classCreate");

// System
$route_map->addRouteMap("/migrate", Controller\AdminController::class, "migrate");

$router = new Kernel\Router();
$router->set404("<center><span style='font-size:24px;'>404 NOT FOUND</span></center>");
$router->set401("<center><span style='font-size:24px;'>401 UNAUTHORIZED</span></center>");
$router->solve($_SERVER['REQUEST_URI'], $route_map);
?>