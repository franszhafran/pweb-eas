<?php

namespace App\Controller;

use App\Views\Admin\Login;
use App\Kernel\Database;
use App\Views\Student\StudentCreate;
use App\Kernel\Request;
use App\Views\Student\StudentManage;

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

    private function createStudent() {
        $request = Request::init();

        $query = "INSERT INTO users (username, password, type, nid, gender, birth_date, photo_link, name) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $db = Database::init();
        $stmt = $db->getConnection()->prepare($query);

        $data = [
            $request->username,
            $request->password,
            "student",
            $request->nid,
            $request->gender,
            $request->birth_date,
            $request->photo_link,
            $request->name,
        ];
        $stmt->bind_param("ssssssss", ...$data);

        $stmt->execute();
    }

    public function studentcreate() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            return $this->createStudent();
        }
        echo StudentCreate::init()->generate();
    }

    public function studentManage() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            return $this->createStudent();
        }

        $db = Database::init();
        $result = $db->query("SELECT id FROM users WHERE type='student'");
        
        $students = [];

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }

        echo StudentManage::init()->setData([
            "students" => $students,  
        ])->generate();

        $db->close();
    }
}