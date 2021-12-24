<?php

namespace App\Views\Teacher;

class ListClasses {
    public function html() {
        return file_get_contents('list_classes.html', true);
    }

    public static function init(): self {
        $s = new self;
        $s->data = [];
        return $s;
    }

    public function setData($data): self {
        $this->data = $data;
        return $this;
    }

    public function generate() {
        $html = $this->html();
        foreach($this->data as $key=>$d) {
            if(\is_string($d)) {
                $html = str_replace("{{\$" . $key . "}}", $d, $html);
            }
            
            if($key == "classes") {
                $table = "";
                foreach($d as $idx=>$student) {
                    $num = $idx+1;

                    $table .= "<tr>";
                    $table .= "<td>{$num}</td>";
                    $table .= "<td>{$student['name']}</td>";
                    $table .= "<td>{$student['subject']}</td>";
                    $table .= "<td>{$student['schedule']}</td>";
                    $table .= "</tr>";
                }
                $html = str_replace("{{\$" . $key . "}}", $table, $html);
            }
        }
        return $html;
    }
}
?>