<?php

namespace App\Views\Student;

class Login {
    public function html() {
        return file_get_contents('login.html', true);
    }

    public static function init(): Login {
        return new self;
    }

    public function setData($data): Login {
        $this->data = $data;
        return $this;
    }

    public function generate() {
        $html = $this->html();
        foreach($this->data as $key=>$d) {
            $html = str_replace("{{\$" . $key . "}}", $d, $html);
        }
        return $html;
    }
}
?>