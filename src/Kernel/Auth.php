<?php
namespace App\Kernel;

class Auth {
    private function check() {
        if(isset($_SESSION['username'])) {
            return $_SESSION['username'] != "";
        }
        return false;
    }

    private function auth(string $username) {
        $_SESSION['username'] = $username;
    }

    private function get(): string {
        return $_SESSION['username'];
    }

    public static function __callStatic($name, $arguments)
    {
        $r = new self;
        return $r->$name(...$arguments);
    }
}
?>