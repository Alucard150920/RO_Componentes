<?php
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'success' => false,
        'message' => '🔒 Debes iniciar sesión para realizar una compra'
    ]);
    exit;
}

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => '❌ Método no permitido'
    ]);
    exit;
}

// Obtener datos del carrito
$input = file_get_contents('php://input');
$carrito = json_decode($input, true);

if (!$carrito || !is_array($carrito) || empty($carrito)) {
    echo json_encode([
        'success' => false,
        'message' => '🛒 El carrito está vacío'
    ]);
    exit;
}

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'ro_componentes');

if ($conexion->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => '❌ Error de conexión a la base de datos'
    ]);
    exit;
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    $usuario_id = $_SESSION['usuario_id'];
    $fecha_venta = date('Y-m-d H:i:s');
    $total_venta = 0;
    $ventas_registradas = [];

    // Validar stock y calcular total
    foreach ($carrito as $item) {
        $producto_id = $item['id'];
        $cantidad = $item['cantidad'];
        
        // Verificar stock actual (usando los nombres de columna correctos)
        $stmt = $conexion->prepare("SELECT stkPro, prePro, nomPro FROM productos WHERE codPro = ?");
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
        
        if (!$producto) {
            throw new Exception("❌ Producto no encontrado: " . $item['nombre']);
        }
        
        if ($producto['stkPro'] < $cantidad) {
            throw new Exception("❌ Stock insuficiente para: " . $producto['nomPro'] . " (Disponible: " . $producto['stkPro'] . ", Solicitado: " . $cantidad . ")");
        }
        
        $total_venta += $producto['prePro'] * $cantidad;
    }

    // Insertar cada producto como una venta individual (según tu estructura actual)
    foreach ($carrito as $item) {
        $producto_id = $item['id'];
        $cantidad = $item['cantidad'];
        
        // Insertar venta individual para cada producto
        $stmt = $conexion->prepare("INSERT INTO ventas (codPro, canVen, fecVen, codUsu) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $producto_id, $cantidad, $fecha_venta, $usuario_id);
        $stmt->execute();
        
        $ventas_registradas[] = $conexion->insert_id;
        
        // Actualizar stock
        $stmt = $conexion->prepare("UPDATE productos SET stkPro = stkPro - ? WHERE codPro = ?");
        $stmt->bind_param("ii", $cantidad, $producto_id);
        $stmt->execute();
    }

    // Confirmar transacción
    $conexion->commit();
    
    echo json_encode([
        'success' => true,
        'message' => '🎉 ¡Compra realizada con éxito! Total: S/ ' . number_format($total_venta, 2),
        'ventas_ids' => $ventas_registradas,
        'total' => $total_venta
    ]);

} catch (Exception $e) {
    // Revertir transacción en caso de error
    $conexion->rollback();
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conexion->close();
?>