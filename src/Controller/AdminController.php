<?php

namespace App\Controller;

use App\Views\Admin\Login;

class AdminController {
    public function login() {
        echo Login::init()->setData([
            "request" => "test",
        ])->generate();
    }
}