<?php

class MahasiswaModel {
    private $db;

    public function __construct() {
        // Koneksi database
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=db_tata_tertib", "username", "password");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    // Mengambil data profil mahasiswa
    public function getProfilMahasiswa($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = ?");
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil total pelanggaran mahasiswa
    public function getTotalPelanggaran($mahasiswaId) {
        try {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM pelanggaran WHERE mahasiswa_id = ?");
            $query->execute([$mahasiswaId]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch(PDOException $e) {
            return 0;
        }
    }

    // Mengambil total poin pelanggaran
    public function getTotalPoin($mahasiswaId) {
        try {
            $query = $this->db->prepare("
                SELECT SUM(t.poin_pelanggaran) as total_poin 
                FROM pelanggaran p 
                JOIN tata_tertib t ON p.tata_tertib_id = t.id 
                WHERE p.mahasiswa_id = ?
            ");
            $query->execute([$mahasiswaId]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total_poin'] ?? 0;
        } catch(PDOException $e) {
            return 0;
        }
    }

    // Mengambil riwayat pelanggaran
    public function getRiwayatPelanggaran($mahasiswaId) {
        try {
            $query = $this->db->prepare("
                SELECT p.*, t.kode_tata_tertib, t.deskripsi, t.poin_pelanggaran, t.sanksi
                FROM pelanggaran p
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.mahasiswa_id = ?
                ORDER BY p.tanggal_pelanggaran DESC
            ");
            $query->execute([$mahasiswaId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Mengambil pelanggaran terbaru
    public function getRecentPelanggaran($mahasiswaId, $limit = 5) {
        try {
            $query = $this->db->prepare("
                SELECT p.*, t.kode_tata_tertib, t.deskripsi, t.poin_pelanggaran
                FROM pelanggaran p
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.mahasiswa_id = ?
                ORDER BY p.tanggal_pelanggaran DESC
                LIMIT ?
            ");
            $query->execute([$mahasiswaId, $limit]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Filter pelanggaran berdasarkan tanggal
    public function filterPelanggaran($mahasiswaId, $tanggalMulai, $tanggalAkhir) {
        try {
            $query = $this->db->prepare("
                SELECT p.*, t.kode_tata_tertib, t.deskripsi, t.poin_pelanggaran, t.sanksi
                FROM pelanggaran p
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.mahasiswa_id = ? 
                AND p.tanggal_pelanggaran BETWEEN ? AND ?
                ORDER BY p.tanggal_pelanggaran DESC
            ");
            $query->execute([$mahasiswaId, $tanggalMulai, $tanggalAkhir]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Update profil mahasiswa
    public function updateProfil($id, $data) {
        try {
            $query = $this->db->prepare("
                UPDATE mahasiswa 
                SET nama = ?, nim = ?, email = ?, no_hp = ?, alamat = ?
                WHERE id = ?
            ");
            return $query->execute([
                $data['nama'],
                $data['nim'],
                $data['email'],
                $data['no_hp'],
                $data['alamat'],
                $id
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Update password mahasiswa
    public function updatePassword($id, $passwordLama, $passwordBaru) {
        try {
            // Verifikasi password lama
            $query = $this->db->prepare("SELECT password FROM mahasiswa WHERE id = ?");
            $query->execute([$id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if(password_verify($passwordLama, $user['password'])) {
                // Update password baru
                $hashedPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);
                $query = $this->db->prepare("UPDATE mahasiswa SET password = ? WHERE id = ?");
                return $query->execute([$hashedPassword, $id]);
            }
            return false;
        } catch(PDOException $e) {
            return false;
        }
    }
}