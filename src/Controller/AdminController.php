<?php

namespace App\Controller;

use App\Views\Admin\Login;
use App\Kernel\Database;
use App\Views\Student\StudentCreate;
use App\Kernel\Request;

class AdminController {
    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            return $this->loginAction();
        }

        echo Login::init()->setData([
            "request" => "test",
        ])->generate();
    }

    private function loginAction() {
        $request = Request::init();

        $request->password = md5($request->password);

        $result = Database::init()->query("SELECT id FROM users WHERE username='{$request->username}' and password='{$request->password}' and type='admin' LIMIT 1");

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $row["id"];
            header("location: /studentcreate", true, 301);
        } else {
            echo "User tidak ada";
        }
    }

    public function createStudent() {
        $request = Request::init();

        $query = "INSERT INTO users (username, password, type, nid, gender, birth_date, photo_link) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $db = Database::init();
        $stmt = $db->getConnection()->prepare($query);

        $data = [
            "abc",
            "def",
            "admin",
            "123",
            "male",
            "2021-12-01",
            "http://google.com",
        ];
        $stmt->bind_param("sssssss", ...$data);

        $stmt->execute();
    }
    public function studentcreate() {
        echo StudentCreate::init()->generate();
    }
}