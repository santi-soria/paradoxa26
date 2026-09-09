<?php
// app/models/UserModel.php

class UserModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Buscar si el usuario ya existe por correo
    public function obtenerPorEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Registrar un nuevo usuario con la contraseña encriptada
    public function registrar($email, $password) {
        // Encriptar contraseña de forma segura
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $passwordHash);
        
        return $stmt->execute();
    }
}