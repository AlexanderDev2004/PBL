<?php
class ControllerKomdis {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $data = $this->model->getAllCases();
        include 'views/komdis/index.php';
    }

    public function reviewCase($caseId) {
        $data = $this->model->getCaseById($caseId);
        include 'views/komdis/review.php';
    }

    public function assignSanction($caseId, $sanction) {
        $this->model->assignSanction($caseId, $sanction);
        header('Location: ?controller=komdis&action=index');
    }
}
?>
