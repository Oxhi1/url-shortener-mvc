<?php
class Url {
    private $db;

    public function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        $this->db = new PDO($dsn, DB_USER, DB_PASS);
    }

    public function findByOriginal($url) {
        $stmt = $this->db->prepare("SELECT * FROM urls WHERE original_url = ?");
        $stmt->execute([$url]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByShort($code) {
        $stmt = $this->db->prepare("SELECT * FROM urls WHERE short_code = ?");
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($url, $code) {
        $stmt = $this->db->prepare("INSERT INTO urls (original_url, short_code) VALUES (?, ?)");
        $stmt->execute([$url, $code]);
    }

    public function generateKey($length = 12) {
        $allowed = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
        $result = '';
        while (strlen($result) < $length) {
            $byte = random_bytes(1);
            $char = $allowed[ord($byte) % strlen($allowed)];
            $result .= $char;
        }
        return $result;
    }
}
