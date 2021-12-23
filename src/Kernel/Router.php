<?php
namespace App\Kernel;

class Router {
    public function solve(string $url, RouteMap $route_map) {
        $routes = $route_map->getRouteMap();
        foreach($routes as $route) {
            if($url == $route[0]) {
                $resolver = new $route[1]();
                return $resolver->{$route[2]}();
            }
        }
    }
}
?>