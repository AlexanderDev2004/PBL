<?php

class MahasiswaModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getMahasiswaByNIM($nim) {
        $query = "SELECT Nama, Prodi, Angkatan, Kelas FROM Mahasiswa WHERE Nim = :nim";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
