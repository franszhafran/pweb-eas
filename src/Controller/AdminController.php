<?php

namespace App\Controller;

use App\Views\Admin\Login;
use App\Kernel\Database;
use App\Views\Student\StudentCreate;

class AdminController {
    public function login() {
        echo Login::init()->setData([
            "request" => "test",
        ])->generate();

        $db = Database::init();
        $db->connect();
        $db->query("SHOW DATABASES");
        $db->close();
    }
    public function studentcreate() {
        echo StudentCreate::init()->setData([
            "request" => "test",
        ])->generate();
    }
}