<?php

class DosenModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=db_tata_tertib", "username", "password");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    // Mengambil data profil dosen
    public function getProfilDosen($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM dosen WHERE id = ?");
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil semua pelanggaran yang perlu divalidasi
    public function getPelanggaranPending() {
        try {
            $query = $this->db->prepare("
                SELECT p.*, m.nama as nama_mahasiswa, m.nim, 
                       t.kode_tata_tertib, t.deskripsi as deskripsi_pelanggaran,
                       t.poin_pelanggaran, t.sanksi
                FROM pelanggaran p
                JOIN mahasiswa m ON p.mahasiswa_id = m.id
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.status = 'pending'
                ORDER BY p.tanggal_pelanggaran DESC
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Validasi pelanggaran
    public function validasiPelanggaran($pelanggaranId, $status, $catatan = '') {
        try {
            $query = $this->db->prepare("
                UPDATE pelanggaran 
                SET status = ?, catatan_dosen = ?, dosen_validator_id = ?, tanggal_validasi = NOW()
                WHERE id = ?
            ");
            return $query->execute([$status, $catatan, $_SESSION['dosen_id'], $pelanggaranId]);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil riwayat validasi pelanggaran oleh dosen
    public function getRiwayatValidasi($dosenId) {
        try {
            $query = $this->db->prepare("
                SELECT p.*, m.nama as nama_mahasiswa, m.nim,
                       t.kode_tata_tertib, t.deskripsi as deskripsi_pelanggaran,
                       t.poin_pelanggaran, t.sanksi
                FROM pelanggaran p
                JOIN mahasiswa m ON p.mahasiswa_id = m.id
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.dosen_validator_id = ?
                ORDER BY p.tanggal_validasi DESC
            ");
            $query->execute([$dosenId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Update profil dosen
    public function updateProfil($id, $data) {
        try {
            $query = $this->db->prepare("
                UPDATE dosen 
                SET nama = ?, nip = ?, email = ?, no_hp = ?, jabatan = ?
                WHERE id = ?
            ");
            return $query->execute([
                $data['nama'],
                $data['nip'],
                $data['email'],
                $data['no_hp'],
                $data['jabatan'],
                $id
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Update password dosen
    public function updatePassword($id, $passwordLama, $passwordBaru) {
        try {
            $query = $this->db->prepare("SELECT password FROM dosen WHERE id = ?");
            $query->execute([$id]);
            $dosen = $query->fetch(PDO::FETCH_ASSOC);

            if(password_verify($passwordLama, $dosen['password'])) {
                $hashedPassword = password_hash($passwordBaru, PASSWORD_DEFAULT);
                $query = $this->db->prepare("UPDATE dosen SET password = ? WHERE id = ?");
                return $query->execute([$hashedPassword, $id]);
            }
            return false;
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mencari pelanggaran berdasarkan kriteria
    public function searchPelanggaran($keyword) {
        try {
            $keyword = "%$keyword%";
            $query = $this->db->prepare("
                SELECT p.*, m.nama as nama_mahasiswa, m.nim,
                       t.kode_tata_tertib, t.deskripsi as deskripsi_pelanggaran
                FROM pelanggaran p
                JOIN mahasiswa m ON p.mahasiswa_id = m.id
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE m.nama LIKE ? OR m.nim LIKE ? OR t.kode_tata_tertib LIKE ?
                ORDER BY p.tanggal_pelanggaran DESC
            ");
            $query->execute([$keyword, $keyword, $keyword]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Mendapatkan statistik validasi
    public function getStatistikValidasi($dosenId) {
        try {
            $query = $this->db->prepare("
                SELECT 
                    COUNT(*) as total_validasi,
                    SUM(CASE WHEN status = 'validated' THEN 1 ELSE 0 END) as total_diterima,
                    SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as total_ditolak
                FROM pelanggaran
                WHERE dosen_validator_id = ?
            ");
            $query->execute([$dosenId]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [
                'total_validasi' => 0,
                'total_diterima' => 0,
                'total_ditolak' => 0
            ];
        }
    }
}