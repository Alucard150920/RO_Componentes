<?php
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'logueado' => true,
        'usuario_id' => $_SESSION['usuario_id'],
        'usuario_nombre' => $_SESSION['usuario_nombre'] ?? 'Usuario',
        'usuario_rol' => $_SESSION['usuario_rol'] ?? 'usuario' // 👉 Devolver el rol
    ]);
} else {
    echo json_encode([
        'logueado' => false
    ]);
}
?>
