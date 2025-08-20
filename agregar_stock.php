<?php
session_start();
if ($_SESSION['usuario_rol'] !== 'admin') {
    die('Acceso denegado');
}

$conexion = new mysqli('localhost', 'root', '', 'ro_componentes');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = intval($_POST['producto_id']);
    $cantidad = intval($_POST['cantidad']);

    // Validar que los datos sean válidos
    if ($producto_id <= 0 || $cantidad <= 0) {
        header('Location: index.php?error=datos_invalidos');
        exit;
    }

    // Verificar que el producto existe
    $check_sql = "SELECT codPro FROM productos WHERE codPro = ?";
    $check_stmt = $conexion->prepare($check_sql);
    $check_stmt->bind_param('i', $producto_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows === 0) {
        header('Location: index.php?error=producto_no_existe');
        exit;
    }

    $sql = "UPDATE productos SET stkPro = stkPro + ? WHERE codPro = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ii', $cantidad, $producto_id);

    if ($stmt->execute()) {
        header('Location: index.php?success=stock');
    } else {
        header('Location: index.php?error=stock');
    }
}
?>
