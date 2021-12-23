<?php

namespace App\Kernel;

class Database {
    public function __construct() {
        $this->ip = "pweb_mysql";
        $this->username = "user";
        $this->password = "user";
    }

    public static function init(): Database {
        $r = new self;
        $r->connect();
        return $r;
    }

    public function connect() {
        $conn = new \mysqli($this->ip, $this->username, $this->password);
        $this->connection = $conn;
    }

    public function query($query) {
        return $this->connection->query($query);
    }

    public function close() {
        $this->connection->close();
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>