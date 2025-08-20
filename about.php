<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de - RO Componentes</title>
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
                <div class="col-lg-12 hero-content">
                    <h2 class="hero-title fade-in text-center">🌟 Nuestro Equipo</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-modern">
                        <div class="card-body card-body-modern text-center">
                            <h2 class="section-title mb-4 fade-in">🌟 Acerca de RO Componentes</h2>
                            <p class="lead mb-4 fade-in">
                                En <strong>RO Componentes</strong>, somos un equipo apasionado por la tecnología, comprometido en brindar soluciones de hardware confiables y de calidad.
                                Nuestra misión es ser tu socio de confianza en la construcción y mejora de tus equipos, ofreciendo productos de alta calidad y un servicio al cliente excepcional.
                            </p>
                            <p class="fade-in">
                                Creemos que la tecnología debe ser accesible para todos, por eso nos esforzamos en ofrecer una amplia gama de componentes a precios competitivos, sin comprometer la calidad.
                                Desde procesadores de última generación hasta periféricos ergonómicos, cada producto en nuestro catálogo es seleccionado cuidadosamente para asegurar el mejor rendimiento y durabilidad.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="team mt-5">
                <h3 class="section-title mb-4 fade-in">👥 Nuestro Equipo</h3>
                <div class="row justify-content-center g-4">
                    <div class="col-md-4 col-sm-6">
                        <div class="card card-modern text-center fade-in">
                            <img src="assets/team1.jpg" class="img-fluid rounded-circle mx-auto mt-4" alt="Renzo Orosco" style="width: 150px; height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">Renzo Orosco</h5>
                                <p class="card-text text-muted">Fundador & CEO</p>
                                <div class="d-flex justify-content-center gap-3 mt-3">
                                    <a href="#" class="text-primary"><i class="fab fa-linkedin fa-lg"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-twitter fa-lg"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-github fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Puedes añadir más miembros del equipo aquí -->
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
