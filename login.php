<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "ro_componentes");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    // Ahora también seleccionamos el rol
    $sql = "SELECT codUsu, nomUsu, pasUsu, rol FROM usuarios WHERE emaUsu = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nombre, $hash, $rol);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION["usuario_id"] = $id;
            $_SESSION["usuario_nombre"] = $nombre;
            $_SESSION["usuario_rol"] = $rol; // 👉 Guardar el rol en la sesión

            header("Location: index.php");
            exit;
        } else {
            $error = "❌ Contraseña incorrecta.";
        }
    } else {
        $error = "❌ Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - RO Componentes</title>
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
                <div class="col-lg-9 hero-content">
                    <h2 class="hero-title fade-in text-cente">🔒 Inicio de Sesión del Usuario</h2>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="hero-image fade-in">
                        <i class="fas fa-key" style="font-size: 6rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card card-modern fade-in">
                        <div class="card-body card-body-modern">
                            <h2 class="section-title text-center mb-4">🔒 Iniciar Sesión</h2>
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger-modern mb-3" role="alert">
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo electrónico</label>
                                    <input type="email" name="correo" id="correo" class="form-control input-modern" placeholder="correo@ejemplo.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" name="password" id="password" class="form-control input-modern" placeholder="********" required>
                                </div>
                                <button type="submit" class="btn-professional w-100 mt-3">Ingresar</button>
                            </form>
                            <p class="text-center text-muted mt-3">
                                ¿No tienes cuenta? <a href="registro.php" class="text-primary">Regístrate aquí</a>
                            </p>
                            <p class="text-center text-muted">
                                <a href="home.php" class="text-primary">← Volver al inicio</a>
                            </p>
                        </div>
                    </div>
                </div>
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