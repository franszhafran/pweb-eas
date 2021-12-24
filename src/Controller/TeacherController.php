<?php

namespace App\Controller;

use App\Kernel\Auth;
use App\Kernel\Database;
use App\Kernel\Request;
use App\Views\Teacher\ListClasses;
use App\Views\Teacher\Login;

class TeacherController {
    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            return $this->loginAction();
        }

        echo Login::init()->setData([
            "request" => "test",
        ])->generate();
    }

    public function classList() {
        echo ListClasses::init()->setData([
            "classes" => $this->getClassList(Auth::getUser()['id']),
        ])->generate();
    }

    private function getClassList($id) {
        $id = (int) $id;
        $db = Database::init();
        $result = $db->query("SELECT * FROM classes WHERE teacher_id={$id}");
        
        $classes = [];

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $classes[] = $row;
            }
        }
        $db->close();

        return $classes;

    }

    private function loginAction() {
        $request = Request::init();

        $request->password = md5($request->password);

        $result = Database::init()->query("SELECT id, username FROM users WHERE username='{$request->username}' and password='{$request->password}' and type='teacher' LIMIT 1");

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            Auth::auth($row['username']);
            header("location: /teacher/classview", true, 301);
        } else {
            header("Refresh:2; url=/teacher/login", true, 303);
            echo "User tidak ada, mengarahkan...";
        }
    }

}