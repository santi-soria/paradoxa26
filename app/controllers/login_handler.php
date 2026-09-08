<?php
require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginUser = $_POST['username'] ?? ''; // Puede ser alias o correo
    $password = $_POST['password'] ?? '';

    if (empty($loginUser) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, complete todos los campos.']);
        exit;
    }

    $stmt = $conexion->prepare("SELECT password FROM users WHERE name = ? OR email = ?");
    $stmt->bind_param("ss", $loginUser, $loginUser);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(['success' => true, 'message' => 'Acceso concedido.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
    }
    $stmt->close();
}
?>
