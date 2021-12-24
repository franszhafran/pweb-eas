<?php

namespace App\Controller;

use App\Views\Student\AcademicCalendar;
use App\Views\Student\Assignment;
use App\Views\Student\Attendance;
use App\Views\Student\ClassView;

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
}