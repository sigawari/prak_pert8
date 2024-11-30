-- Buat database mahasiswa jika belum ada
CREATE DATABASE IF NOT EXISTS mahasiswa;

-- Gunakan database mahasiswa
USE mahasiswa;

CREATE TABLE IF NOT EXISTS data_mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    nim VARCHAR(15) NOT NULL UNIQUE,
    mata_kuliah VARCHAR(100) NOT NULL
);

-- Masukkan data ke tabel data_mahasiswa
INSERT INTO data_mahasiswa (nama, jenis_kelamin, nim, mata_kuliah) VALUES
('Ayu', 'P', '123456789', 'Basis Data'),
('Intan', 'P', '123456788', 'Pemrograman Web'),
('Rijal', 'L', '123456787', 'Sistem Operasi'),
('Khalisa', 'P', '123456786', 'Algoritma'),
('Icha', 'P', '123456785', 'Pemrograman Dasar'),
('Elsa', 'P', '123456784', 'Keamanan Siber'),
('Yossi', 'P', '123456783', 'Data Mining'),
('Kiki', 'P', '123456782', 'Jaringan Komputer'),
('Bagas', 'L', '123456781', 'Kecerdasan Buatan'),
('Aldo', 'L', '123456780', 'Manajemen Proyek'),
('Wawan', 'L', '123456779', 'Pemrograman Web'),
('Budi', 'L', '123456778', 'Multimedia'),
('Eka', 'P', '123456777', 'Mobile Programming'),
('Sari', 'P', '123456776', 'Analisis Data')
ON DUPLICATE KEY UPDATE nama = VALUES(nama);
