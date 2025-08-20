<?php
header("Content-Type: application/json");

$conexion = new mysqli("localhost", "root", "", "ro_componentes");

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error en la conexión: " . $conexion->connect_error]));
}

// Parámetros de paginación
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? (int)$_GET["limit"] : 12;
$offset = ($page - 1) * $limit;

// Parámetro de búsqueda
$search = isset($_GET["search"]) ? $_GET["search"] : "";

// Construir consulta con paginación y búsqueda
$where_clause = "";
$params = [];
$types = "";

if (!empty($search)) {
    $where_clause = "WHERE nomPro LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}

// Consulta con paginación
$sql = "SELECT codPro as id, nomPro as nombre, prePro as precio, stkPro as stock 
        FROM productos 
        $where_clause 
        ORDER BY nomPro ASC 
        LIMIT ? OFFSET ?";

// Añadir limit y offset a los parámetros
$params[] = $limit;
$params[] = $offset;
$types .= "ii";

$stmt = $conexion->prepare($sql);

// Usar call_user_func_array para bind_param si la versión de PHP es antigua o hay problemas con ...$params
// O simplemente pasar los parámetros directamente si se sabe que son variables
if (!empty($params)) {
    // Para PHP 5.6+ ...$params es la forma correcta.
    // Si el error persiste, podría ser un problema de configuración de PHP o una versión muy antigua.
    // Una alternativa más compatible con versiones antiguas sería:
    // call_user_func_array([$stmt, 'bind_param'], array_merge([$types], $params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$resultado = $stmt->get_result();

$productos = [];
while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

// Obtener total de productos para paginación
$count_sql = "SELECT COUNT(*) as total FROM productos $where_clause";
$count_stmt = $conexion->prepare($count_sql);

if (!empty($search)) {
    // Para la consulta de conteo, solo el parámetro de búsqueda si existe
    $count_stmt->bind_param("s", $params[0]); // $params[0] contendrá el valor de búsqueda
}

$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total = $count_result->fetch_assoc()["total"];

$response = [
    "productos" => $productos,
    "pagination" => [
        "current_page" => $page,
        "total_pages" => ceil($total / $limit),
        "total_items" => $total,
        "items_per_page" => $limit
    ]
];

echo json_encode($response);

$stmt->close();
$count_stmt->close();
$conexion->close();
?>