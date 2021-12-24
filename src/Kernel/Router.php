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
        echo $this->html404;
    }

    public function set404($html) {
        $this->html404 = $html;
    }
}
?>