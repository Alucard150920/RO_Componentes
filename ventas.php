<?php
$conexion = new mysqli('localhost', 'root', '', 'ro_componentes');
$ventas = [];

$fechaInicio = $_GET['inicio'] ?? '';
$fechaFin = $_GET['fin'] ?? '';

$where = '';
if ($fechaInicio && $fechaFin) {
    $where = "WHERE v.fecVen BETWEEN '$fechaInicio' AND '$fechaFin'";
}

if (!$conexion->connect_error) {
    $sql = "SELECT v.codVen, p.nomPro AS producto, v.canVen, v.fecVen, (p.prePro * v.canVen) AS total, u.nomUsu AS cliente
            FROM ventas v
            JOIN productos p ON v.codPro = p.codPro
            LEFT JOIN usuarios u ON v.codUsu = u.codUsu
            $where
            ORDER BY v.fecVen DESC";
    $resultado = $conexion->query($sql);
    while ($fila = $resultado->fetch_assoc()) {
        $ventas[] = $fila;
    }
}

// 1. Ventas por fecha
$sql = "SELECT DATE(v.fecVen) AS fecha, SUM(p.prePro * v.canVen) AS total
        FROM ventas v
        JOIN productos p ON v.codPro = p.codPro
        GROUP BY DATE(v.fecVen)
        ORDER BY fecha";
$ventasPorFecha = [];
$res = $conexion->query($sql);
while ($row = $res->fetch_assoc()) {
    $ventasPorFecha[$row['fecha']] = $row['total'];
}

// 2. Ventas por categoría
$sql = "SELECT p.categoria, SUM(v.canVen) AS cantidad
        FROM ventas v
        JOIN productos p ON v.codPro = p.codPro
        GROUP BY p.categoria";
$ventasPorCategoria = [];
$res = $conexion->query($sql);
while ($row = $res->fetch_assoc()) {
    $ventasPorCategoria[$row['categoria']] = $row['cantidad'];
}

// 3. Top 5 productos
$sql = "SELECT p.nomPro, SUM(v.canVen) AS cantidad
        FROM ventas v
        JOIN productos p ON v.codPro = p.codPro
        GROUP BY p.nomPro
        ORDER BY cantidad DESC
        LIMIT 5";
$topProductos = [];
$res = $conexion->query($sql);
while ($row = $res->fetch_assoc()) {
    $topProductos[$row['nomPro']] = $row['cantidad'];
}

// 4. Ventas por cliente
$sql = "SELECT u.nomUsu, SUM(v.canVen) AS cantidad
        FROM ventas v
        JOIN usuarios u ON v.codUsu = u.codUsu
        GROUP BY u.nomUsu";
$ventasPorUsuario = [];
$res = $conexion->query($sql);
while ($row = $res->fetch_assoc()) {
    $ventasPorUsuario[$row['nomUsu']] = $row['cantidad'];
}

