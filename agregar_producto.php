<?php
session_start();
if ($_SESSION['usuario_rol'] !== 'admin') {
    die('Acceso denegado');
}

$conexion = new mysqli('localhost', 'root', '', 'ro_componentes');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);

    // Validar que todos los campos estén completos
    if (empty($nombre) || empty($categoria) || $precio <= 0 || $stock < 0) {
        header('Location: index.php?error=datos_invalidos');
        exit;
    }

    $sql = "INSERT INTO productos (nomPro, categoria, prePro, stkPro) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ssdi', $nombre, $categoria, $precio, $stock);

    if ($stmt->execute()) {
        header('Location: index.php?success=producto');
    } else {
        header('Location: index.php?error=producto');
    }
}
?>
