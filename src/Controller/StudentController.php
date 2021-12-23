<?php

namespace App\Controller;

use App\Views\Student\ClassView;

class StudentController {
    public function classview() {
        echo ClassView::init()->setData([
            "request" => "test",
        ])->generate();

    }
}