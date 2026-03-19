<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "install";
    private $result = [];
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // SELECT
    public function select($query) {
        $query_run = mysqli_query($this->conn, $query);

        if ($query_run) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $this->result[] = $row;
            }
        }
        return $this;
    }

    // GET RESULT
    public function getResult() {
        return $this->result;
    }

    // INSERT
    public function insert($query) {
        return mysqli_query($this->conn, $query);
    }

    // UPDATE
    public function update($query) {
        return mysqli_query($this->conn, $query);
    }

    // DELETE
    public function delete($query) {
        return mysqli_query($this->conn, $query);
    }

    // add category
    public function escapeString($value){
    return mysqli_real_escape_string($this->conn, $value);
}
}