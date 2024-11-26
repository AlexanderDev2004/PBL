<?php
class UserModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function registerUser($data) {
        $sql = "INSERT INTO temp_kredensial_m (nim, email, password, id_image) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['nim'], $data['email'], $data['password'], $data['id_image']]);
    }

    public function loginUser($username, $password) {
        $sql = "SELECT nim, password FROM kredensial_mahasiswa WHERE nim = ? UNION ALL SELECT id_pegawai, password FROM kredensial_pegawai WHERE id_pegawai = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
