<?php
class ControllerMahasiswa {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $data = $this->model->getStudentData($_SESSION['mahasiswa_id']);
        include 'views/mahasiswa/index.php';
    }

    public function lihatPelanggaran() {
        $data = $this->model->getPelanggaranByStudent($_SESSION['mahasiswa_id']);
        include 'views/mahasiswa/pelanggaran.php';
    }

    // public function ajukanBanding($pelanggaranId, $alasan) {
    //     $this->model->submitAppeal($pelanggaranId, $alasan);
    //     header('Location: ?controller=mahasiswa&action=lihatPelanggaran');
    // }
}
?>
