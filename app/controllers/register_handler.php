<?php
require_once '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Generar ID de usuario aleatorio (como pidió el usuario)
    $userId = 'USR-' . rand(1000, 9999);

    // Hash de la contraseña para seguridad
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO users (user_id, name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $userId, $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cuenta creada exitosamente.', 'userId' => $userId]);
    } else {
        if ($conexion->errno === 1062) {
            echo json_encode(['success' => false, 'message' => 'El correo o nombre de usuario ya existe.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear la cuenta: ' . $conexion->error]);
        }
    }
    $stmt->close();
}
?>
