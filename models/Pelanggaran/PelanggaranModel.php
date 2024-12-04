<?php
class PelanggaranModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPelanggaranPerBulan() {
        $query = "SELECT MONTH(tanggal) as bulan, COUNT(*) as jumlah 
                 FROM pelanggaran 
                 GROUP BY MONTH(tanggal) 
                 ORDER BY MONTH(tanggal)";
        $this->db->query($query);
        return $this->db->resultSet();
    }
} 