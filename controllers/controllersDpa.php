<?php
class ControllerDPA {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $data = $this->model->getAllMahasiswaUnderDPA();
        include 'views/dpa/index.php';
    }

    public function pelanggaran($mahasiswaId) {
        $data = $this->model->getPelanggaranByMahasiswa($mahasiswaId);
        include 'views/dpa/pelanggaran.php';
    }

    public function takeAction($pelanggaranId, $action) {
        $this->model->takeActionOnPelanggaran($pelanggaranId, $action);
        header('Location: ?controller=dpa&action=index');
    }
}
?>
