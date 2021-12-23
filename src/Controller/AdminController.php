<?php

namespace App\Controller;

use App\Views\Admin\Login;
use App\Kernel\Database;

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
}