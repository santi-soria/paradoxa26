<?php

require_once '../app/models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        global $conexion; 
        $this->userModel = new UserModel($conexion);
    }

 
    public function loginView() {
        require_once '../app/views/auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Por favor completa todos los campos.";
                require_once '../app/views/auth/login.php';
                return;
            }

            $user = $this->userModel->obtenerPorEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                header('Location: /app/views/home/index.php');
                exit;
            } else {
                $error = "Credenciales incorrectas.";
                require_once '../app/views/auth/login.php';
            }
        }
    }

    public function registerView() {
        require_once '../app/views/auth/register.php';
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Por favor completa todos los campos.";
                require_once '../app/views/auth/register.php';
                return;
            }

            // Verificar si el correo ya existe
            if ($this->userModel->obtenerPorEmail($email)) {
                $error = "El correo electrónico ya está registrado.";
                require_once '../app/views/auth/register.php';
                return;
            }


            if ($this->userModel->registrar($email, $password)) {
                header('Location: /index.php?c=Auth&a=loginView&success=registrado');
                exit;
            } else {
                $error = "Ocurrió un error al registrar el usuario.";
                require_once '../app/views/auth/login.php';
            }
        }
    }
}