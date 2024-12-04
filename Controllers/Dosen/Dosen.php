<?php

include_once '../app/init.php';
class Dosen extends Controller {
    public function index() {
        $pelanggaranModel = $this->model('PelanggaranModel');
        $data['pelanggaran'] = $pelanggaranModel->getPelanggaranPerBulan();
        
        $this->view('templates/header');
        $this->view('pages/dashboard/Dosen/dosen', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nim' => $_POST['nim'],
                'tanggal' => $_POST['tanggal'],
                'pelanggaran' => $_POST['pelanggaran'],
                'foto_bukti' => $this->uploadFoto()
            ];
            
            $pelanggaranModel = $this->model('PelanggaranModel');
            if ($pelanggaranModel->tambahPelanggaran($data)) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/dosen');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/dosen');
                exit;
            }
        } else {
            $this->view('templates/header');
            $this->view('pages/dashboard/Dosen/tambah');
            $this->view('templates/footer');
        }
    }

    private function uploadFoto() {
        $namaFile = $_FILES['foto_bukti']['name'];
        $tmpName = $_FILES['foto_bukti']['tmp_name'];
        $error = $_FILES['foto_bukti']['error'];
        
        // Jika tidak ada file yang diupload
        if ($error === 4) {
            return '';
        }

        // Cek apakah yang diupload adalah gambar
        $ekstensiValid = ['jpg', 'jpeg', 'png'];
        $ekstensiFoto = explode('.', $namaFile);
        $ekstensiFoto = strtolower(end($ekstensiFoto));
        
        if (!in_array($ekstensiFoto, $ekstensiValid)) {
            Flasher::setFlash('Format file tidak didukung', '', 'danger');
            header('Location: ' . BASEURL . '/dosen');
            exit;
        }

        // Generate nama file baru
        $namaFileBaru = uniqid() . '.' . $ekstensiFoto;
        move_uploaded_file($tmpName, 'img/bukti/' . $namaFileBaru);

        return $namaFileBaru;
    }
} 
