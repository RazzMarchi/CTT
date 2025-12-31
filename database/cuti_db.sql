CREATE DATABASE IF NOT EXISTS cuti_db;
USE cuti_db;

CREATE TABLE pegawai (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    nip VARCHAR(20),
    jabatan VARCHAR(100),
    saldo_cuti INT DEFAULT 6
);

CREATE TABLE cuti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pegawai_id INT,
    nomor_surat VARCHAR(50),
    tgl_mulai DATE,
    tgl_selesai DATE,
    lama INT,
    alasan TEXT,
    alamat_cuti TEXT,
    telp VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);