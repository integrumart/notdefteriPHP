<?php
// Veritabanı yapılandırması
// Database configuration

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'notdefteri');

// Veritabanı bağlantısı oluştur
function getDBConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }
        
        $conn->set_charset("utf8mb4");
        return $conn;
    } catch (Exception $e) {
        die("Veritabanı hatası: " . $e->getMessage());
    }
}

// Güvenli çıkış için yardımcı fonksiyon
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
