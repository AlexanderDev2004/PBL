<?php
class ControllerDosen {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $data = $this->model->getAllDosen();
        include 'views/dosen/index.php';
    }

    public function detail($id) {
        $data = $this->model->getDosenById($id);
        include 'views/dosen/detail.php';
    }

    public function validatePelanggaran($pelanggaranId) {
        $this->model->validatePelanggaran($pelanggaranId);
        header('Location: ?controller=dosen&action=index');
    }
}
?>
