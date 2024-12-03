<?php

class DosenController {
    private $pelanggaranModel;
    private $mahasiswaModel;

    public function __construct() {
        $this->pelanggaranModel = new PelanggaranModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function beranda() {
        $data['chart'] = $this->pelanggaranModel->getPelanggaranPerBulan();
        require_once '../views/dosen/beranda.php';
    }

    public function formTambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = htmlspecialchars($_POST['nim']);
            $tanggal = htmlspecialchars($_POST['tanggal']);
            $pelanggaran = htmlspecialchars($_POST['pelanggaran']);

            // Upload bukti
            $bukti = '';
            if (!empty($_FILES['bukti']['name'])) {
                $bukti = 'uploads/' . $_FILES['bukti']['name'];
                move_uploaded_file($_FILES['bukti']['tmp_name'], $bukti);
            }

            $data = [
                'nim' => $nim,
                'tanggal' => $tanggal,
                'pelanggaran' => $pelanggaran,
                'bukti' => $bukti
            ];

            $this->pelanggaranModel->tambahPelanggaran($data);
            header('Location: /dosen/beranda');
        } else {
            require_once '../views/dosen/form_tambah.php';
        }
    }

    public function cekNIM() {
        if (isset($_POST['nim'])) {
            $nim = htmlspecialchars($_POST['nim']);
            $result = $this->mahasiswaModel->getMahasiswaByNIM($nim);
            echo json_encode($result ?: '-');
        }
    }

    public function pelanggaran() {
        $data['pelanggaran'] = $this->pelanggaranModel->getSemuaPelanggaran();
        require_once '../views/dosen/pelanggaran.php';
    }

    public function profil() {
        require_once '../views/dosen/profil.php';
    }
}
