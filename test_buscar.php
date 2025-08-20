<?php
// Archivo de prueba para debuggear la búsqueda
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test de Búsqueda de Productos</h2>";

$conexion = new mysqli('localhost', 'root', '', 'ro_componentes');

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "<p>✅ Conexión a base de datos exitosa</p>";

// Probar consulta básica
$sql = "SELECT COUNT(*) as total FROM productos";
$result = $conexion->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    echo "<p>📊 Total de productos en BD: " . $row['total'] . "</p>";
} else {
    echo "<p>❌ Error al contar productos: " . $conexion->error . "</p>";
}

// Probar búsqueda con término específico
$term = "Procesador";
$sql = "SELECT codPro, nomPro, stkPro, categoria FROM productos WHERE nomPro LIKE '%$term%' LIMIT 5";
$result = $conexion->query($sql);

echo "<h3>Búsqueda con término '$term':</h3>";
if ($result && $result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>ID: {$row['codPro']} - {$row['nomPro']} (Stock: {$row['stkPro']})</li>";
    }
    echo "</ul>";
} else {
    echo "<p>❌ No se encontraron productos o error: " . $conexion->error . "</p>";
}

// Simular la llamada AJAX
if (isset($_GET['term'])) {
    $term = $conexion->real_escape_string($_GET['term']);
    $sql = "SELECT codPro, nomPro, stkPro, categoria FROM productos 
            WHERE nomPro LIKE '%$term%' 
            ORDER BY nomPro ASC 
            LIMIT 10";
    
    $result = $conexion->query($sql);
    $productos = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = [
                'id' => $row['codPro'],
                'nombre' => $row['nomPro'],
                'stock' => $row['stkPro'],
                'categoria' => $row['categoria']
            ];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($productos);
    exit;
}

echo "<h3>Probar búsqueda AJAX:</h3>";
echo "<p><a href='test_buscar.php?term=Procesador'>Buscar 'Procesador'</a></p>";
echo "<p><a href='test_buscar.php?term=RAM'>Buscar 'RAM'</a></p>";
echo "<p><a href='test_buscar.php?term=SSD'>Buscar 'SSD'</a></p>";

$conexion->close();
?>