// === Resumen general ===
$totalGeneral = array_sum(array_column($ventas, 'total'));
$totalVentas = count($ventas);
$totalProductosVendidos = array_sum(array_column($ventas, 'canVen'));
$totalClientes = count($ventasPorUsuario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Ventas - RO Componentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
            min-height: 100vh;
        }
        h2 {
            background: linear-gradient(to right, #0d6efd, #0dcaf0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }
        .btn-gradient {
            background: linear-gradient(to right, #0d6efd, #0dcaf0);
            color: white;
            border: none;
            transition: transform 0.2s ease;
        }
        .btn-gradient:hover {
            transform: scale(1.05);
            background: linear-gradient(to right, #0dcaf0, #0d6efd);
        }
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        thead.table-dark {
            background: linear-gradient(to right, #212529, #343a40) !important;
        }
        tr:hover {
            background-color: #e2f0ff !important;
            transition: background-color 0.3s ease;
        }
        .card-header {
            background: linear-gradient(to right, #0d6efd, #0dcaf0);
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4"><i class="bi bi-clipboard-data"></i> Historial de Ventas</h2>
    <a href="index.php" class="btn btn-outline-secondary mb-3"><i class="bi bi-arrow-left-circle"></i> Volver al catálogo</a>

    <!-- Resumen -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <i class="bi bi-cash-stack fs-2 text-success"></i>
                    <h6>Total Ventas (S/)</h6>
                    <h4 class="fw-bold">S/ <?= number_format($totalGeneral, 2) ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <i class="bi bi-receipt fs-2 text-primary"></i>
                    <h6>Número de Ventas</h6>
                    <h4 class="fw-bold"><?= $totalVentas ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <i class="bi bi-box-seam fs-2 text-warning"></i>
                    <h6>Productos Vendidos</h6>
                    <h4 class="fw-bold"><?= $totalProductosVendidos ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <i class="bi bi-people fs-2 text-info"></i>
                    <h6>Clientes</h6>
                    <h4 class="fw-bold"><?= $totalClientes ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtro por fechas -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="inicio" class="form-label">Desde:</label>
            <input type="date" name="inicio" id="inicio" class="form-control" value="<?= $fechaInicio ?>">
        </div>
        <div class="col-md-4">
            <label for="fin" class="form-label">Hasta:</label>
            <input type="date" name="fin" id="fin" class="form-control" value="<?= $fechaFin ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-gradient w-100"><i class="bi bi-funnel"></i> Filtrar</button>
        </div>
    </form>

    <!-- Tabla -->
    <div class="table-responsive shadow bg-white p-3">
        <table id="tablaVentas" class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID Venta</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total (S/)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= $venta['codVen'] ?></td>
                    <td><?= $venta['producto'] ?></td>
                    <td><span class='badge bg-primary'><?= $venta['canVen'] ?></span></td>
                    <td><?= $venta['fecVen'] ?></td>
                    <td><?= $venta['cliente'] ?? '---' ?></td>
                    <td><strong>S/ <?= number_format($venta['total'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Gráficos -->
    <div class="card mt-5 shadow">
        <div class="card-header text-white">
            <i class="bi bi-graph-up"></i> Ventas por Fecha
        </div>
        <div class="card-body">
            <canvas id="graficoVentas"></canvas>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white"><i class="bi bi-pie-chart-fill"></i> Ventas por Categoría</div>
                <div class="card-body"><canvas id="graficoCategorias"></canvas></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white"><i class="bi bi-bar-chart-steps"></i> Top 5 Productos</div>
                <div class="card-body"><canvas id="graficoTopProductos"></canvas></div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white"><i class="bi bi-person-lines-fill"></i> Ventas por Cliente</div>
                <div class="card-body"><canvas id="graficoUsuarios"></canvas></div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablaVentas').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: '<i class="bi bi-file-earmark-pdf"></i> Exportar PDF',
                    className: 'btn btn-danger',
                    title: 'Historial de Ventas - RO Componentes',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-earmark-excel"></i> Exportar Excel',
                    className: 'btn btn-success',
                    title: 'Historial de Ventas - RO Componentes',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i> Imprimir',
                    className: 'btn btn-secondary',
                    title: 'Historial de Ventas - RO Componentes'
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });
    });

    // 1. Ventas por fecha
    new Chart(document.getElementById('graficoVentas'), {
        type: 'line',
        data: {
            labels: <?= json_encode(array_keys($ventasPorFecha)) ?>,
            datasets: [{
                label: 'Ventas por Fecha',
                data: <?= json_encode(array_values($ventasPorFecha)) ?>,
                fill: true,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.2)',
                tension: 0.3
            }]
        },
        options: { responsive: true }
    });

    // 2. Ventas por categoría
    new Chart(document.getElementById('graficoCategorias'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_keys($ventasPorCategoria)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($ventasPorCategoria)) ?>,
                backgroundColor: ['#0d6efd','#0dcaf0','#ffc107','#198754','#d63384']
            }]
        }
    });

    // 3. Top productos
    new Chart(document.getElementById('graficoTopProductos'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($topProductos)) ?>,
            datasets: [{
                label: 'Cantidad vendida',
                data: <?= json_encode(array_values($topProductos)) ?>,
                backgroundColor: '#198754'
            }]
        },
        options: { indexAxis: 'y', responsive: true }
    });

    // 4. Ventas por cliente
    new Chart(document.getElementById('graficoUsuarios'), {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_keys($ventasPorUsuario)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($ventasPorUsuario)) ?>,
                backgroundColor: ['#6610f2','#6f42c1','#fd7e14','#20c997']
            }]
        }
    });
</script>
</body>
</html>
