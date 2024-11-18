<?php

include_once '../models/tataTertib.php';

class controllersTataTertib {
    private $modelTataTertib;

    public function __construct() {
        $this->modelTataTertib = new TataTertib();
    }

    // Menampilkan semua data tata tertib
    public function index() {
        $dataTataTertib = $this->modelTataTertib->getAllTataTertib();
        include "views/tata_tertib/index.php";
    }

    // Menampilkan form tambah tata tertib
    public function create() {
        include "views/tata_tertib/create.php";
    }

    // Menyimpan data tata tertib baru
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'kode_tata_tertib' => $_POST['kode_tata_tertib'],
                'kategori' => $_POST['kategori'],
                'deskripsi' => $_POST['deskripsi'],
                'sanksi' => $_POST['sanksi'],
                'poin_pelanggaran' => $_POST['poin_pelanggaran'],
                'status' => $_POST['status']
            ];

            $result = $this->modelTataTertib->tambahTataTertib($data);
            if ($result) {
                header("Location: index.php?page=tata_tertib&success=tambah");
            } else {
                header("Location: index.php?page=tata_tertib&error=tambah");
            }
        }
    }

    // Menampilkan form edit tata tertib
    public function edit($id) {
        $tataTertib = $this->modelTataTertib->getTataTertibById($id);
        include "views/tata_tertib/edit.php";
    }

    // Update data tata tertib
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'kode_tata_tertib' => $_POST['kode_tata_tertib'],
                'kategori' => $_POST['kategori'],
                'deskripsi' => $_POST['deskripsi'],
                'sanksi' => $_POST['sanksi'],
                'poin_pelanggaran' => $_POST['poin_pelanggaran'],
                'status' => $_POST['status']
            ];

            $result = $this->modelTataTertib->updateTataTertib($data);
            if ($result) {
                header("Location: index.php?page=tata_tertib&success=update");
            } else {
                header("Location: index.php?page=tata_tertib&error=update");
            }
        }
    }

    // Hapus data tata tertib
    public function delete($id) {
        $result = $this->modelTataTertib->deleteTataTertib($id);
        if ($result) {
            header("Location: index.php?page=tata_tertib&success=hapus");
        } else {
            header("Location: index.php?page=tata_tertib&error=hapus");
        }
    }

    // Mencari tata tertib
    public function search() {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $dataTataTertib = $this->modelTataTertib->searchTataTertib($keyword);
            include "views/tata_tertib/index.php";
        }
    }

    // Filter tata tertib berdasarkan kategori
    public function filterByKategori($kategori) {
        $dataTataTertib = $this->modelTataTertib->getTataTertibByKategori($kategori);
        include "views/tata_tertib/index.php";
    }

    // Mendapatkan statistik pelanggaran
    public function getStatistik() {
        $statistik = $this->modelTataTertib->getStatistikPelanggaran();
        include "views/tata_tertib/statistik.php";
    }

    // Export data tata tertib ke PDF
    public function exportPDF() {
        $dataTataTertib = $this->modelTataTertib->getAllTataTertib();
        // Implementasi export ke PDF
        // Bisa menggunakan library seperti FPDF atau TCPDF
    }

    // Export data tata tertib ke Excel
    public function exportExcel() {
        $dataTataTertib = $this->modelTataTertib->getAllTataTertib();
        // Implementasi export ke Excel
        // Bisa menggunakan library seperti PHPSpreadsheet
    }
}