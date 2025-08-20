<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$conexion = new mysqli("localhost", "root", "", "ro_componentes");
$usuario_id = $_SESSION["usuario_id"];
$sql = "SELECT v.codVen, p.nomPro, v.canVen, v.fecVen, (p.prePro * v.canVen) AS total
        FROM ventas v
        JOIN productos p ON v.codPro = p.codPro
        WHERE v.codUsu = ?
        ORDER BY v.fecVen DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras - RO Componentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .page-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: bold;
        }
        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .table td {
            border: 1px solid #e9ecef;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f8f9ff;
            transition: background-color 0.3s ease;
        }
        .btn-back {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            color: white;
            text-decoration: none;
        }
        .total-badge {
            background: linear-gradient(45deg, #f093fb, #f5576c);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title">
                <i class="fas fa-shopping-bag me-2"></i>
                Mis Compras - <?= htmlspecialchars($_SESSION["usuario_nombre"]) ?>
            </h2>
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <?php if ($resultado->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-2"></i>ID Compra</th>
                                    <th><i class="fas fa-box me-2"></i>Producto</th>
                                    <th><i class="fas fa-sort-numeric-up me-2"></i>Cantidad</th>
                                    <th><i class="fas fa-calendar me-2"></i>Fecha</th>
                                    <th><i class="fas fa-dollar-sign me-2"></i>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $totalGeneral = 0;
                                while($row = $resultado->fetch_assoc()): 
                                    $totalGeneral += $row["total"];
                                ?>
                                <tr>
                                    <td><strong>#<?= $row["codVen"] ?></strong></td>
                                    <td>
                                        <i class="fas fa-microchip text-primary me-2"></i>
                                        <?= htmlspecialchars($row["nomPro"]) ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary"><?= $row["canVen"] ?></span>
                                    </td>
                                    <td>
                                        <i class="fas fa-clock text-muted me-1"></i>
                                        <?= date("d/m/Y H:i", strtotime($row["fecVen"])) ?>
                                    </td>
                                    <td>
                                        <span class="total-badge">S/ <?= number_format($row["total"], 2) ?></span>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <h4 class="text-success">
                            <i class="fas fa-calculator me-2"></i>
                            Total Gastado: <strong>S/ <?= number_format($totalGeneral, 2) ?></strong>
                        </h4>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h4>No tienes compras registradas</h4>
                        <p class="text-muted">¡Explora nuestro catálogo y realiza tu primera compra!</p>
                        <a href="index.php" class="btn-back">
                            <i class="fas fa-shopping-bag me-2"></i>Ir al catálogo
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

