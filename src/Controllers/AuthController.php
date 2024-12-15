<?php
namespace HealthTracker\Controllers;

use HealthTracker\Models\User;

class AuthController {
    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];

            if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
                return ['error' => 'Semua field harus diisi'];
            }

            if ($this->userModel->findByEmail($userData['email'])) {
                return ['error' => 'Email sudah terdaftar'];
            }

            if ($this->userModel->create($userData)) {
                $_SESSION['user'] = $userData['email'];
                header('Location: /albi/dashboard');
                exit;
            }

            return ['error' => 'Gagal mendaftar'];
        }

        require_once __DIR__ . '/../../views/auth/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                return ['error' => 'Email dan password harus diisi'];
            }

            $user = $this->userModel->findByEmail($email);
            if ($user && $this->userModel->verifyPassword($password, $user->password)) {
                $_SESSION['user'] = $email;
                header('Location: /albi/dashboard');
                exit;
            }

            return ['error' => 'Email atau password salah'];
        }

        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /albi');
        exit;
    }
} 