-- Not Defteri Veritabanı Şeması
-- Database Schema for Notebook Application

CREATE DATABASE IF NOT EXISTS notdefteri CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE notdefteri;

-- Notlar tablosu
CREATE TABLE IF NOT EXISTS notlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    baslik VARCHAR(255) NOT NULL,
    icerik TEXT NOT NULL,
    olusturma_tarihi DATETIME DEFAULT CURRENT_TIMESTAMP,
    guncelleme_tarihi DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    arsivlendi TINYINT(1) DEFAULT 0,
    INDEX idx_arsivlendi (arsivlendi),
    INDEX idx_olusturma_tarihi (olusturma_tarihi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
