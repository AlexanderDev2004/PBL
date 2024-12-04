<?php
class Dosen extends Controller {
    public function index() {
        $pelanggaranModel = $this->model('PelanggaranModel');
        $data['pelanggaran'] = $pelanggaranModel->getPelanggaranPerBulan();
        
        $this->view('templates/header');
        $this->view('pages/dashboard/Dosen/dosen', $data);
        $this->view('templates/footer');
    }
} 