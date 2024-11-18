<?php
// user.php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk mendapatkan detail user berdasarkan role
    public function getUserByRole($role, $identifier) {
        $query = "";
        if ($role == "Mahasiswa") {
            $query = "SELECT * FROM mahasiswa WHERE nim = ?";
        } elseif ($role == "Dosen" || $role == "DPA" || $role == "KomDis") {
            $query = "SELECT * FROM dosen WHERE nip = ?";
        } 

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fungsi untuk login user berdasarkan nim/Nip dan password (Nim untuk mahasiswa, Nip untuk dosen/DPA dan KomDis)
    public function login($identifier, $password) {
        $query = "";
        if (preg_match('/^[0-9]{8}$/', $identifier)) {
            $query = "SELECT * FROM mahasiswa WHERE nim = ?";
        } elseif (preg_match('/^[0-9]{12}$/', $identifier)) {
            $query = "SELECT * FROM dosen WHERE nip = ?";
        }

        if ($query == "") {
            return null; // Identifier tidak valid
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                return $user; // Login berhasil, kembalikan data user
            }
        }
        return null; // Login gagal
    }


    // Fungsi untuk mendapatkan semua pengguna (khusus Admin)
    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Fungsi untuk mendaftarkan user baru
    public function registerUser($data) {
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Enkripsi password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->bind_param("ssss", $data['username'], $data['email'], $hashedPassword, $data['role']);
        return $stmt->execute();
    }

    // Fungsi untuk mendapatkan role pengguna berdasarkan NIM dan NIP 
    public function getUserRoleByIdentifier($identifier) {
        $query = "";
        if (preg_match('/^[0-9]{8}$/', $identifier)) {
            $query = "SELECT role FROM mahasiswa WHERE nim = ?";
        } elseif (preg_match('/^[0-9]{12}$/', $identifier)) {
            $query = "SELECT role FROM dosen WHERE nip = ?";
        }

        if ($query == "") {
            return null; // Identifier tidak valid
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user ? $user['role'] : null;
    }

    // Fungsi untuk mendapatkan jumlah pengguna berdasarkan role tertentu
    public function countUsersByRole($role) {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
?>
