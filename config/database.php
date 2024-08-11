<?php
class Database {
    private $host = 'localhost';
    private $data = 'for_my_learning';
    private $user = 'root';
    private $pass = '';
    private $chrs = 'utf8mb4';
    private$opts =
    [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    ];
    public $conn;
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->data;charset=$this->chrs", $this->user, $this->pass, $this->opts);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>