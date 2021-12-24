<?php
namespace App\Kernel;

class Auth {
    private function check() {
        return $_SESSION['username'] != "" && isset($_ESSION['username']);
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