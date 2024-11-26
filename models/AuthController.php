<?php
class AuthController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                return ['status' => 'error', 'message' => 'Password does not match!'];
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $idImage = null; // Add logic for image handling if needed

            $data = [
                'nim' => $nim,
                'email' => $email,
                'password' => $hashedPassword,
                'id_image' => $idImage
            ];

            if ($this->model->registerUser($data)) {
                return ['status' => 'success', 'message' => 'Registration successful. Await admin approval.'];
            }

            return ['status' => 'error', 'message' => 'Registration failed!'];
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->loginUser($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /dashboard");
                exit();
            }

            return ['status' => 'error', 'message' => 'Invalid credentials!'];
        }
    }
}
