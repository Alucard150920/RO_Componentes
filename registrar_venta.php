<?php
session_start();
header('Content-Type: application/json');

// Validar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para realizar una compra']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Configuración de base de datos
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ro_componentes';

$conexion = new mysqli($host, $username, $password, $database);

if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos']);
    exit;
}

// Configurar charset
$conexion->set_charset('utf8');

// Obtener y validar datos JSON
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos JSON inválidos']);
    exit;
}

$producto_id = intval($data['producto_id'] ?? 0);
$cantidad = intval($data['cantidad'] ?? 0);

// Validar datos
if ($producto_id <= 0 || $cantidad <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos inválidos: ID del producto y cantidad deben ser positivos']);
    exit;
}

try {
    // Iniciar transacción
    $conexion->begin_transaction();

    // Validar que el producto existe y obtener stock
    $stmt = $conexion->prepare("SELECT codPro, nomPro, stkPro FROM productos WHERE codPro = ?");
    if (!$stmt) {
        throw new Exception('Error al preparar consulta de producto');
    }
    
    $stmt->bind_param('i', $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $stmt->close();

    if (!$producto) {
        throw new Exception('Producto no encontrado');
    }

    if ($producto["stkPro"] < $cantidad) {
        throw new Exception('Stock insuficiente. Stock disponible: ' . $producto["stkPro"]);
    }

    // Registrar venta
    $stmt = $conexion->prepare("INSERT INTO ventas (codPro, canVen, fecVen, codUsu) VALUES (?, ?, NOW(), ?)");
    if (!$stmt) {
        throw new Exception('Error al preparar consulta de venta');
    }
    
    $stmt->bind_param('iii', $producto_id, $cantidad, $usuario_id);
    if (!$stmt->execute()) {
        throw new Exception('Error al registrar la venta: ' . $stmt->error);
    }
    
    $venta_id = $conexion->insert_id;
    $stmt->close();

    // Actualizar stock
    $stmt = $conexion->prepare("UPDATE productos SET stkPro = stkPro - ? WHERE codPro = ?");
    if (!$stmt) {
        throw new Exception('Error al preparar consulta de actualización de stock');
    }
    
    $stmt->bind_param('ii', $cantidad, $producto_id);
    if (!$stmt->execute()) {
        throw new Exception('Error al actualizar el stock: ' . $stmt->error);
    }
    
    if ($stmt->affected_rows === 0) {
        throw new Exception('No se pudo actualizar el stock del producto');
    }
    $stmt->close();

    // Confirmar transacción
    $conexion->commit();
    
    // Respuesta exitosa con información adicional
    echo json_encode([
        'success' => true, 
        'message' => '🛒 Venta registrada correctamente',
        'data' => [
            'venta_id' => $venta_id,
            'producto' => $producto['nomPro'],
            'cantidad' => $cantidad,
            'stock_restante' => $producto["stkPro"] - $cantidad
        ]
    ]);

} catch (Exception $e) {
    // Rollback en caso de error
    $conexion->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    // Cerrar conexión
    $conexion->close();
}
?>
