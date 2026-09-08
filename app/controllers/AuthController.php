<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        global $conexion;
        $this->userModel = new UserModel($conexion);
    }


    public function registerView() {
        require_once __DIR__ . '/../views/auth/register.php';
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Por favor completa todos los campos.";
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }

            // Verificar si el correo ya existe
            if ($this->userModel->obtenerPorEmail($email)) {
                $error = "El correo electrónico ya está registrado.";
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }


            if ($this->userModel->registrar($email, $password)) {
                header('Location: /index.php?c=Auth&a=loginView&success=registrado');
                exit;
            } else {
                $error = "Ocurrió un error al registrar el usuario.";
                require_once __DIR__ . '/../views/auth/register.php';
            }
        }
    }
}