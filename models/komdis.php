<?php

class KomdisModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=db_tata_tertib", "username", "password");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    // Mengambil semua pelanggaran yang perlu ditindak
    public function getPelanggaranBelumDitindak() {
        try {
            $query = $this->db->prepare("
                SELECT p.*, m.nama as nama_mahasiswa, m.nim,
                       t.kode_tata_tertib, t.deskripsi as deskripsi_pelanggaran,
                       t.poin_pelanggaran, t.sanksi
                FROM pelanggaran p
                JOIN mahasiswa m ON p.mahasiswa_id = m.id
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.status_komdis = 'pending'
                ORDER BY p.tanggal_pelanggaran DESC
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Memberikan sanksi pelanggaran
    public function berikanSanksi($pelanggaranId, $data) {
        try {
            $query = $this->db->prepare("
                UPDATE pelanggaran 
                SET status_komdis = 'processed',
                    sanksi_tambahan = ?,
                    catatan_komdis = ?,
                    tanggal_sidang = ?,
                    komdis_id = ?,
                    tanggal_proses = NOW()
                WHERE id = ?
            ");
            return $query->execute([
                $data['sanksi_tambahan'],
                $data['catatan_komdis'],
                $data['tanggal_sidang'],
                $_SESSION['komdis_id'],
                $pelanggaranId
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    // Mengambil riwayat sidang
    public function getRiwayatSidang() {
        try {
            $query = $this->db->prepare("
                SELECT p.*, m.nama as nama_mahasiswa, m.nim,
                       t.kode_tata_tertib, t.deskripsi as deskripsi_pelanggaran,
                       t.poin_pelanggaran, t.sanksi
                FROM pelanggaran p
                JOIN mahasiswa m ON p.mahasiswa_id = m.id
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.status_komdis = 'processed'
                ORDER BY p.tanggal_sidang DESC
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Membuat laporan sidang
    public function createLaporanSidang($periode) {
        try {
            $query = $this->db->prepare("
                SELECT m.nama, m.nim, 
                       COUNT(p.id) as total_pelanggaran,
                       SUM(t.poin_pelanggaran) as total_poin,
                       GROUP_CONCAT(p.sanksi_tambahan) as sanksi_tambahan
                FROM pelanggaran p
                JOIN mahasiswa m ON p.mahasiswa_id = m.id
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.status_komdis = 'processed'
                AND p.tanggal_sidang BETWEEN ? AND ?
                GROUP BY m.id
            ");
            $query->execute([$periode['mulai'], $periode['selesai']]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    // Mengambil statistik sidang
    public function getStatistikSidang() {
        try {
            $query = $this->db->prepare("
                SELECT 
                    COUNT(*) as total_sidang,
                    COUNT(DISTINCT mahasiswa_id) as total_mahasiswa,
                    AVG(t.poin_pelanggaran) as rata_rata_poin
                FROM pelanggaran p
                JOIN tata_tertib t ON p.tata_tertib_id = t.id
                WHERE p.status_komdis = 'processed'
            ");
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [
                'total_sidang' => 0,
                'total_mahasiswa' => 0,
                'rata_rata_poin' => 0
            ];
        }
    }
}