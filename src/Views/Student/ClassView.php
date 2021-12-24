<?php

namespace App\Views\Student;

class ClassView {
    public function html() {
        return file_get_contents('classview.html', true);
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
        $html = $this->html();
        foreach($this->data as $key=>$d) {
            if(\is_string($d)) {
                $html = str_replace("{{\$" . $key . "}}", $d, $html);
            }
            
            if($key == "classes") {
                $table = "";
                foreach($d as $idx=>$class) {
                    $num = $idx+1;

                    $table .= "<tr>";
                    $table .= "<td>{$num}</td>";
                    $table .= "<td>{$class['name']}</td>";
                    $table .= "<td>{$class['subject']}</td>";
                    $table .= "<td>{$class['teacher_name']}</td>";
                    $table .= "<td>{$class['schedule']}</td>";
                    $table .= "</tr>";
                }
                $html = str_replace("{{\$" . $key . "}}", $table, $html);
            }
        }
        return $html;
    }
}
?>