<?php

class DpaModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=db_tata_tertib", "username", "password");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    // Mengambil data profil DPA
    public function getProfilDpa($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM dosen WHERE id = ? AND role = 'dpa'");
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil daftar mahasiswa bimbingan
    public function getMahasiswaBimbingan($dpaId) {
        try {
            $query = $this->db->prepare("
                SELECT m.*, 
                       COUNT(p.id) as total_pelanggaran,
                       SUM(t.poin_pelanggaran) as total_poin
                FROM mahasiswa m
                LEFT JOIN pelanggaran p ON m.id = p.mahasiswa_id
                LEFT JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE m.dpa_id = ?
                GROUP BY m.id
                ORDER BY m.nama ASC
            ");
            $query->execute([$dpaId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Mengambil detail pelanggaran mahasiswa
    public function getDetailPelanggaranMahasiswa($mahasiswaId) {
        try {
            $query = $this->db->prepare("
                SELECT p.*, t.kode_tata_tertib, t.deskripsi as deskripsi_pelanggaran,
                       t.poin_pelanggaran, t.sanksi
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

    // Menambahkan catatan bimbingan
    public function tambahCatatanBimbingan($data) {
        try {
            $query = $this->db->prepare("
                INSERT INTO catatan_bimbingan 
                (dpa_id, mahasiswa_id, tanggal_bimbingan, catatan, tindak_lanjut)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $query->execute([
                $data['dpa_id'],
                $data['mahasiswa_id'],
                $data['tanggal_bimbingan'],
                $data['catatan'],
                $data['tindak_lanjut']
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil riwayat bimbingan mahasiswa
    public function getRiwayatBimbingan($mahasiswaId) {
        try {
            $query = $this->db->prepare("
                SELECT * FROM catatan_bimbingan
                WHERE mahasiswa_id = ?
                ORDER BY tanggal_bimbingan DESC
            ");
            $query->execute([$mahasiswaId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Membuat laporan bimbingan
    public function createLaporanBimbingan($dpaId, $periode) {
        try {
            $query = $this->db->prepare("
                SELECT m.nama, m.nim, 
                       COUNT(p.id) as total_pelanggaran,
                       SUM(t.poin_pelanggaran) as total_poin,
                       COUNT(cb.id) as total_bimbingan
                FROM mahasiswa m
                LEFT JOIN pelanggaran p ON m.id = p.mahasiswa_id
                LEFT JOIN tata_tertib t ON p.tata_tertib_id = t.id
                LEFT JOIN catatan_bimbingan cb ON m.id = cb.mahasiswa_id
                WHERE m.dpa_id = ?
                AND p.tanggal_pelanggaran BETWEEN ? AND ?
                GROUP BY m.id
            ");
            $query->execute([$dpaId, $periode['mulai'], $periode['selesai']]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Mengirim notifikasi ke mahasiswa
    public function kirimNotifikasi($mahasiswaId, $pesan) {
        try {
            $query = $this->db->prepare("
                INSERT INTO notifikasi 
                (mahasiswa_id, pesan, tanggal, status)
                VALUES (?, ?, NOW(), 'unread')
            ");
            return $query->execute([$mahasiswaId, $pesan]);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil statistik bimbingan
    public function getStatistikBimbingan($dpaId) {
        try {
            $query = $this->db->prepare("
                SELECT 
                    COUNT(DISTINCT m.id) as total_mahasiswa,
                    COUNT(p.id) as total_pelanggaran,
                    COUNT(cb.id) as total_bimbingan
                FROM mahasiswa m
                LEFT JOIN pelanggaran p ON m.id = p.mahasiswa_id
                LEFT JOIN catatan_bimbingan cb ON m.id = cb.mahasiswa_id
                WHERE m.dpa_id = ?
            ");
            $query->execute([$dpaId]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [
                'total_mahasiswa' => 0,
                'total_pelanggaran' => 0,
                'total_bimbingan' => 0
            ];
        }
    }
}