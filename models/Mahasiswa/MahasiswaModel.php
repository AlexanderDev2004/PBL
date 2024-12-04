<?php

class MahasiswaModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getMahasiswaByNIM($nim) {
        $this->db->query('SELECT m.*, p.nama_prodi, k.nama_kelas 
                         FROM mahasiswa m 
                         LEFT JOIN prodi p ON m.id_prodi = p.id 
                         LEFT JOIN kelas k ON m.id_kelas = k.id 
                         WHERE m.nim = :nim');
        $this->db->bind('nim', $nim);
        return $this->db->single();
    }
} 