<?php
namespace App\Kernel;

class Request {
    public static function init(): self {
        $r = new self;
        foreach($_POST as $key=>$value) {
            $r->$key = $value;
        }
        return $r;
    }
}
?>