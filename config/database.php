<?php
session_start();

class Database {
    private $host = "localhost:3307";
    private $username = "root";
    private $password = "";
    private $database = "ocd_detection";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function escape_string($string) {
        return $this->conn->real_escape_string($string);
    }
}

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function checkAdminLogin() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: ../admin_login.php");
        exit();
    }
}
?>