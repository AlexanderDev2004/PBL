<?php

class PelanggaranModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getPelanggaranPerBulan() {
        $query = "SELECT MONTH(TanggalPelaporan) AS Bulan, COUNT(*) AS JumlahPelanggaran
                  FROM DataPelanggaran
                  GROUP BY MONTH(TanggalPelaporan)
                  ORDER BY MONTH(TanggalPelaporan)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambahPelanggaran($data) {
        $query = "INSERT INTO DataPelanggaran (Nim, TanggalPelaporan, Pelanggaran, Bukti)
                  VALUES (:nim, :tanggal, :pelanggaran, :bukti)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function getSemuaPelanggaran() {
        $query = "SELECT p.Nim, m.Nama, p.TanggalPelaporan, p.Pelanggaran, p.Bukti
                  FROM DataPelanggaran p
                  JOIN Mahasiswa m ON p.Nim = m.Nim";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
