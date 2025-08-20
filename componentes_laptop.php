<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "ro_componentes");
$productos = [];

if (!$conexion->connect_error) {
    $sql = "SELECT * FROM productos WHERE categoria = 'Componentes Laptop'";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $productos[] = $row;
        }
    }
}

// Definimos el mapa de iconos (mismo que el tuyo pero en PHP para usarlo directamente)
$componentIcons = [
    'procesador' => 'fas fa-microchip',
    'cpu'        => 'fas fa-microchip',
    'memoria'    => 'fas fa-memory',
    'ram'        => 'fas fa-memory',
    'disco'      => 'fas fa-hdd',
    'ssd'        => 'fas fa-hdd',
    'tarjeta'    => 'fas fa-tv',
    'gpu'        => 'fas fa-tv',
    'placa'      => 'fas fa-server',
    'mother'     => 'fas fa-server',
    'fuente'     => 'fas fa-plug',
    'power'      => 'fas fa-plug',
    'gabinete'   => 'fas fa-desktop',
    'mouse'      => 'fas fa-mouse',
    'teclado'    => 'fas fa-keyboard',
    'monitor'    => 'fas fa-desktop',
    'default'    => 'fas fa-laptop'
];

// Función para detectar ícono
function getComponentIcon($nombre, $icons) {
    $nombreLower = strtolower($nombre);
    foreach ($icons as $key => $icon) {
        if ($key !== 'default' && strpos($nombreLower, $key) !== false) {
            return $icon;
        }
    }
    return $icons['default'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componentes Laptop - RO Componentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <i class="fas fa-microchip me-2"></i>RO Componentes
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="componentes_pc.php">Componentes PC</a></li>
                            <li><a class="dropdown-item" href="componentes_laptop.php">Componentes Laptop</a></li>
                            <li><a class="dropdown-item" href="perifericos.php">Periféricos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contacto</a>
                    </li>
                </ul>
                
                <div class="d-flex gap-2">
                    <?php if (!isset($_SESSION["usuario_id"])): ?>
                        <a href="login.php" class="btn btn-outline-primary">Iniciar Sesión</a>
                        <a href="registro.php" class="btn-primary-custom">Registrarse</a>
                    <?php else: ?>
                        <a href="mis_compras.php" class="btn btn-outline-primary">Mis Compras</a>
                        <a href="index.php" class="btn-primary-custom">Ir a Tienda</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h2 class="hero-title fade-in text-cente">🖥️ Componentes Laptop</h2>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="hero-image fade-in">
                        <i class="fas fa-laptop" style="font-size: 6rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <?php if (count($productos) > 0): ?>
                    <?php foreach ($productos as $producto): 
                        $icono = getComponentIcon($producto['nomPro'], $componentIcons);
                    ?>
                        <div class="col-md-4 fade-in product-item" 
                             data-name="<?= strtolower(htmlspecialchars($producto['nomPro'])) ?>" 
                             data-id="<?= htmlspecialchars($producto['codPro']) ?>">
                            <div class="card product-card">
                                <div class="card-header-custom text-center">
                                    <i class="<?= $icono ?> product-icon"></i>
                                    <h5 class="mb-0"><?= htmlspecialchars($producto['nomPro']) ?></h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="price-tag">
                                        <i class="fas fa-tags me-2"></i>S/ <?= htmlspecialchars($producto['prePro']) ?>
                                    </div>
                                    <div class="mt-3">
                                        <span class="stock-badge">
                                            <i class="fas fa-boxes me-1"></i>Stock: <?= htmlspecialchars($producto['stkPro']) ?>
                                        </span>
                                    </div>
                                    <div class="mt-3">
                                        <input type="number" 
                                               min="1" 
                                               max="<?= htmlspecialchars($producto['stkPro']) ?>" 
                                               class="form-control quantity-input mb-3" 
                                               placeholder="Cantidad" 
                                               id="cantidad-<?= htmlspecialchars($producto['codPro']) ?>" />
                                        <button class="btn btn-add-cart" 
                                                onclick="agregarAlCarrito(<?= htmlspecialchars($producto['codPro']) ?>, '<?= htmlspecialchars($producto['nomPro']) ?>', <?= htmlspecialchars($producto['prePro']) ?>, <?= htmlspecialchars($producto['stkPro']) ?>)">
                                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No hay productos disponibles.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>RO Componentes</h5>
                    <p>Tu tienda de confianza para componentes de PC, laptops y periféricos.</p>
                </div>
                <div class="footer-section">
                    <h5>Productos</h5>
                    <ul class="list-unstyled">
                        <li><a href="componentes_pc.php">Componentes PC</a></li>
                        <li><a href="componentes_laptop.php">Componentes Laptop</a></li>
                        <li><a href="perifericos.php">Periféricos</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Empresa</h5>
                    <ul class="list-unstyled">
                        <li><a href="about.php">Acerca de</a></li>
                        <li><a href="contact.php">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Cuenta</h5>
                    <ul class="list-unstyled">
                        <?php if (!isset($_SESSION['usuario_id'])): ?>
                            <li><a href="login.php">Iniciar Sesión</a></li>
                            <li><a href="registro.php">Registrarse</a></li>
                        <?php else: ?>
                            <li><a href="mis_compras.php">Mis Compras</a></li>
                            <li><a href="logout.php">Cerrar Sesión</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 RO Componentes. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            observer.observe(el);
        });
    </script>
</body>
</html>