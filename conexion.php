<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "test";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexion cagada" . $conexion->connect_errno);
} else {
    echo "conectado";
}

?>
