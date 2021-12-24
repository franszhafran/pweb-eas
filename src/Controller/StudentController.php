<?php

namespace App\Controller;

use App\Views\Student\AcademicCalendar;
use App\Views\Student\Assignment;
use App\Views\Student\Attendance;
use App\Views\Student\ClassView;
use App\Views\Student\SourceMaterial;
use App\Views\Student\Login;

class StudentController {
    public function classview() {
        echo ClassView::init()->setData([
            "request" => "test",
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

}