<?php

namespace App\Controller;

use App\Kernel\Auth;
use App\Kernel\Database;
use App\Kernel\Request;
use App\Views\Student\AcademicCalendar;
use App\Views\Student\Assignment;
use App\Views\Student\Attendance;
use App\Views\Student\ClassView;
use App\Views\Student\SourceMaterial;
use App\Views\Student\Login;

class StudentController {
    public function classview() {
        echo ClassView::init()->setData([
            "classes" => $this->getClassViewData(),
        ])->generate();
    }
    public function assignment() {
        echo Assignment::init()->setData([
            "request" => "test",
        ])->generate();

    }
    public function attendance() {
        echo Attendance::init()->setData([
            "request" => "test",
        ])->generate();

    }
    public function academiccalendar() {
        echo AcademicCalendar::init()->setData([
            "request" => "test",
        ])->generate();

    }
    public function sourcematerial() {
        echo SourceMaterial::init()->setData([
            "request" => "test",
        ])->generate();

    }
    public function login() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            return $this->loginAction();
        }

        echo Login::init()->setData([
            "request" => "test",
        ])->generate();
    }

    private function getClassViewData() {
        $db = Database::init();
        $result = $db->query("SELECT c.name, c.subject, c.schedule, u.name as teacher_name 
        FROM classes as c LEFT JOIN users as u 
        ON c.teacher_id=u.id WHERE u.type='teacher'");
        
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

        $result = Database::init()->query("SELECT id, username FROM users WHERE username='{$request->username}' and password='{$request->password}' and type='student' LIMIT 1");

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            Auth::auth($row['username']);
            header("location: /student/classview", true, 301);
        } else {
            header("Refresh:2; url=/student/login", true, 303);
            echo "User tidak ada, mengarahkan...";
        }
    }

}