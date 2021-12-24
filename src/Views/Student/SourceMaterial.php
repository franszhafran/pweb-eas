<?php

namespace App\Views\Student;

class SourceMaterial {
    public function html() {
        return file_get_contents('sourcematerial.html', true);
    }

    public static function init(): self {
        return new self;
    }

    public function setData($data): self {
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