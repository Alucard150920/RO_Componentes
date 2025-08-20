<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RO Componentes - Tu Tienda de Componentes PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.1)" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
        }

        .feature-icon.primary {
            background: var(--gradient-primary);
        }

        .feature-icon.success {
            background: var(--gradient-success);
        }

        .feature-icon.secondary {
            background: var(--gradient-secondary);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .feature-description {
            color: #6b7280;
            line-height: 1.6;
        }

        /* Categories Section */
        .categories-section {
            padding: 80px 0;
            background: var(--light-color);
        }

        .category-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
            color: inherit;
            text-decoration: none;
        }

        .category-image {
            height: 200px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
        }

        .category-content {
            padding: 2rem;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .category-description {
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .category-link {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: var(--gradient-primary);
            color: white;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-cta {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 1rem;
            text-align: center;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in-left {
            animation: slideInLeft 0.6s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-right {
            animation: slideInRight 0.6s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
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
                    <?php if (!isset($_SESSION['usuario_id'])): ?>
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
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title fade-in">Tu Tienda de Componentes PC de Confianza</h1>
                    <p class="hero-subtitle slide-in-left">Encuentra los mejores componentes para tu PC, laptop y periféricos con la mejor calidad y precios competitivos.</p>
                    <div class="d-flex gap-3 mb-4">
                        <a href="index.php" class="btn-primary-custom">Explorar Catálogo</a>
                        <a href="about.php" class="btn btn-outline-light">Conocer Más</a>
                    </div>
                    <div class="hero-stats slide-in-right">
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Productos</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">1000+</span>
                            <span class="stat-label">Clientes</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">99%</span>
                            <span class="stat-label">Satisfacción</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image fade-in">
                        <i class="fas fa-desktop" style="font-size: 15rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">¿Por qué elegir RO Componentes?</h2>
            <p class="section-subtitle">Ofrecemos la mejor experiencia de compra para todos tus componentes de PC</p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <div class="feature-icon primary">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="feature-title">Envío Rápido</h3>
                        <p class="feature-description">Entrega en 24-48 horas en toda la ciudad. Envío gratuito en compras superiores a $100.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <div class="feature-icon success">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Garantía Extendida</h3>
                        <p class="feature-description">Todos nuestros productos incluyen garantía extendida y soporte técnico especializado.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <div class="feature-icon secondary">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="feature-title">Soporte 24/7</h3>
                        <p class="feature-description">Nuestro equipo de expertos está disponible para ayudarte en cualquier momento.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">Nuestras Categorías</h2>
            <p class="section-subtitle">Explora nuestra amplia gama de productos organizados por categorías</p>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a href="componentes_pc.php" class="category-card">
                        <div class="category-image">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div class="category-content">
                            <h3 class="category-title">Componentes PC</h3>
                            <p class="category-description">Procesadores, tarjetas gráficas, memorias RAM, discos duros y más.</p>
                            <span class="category-link">Ver productos <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="componentes_laptop.php" class="category-card">
                        <div class="category-image">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div class="category-content">
                            <h3 class="category-title">Componentes Laptop</h3>
                            <p class="category-description">Baterías, cargadores, memorias y componentes específicos para laptops.</p>
                            <span class="category-link">Ver productos <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="perifericos.php" class="category-card">
                        <div class="category-image">
                            <i class="fas fa-mouse"></i>
                        </div>
                        <div class="category-content">
                            <h3 class="category-title">Periféricos</h3>
                            <p class="category-description">Teclados, ratones, monitores, auriculares y accesorios gaming.</p>
                            <span class="category-link">Ver productos <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">¿Listo para armar tu PC ideal?</h2>
            <p class="cta-description">Explora nuestro catálogo completo y encuentra todo lo que necesitas</p>
            <a href="index.php" class="btn-cta">Comenzar a Comprar</a>
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
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

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

