<?php
// Habilitar reporte de errores para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers para CORS y JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$conexion = new mysqli('localhost', 'root', '', 'ro_componentes');

// Verificar conexión
if ($conexion->connect_error) {
    echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $conexion->connect_error]);
    exit;
}

if (isset($_GET['term']) && !empty($_GET['term'])) {
    $term = $conexion->real_escape_string($_GET['term']);
    
    // Buscar productos que coincidan con el término
    $sql = "SELECT codPro, nomPro, stkPro, categoria FROM productos 
            WHERE nomPro LIKE '%$term%' 
            ORDER BY nomPro ASC 
            LIMIT 10";
    
    $result = $conexion->query($sql);
    $productos = [];
    
    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = [
                    'id' => (int)$row['codPro'],
                    'nombre' => $row['nomPro'],
                    'stock' => (int)$row['stkPro'],
                    'categoria' => $row['categoria'] ?? 'Sin categoría'
                ];
            }
        }
        echo json_encode($productos);
    } else {
        echo json_encode(['error' => 'Error en la consulta: ' . $conexion->error]);
    }
} else {
    echo json_encode(['error' => 'Parámetro term requerido y no puede estar vacío']);
}

$conexion->close();
?>
