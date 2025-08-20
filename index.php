<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RO Componentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="assets/style.css" rel="stylesheet">
    
    <style>
        /* Estilos para la paginación */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0;
            gap: 15px;
        }
        
        .pagination-info {
            color: #666;
            font-size: 14px;
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid #dee2e6;
        }
        
        .pagination-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .pagination-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .pagination-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php"><i class="fas fa-microchip me-2"></i>RO Componentes</a>
            
            <!-- Botón para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="col-md-6 col-xs-6 text-center menu-1 mx-auto">
                    <ul class="navbar-nav d-flex justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="home.php">
                                <i class="fas fa-home me-1"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item dropdown has-dropdown position-relative">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-laptop me-1"></i> Componentes
                            </a>
                            <ul class="dropdown-menu animate__animated animate__fadeIn animate__faster shadow rounded-3 p-2">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="perifericos.php">
                                        <i class="fas fa-mouse"></i> Periféricos
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="componentes_pc.php">
                                        <i class="fas fa-microchip"></i> Componentes PC
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="componentes_laptop.php">
                                        <i class="fas fa-laptop"></i> Componentes Laptop
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="about.php">
                                <i class="fas fa-info-circle me-1"></i> Nosotros
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-1" href="contact.php">
                                <i class="fas fa-envelope me-1"></i> Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Barra de búsqueda -->
            <div class="d-flex me-3 search-container">
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control search-input" placeholder="Buscar componentes..." id="searchInput">
                    <button class="btn btn-search" type="button" onclick="buscarProductos()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="search-suggestions" id="searchSuggestions"></div>
            </div>
            
            

            <div class="text-end">
                <?php if (!isset($_SESSION["usuario_id"])): ?>
                    <a href="login.php" class="btn btn-cart btn-sm my-2">
                        <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión
                    </a>
                    <a href="registro.php" class="btn btn-history btn-sm">
                        <i class="fas fa-user-plus me-1"></i> Registrarse
                    </a>
                <?php else: ?>
                    <span class="text-dark me-2">
                        👋 Hola, <?= htmlspecialchars($_SESSION["usuario_nombre"]) ?>
                    </span>
                    <a href="mis_compras.php" class="btn btn-cart btn-sm my-2">
                        <i class="fas fa-box-open me-1"></i> Mis Compras
                    </a>
                    <a href="logout.php" class="btn btn-history btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                    </a>
                <?php endif; ?>
                <button class="btn btn-cart" type="button" data-bs-toggle="offcanvas" data-bs-target="#carritoOffcanvas">
                    <i class="fas fa-shopping-cart me-2"></i>Carrito
                </button>
            </div>


        </div>
    </nav>

    <section class="hero-section">
        <div class="container mt-5 text-center">
            <div class="row align-items-center">
                <div class="col-lg-12 hero-content">
                    <h2 class="hero-title mb-4"><i class="fas fa-laptop me-3"></i>Catálogo de Componentes PC</h2>
                    <?php if (isset($_SESSION["usuario_rol"]) && $_SESSION["usuario_rol"] === "admin"): ?>
                        <!-- Botón solo para admin -->
                        <div class="d-flex justify-content-center mx-3 my-3 gap-3">
                            <a href="ventas.php" class="btn-history">
                                <i class="fas fa-chart-line me-1"></i>Ver Historial de Ventas
                            </a>
                            <button class="btn btn-cart" data-bs-toggle="modal" data-bs-target="#modalAgregarStock">
                                <i class="fas fa-plus-circle me-1"></i> Agregar Stock
                            </button>
                            <button class="btn-history" data-bs-toggle="modal" data-bs-target="#modalNuevoProducto">
                                <i class="fas fa-box-open me-1"></i> Agregar Nuevo Producto
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4">    
        <div class="loading-spinner" id="loading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="mt-2">Cargando productos...</p>
        </div>
        
        <div class="row" id="product-list">
            <!-- Productos dinámicos -->
        </div>
        
        <!-- Paginación -->
        <div class="pagination-container" id="paginationContainer" style="display: none;">
            <button class="btn pagination-btn" id="prevPage" onclick="cambiarPagina(-1)">
                <i class="fas fa-chevron-left me-1"></i>Anterior
            </button>
            <div class="pagination-info" id="paginationInfo"></div>
            <button class="btn pagination-btn" id="nextPage" onclick="cambiarPagina(1)">
                Siguiente<i class="fas fa-chevron-right ms-1"></i>
            </button>
        </div>
        
        <div class="no-results" id="noResults" style="display: none;">
            <i class="fas fa-search fa-3x mb-3" style="color: #ccc;"></i>
            <h4>No se encontraron productos</h4>
            <p>Intenta con otros términos de búsqueda</p>
            <button class="btn btn-primary" onclick="limpiarBusqueda()">
                <i class="fas fa-undo me-2"></i>Ver todos los productos
            </button>
        </div>
    </div>

    <script>
        let carrito = [];
        let todosLosProductos = []; // Array para almacenar todos los productos para sugerencias
        let paginaActual = 1;
        let totalPaginas = 1;
        let terminoBusqueda = "";
        let modoVistaTodos = true; // Para saber si estamos viendo todos los productos o búsqueda

        // Mostrar spinner de carga
        document.getElementById("loading").style.display = "block";

        if (localStorage.getItem("carrito")) {
            carrito = JSON.parse(localStorage.getItem("carrito"));
        }

        // Iconos para diferentes tipos de componentes
        const componentIcons = {
            "procesador": "fas fa-microchip",
            "cpu": "fas fa-microchip",
            "memoria": "fas fa-memory",
            "ram": "fas fa-memory",
            "disco": "fas fa-hdd",
            "ssd": "fas fa-hdd",
            "tarjeta": "fas fa-tv",
            "gpu": "fas fa-tv",
            "placa": "fas fa-server",
            "mother": "fas fa-server",
            "fuente": "fas fa-plug",
            "power": "fas fa-plug",
            "gabinete": "fas fa-desktop",
            "mouse": "fas fa-mouse",
            "teclado": "fas fa-keyboard",
            "monitor": "fas fa-desktop",
            "default": "fas fa-microchip"
        };

        function getComponentIcon(nombre) {
            const nombreLower = nombre.toLowerCase();
            for (let key in componentIcons) {
                if (nombreLower.includes(key)) {
                    return componentIcons[key];
                }
            }
            return componentIcons.default;
        }

        // Función para cargar productos con paginación
        function cargarProductos(pagina = 1, busqueda = "") {
            const url = new URL("catalogo.php", window.location.origin + window.location.pathname.replace("index.php", ""));
            url.searchParams.append("page", pagina);
            url.searchParams.append("limit", 12);
            if (busqueda) {
                url.searchParams.append("search", busqueda);
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Ocultar spinner
                    document.getElementById("loading").style.display = "none";
                    
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    
                    // Actualizar variables globales
                    paginaActual = data.pagination.current_page;
                    totalPaginas = data.pagination.total_pages;
                    
                    // Cargar todos los productos para las sugerencias si no están ya cargados
                    if (todosLosProductos.length === 0) {
                        fetch("catalogo.php") // Usar el catalogo.php original para obtener todos los productos
                            .then(response => response.json())
                            .then(productos => {
                                todosLosProductos = productos;
                            });
                    }
                    
                    mostrarProductos(data.productos);
                    actualizarPaginacion(data.pagination);
                    actualizarCarrito(); // Esto dibuja el carrito si ya tenía cosas guardadas
                })
                .catch(error => {
                    document.getElementById("loading").innerHTML = `
                        <div class="alert alert-danger text-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Error al cargar los productos. Por favor, recarga la página.
                        </div>
                    `;
                });
        }

        // Función para actualizar la paginación
        function actualizarPaginacion(pagination) {
            const paginationContainer = document.getElementById("paginationContainer");
            const paginationInfo = document.getElementById("paginationInfo");
            const prevButton = document.getElementById("prevPage");
            const nextButton = document.getElementById("nextPage");
            
            if (pagination.total_pages > 1) {
                paginationContainer.style.display = "flex";
                paginationInfo.textContent = `Página ${pagination.current_page} de ${pagination.total_pages} (${pagination.total_items} productos)`;
                
                prevButton.disabled = pagination.current_page <= 1;
                nextButton.disabled = pagination.current_page >= pagination.total_pages;
            } else {
                paginationContainer.style.display = "none";
            }
        }

        // Función para cambiar de página
        function cambiarPagina(direccion) {
            const nuevaPagina = paginaActual + direccion;
            if (nuevaPagina >= 1 && nuevaPagina <= totalPaginas) {
                document.getElementById("loading").style.display = "block";
                document.getElementById("product-list").innerHTML = "";
                cargarProductos(nuevaPagina, terminoBusqueda);
                
                // Scroll suave hacia arriba
                document.getElementById("product-list").scrollIntoView({ 
                    behavior: "smooth", 
                    block: "start" 
                });
            }
        }

        // Cargar productos inicialmente
        cargarProductos(1, "");

        function mostrarProductos(productos) {
            const productList = document.getElementById("product-list");
            productList.innerHTML = "";

            if (productos.length === 0) {
                document.getElementById("noResults").style.display = "block";
                document.getElementById("paginationContainer").style.display = "none";
                return;
            } else {
                document.getElementById("noResults").style.display = "none";
            }

            productos.forEach((p, index) => {
                const icon = getComponentIcon(p.nombre);

                setTimeout(() => {
                    productList.innerHTML += `
                        <div class="col-md-4 fade-in product-item" data-name="${p.nombre.toLowerCase()}" data-id="${p.id}">
                            <div class="card product-card">
                                <div class="card-header-custom text-center">
                                    <i class="${icon} product-icon"></i>
                                    <h5 class="mb-0">${p.nombre}</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="price-tag">
                                        <i class="fas fa-tags me-2"></i>S/ ${p.precio}
                                    </div>
                                    <div class="mt-3">
                                        <span class="stock-badge">
                                            <i class="fas fa-boxes me-1"></i>Stock: ${p.stock}
                                        </span>
                                    </div>
                                    <div class="mt-3">
                                        <input type="number" min="1" max="${p.stock}" class="form-control quantity-input mb-3" placeholder="Cantidad" id="cantidad-${p.id}" />
                                        <button class="btn btn-add-cart" onclick="agregarAlCarrito(${p.id}, '${p.nombre}', ${p.precio}, ${p.stock})">
                                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                }, index * 100);
            });
        }

        // Función de búsqueda mejorada
        function buscarProductos() {
            const searchTerm = document.getElementById("searchInput").value.toLowerCase().trim();
            
            if (searchTerm === "") {
                limpiarBusqueda();
                return;
            }

            terminoBusqueda = searchTerm;
            modoVistaTodos = false;
            document.getElementById("loading").style.display = "block";
            document.getElementById("product-list").innerHTML = "";
            document.getElementById("paginationContainer").style.display = "none";
            
            cargarProductos(1, searchTerm);

            // Ocultar sugerencias
            document.getElementById("searchSuggestions").style.display = "none";
        }

        // Limpiar búsqueda y mostrar todos los productos
        function limpiarBusqueda() {
            document.getElementById("searchInput").value = "";
            terminoBusqueda = "";
            modoVistaTodos = true;
            document.getElementById("noResults").style.display = "none";
            document.getElementById("searchSuggestions").style.display = "none";
            document.getElementById("loading").style.display = "block";
            document.getElementById("product-list").innerHTML = "";
            
            cargarProductos(1, "");
        }

        // Búsqueda en tiempo real y sugerencias
        document.getElementById("searchInput").addEventListener("input", function() {
            const searchTerm = this.value.toLowerCase().trim();
            const suggestions = document.getElementById("searchSuggestions");
            
            if (searchTerm === "") {
                suggestions.style.display = "none";
                limpiarBusqueda();
                return;
            }

            // Filtrar productos para sugerencias (solo si tenemos todos los productos cargados)
            if (todosLosProductos.length > 0) {
                const sugerencias = todosLosProductos
                    .filter(p => p.nombre.toLowerCase().includes(searchTerm))
                    .slice(0, 5); // Máximo 5 sugerencias

                if (sugerencias.length > 0) {
                    suggestions.innerHTML = sugerencias
                        .map(p => `
                            <div class="suggestion-item" onclick="seleccionarSugerencia('${p.nombre}')">
                                <i class="${getComponentIcon(p.nombre)} me-2"></i>
                                ${p.nombre}
                                <small class="text-muted float-end">S/ ${p.precio}</small>
                            </div>
                        `).join("");
                    suggestions.style.display = "block";
                } else {
                    suggestions.style.display = "none";
                }
            } else {
                // Si todosLosProductos no está cargado, intentar cargarlo para futuras sugerencias
                fetch("catalogo.php")
                    .then(response => response.json())
                    .then(productos => {
                        todosLosProductos = productos;
                        // Volver a intentar generar sugerencias después de cargar
                        const sugerencias = todosLosProductos
                            .filter(p => p.nombre.toLowerCase().includes(searchTerm))
                            .slice(0, 5);
                        if (sugerencias.length > 0) {
                            suggestions.innerHTML = sugerencias
                                .map(p => `
                                    <div class="suggestion-item" onclick="seleccionarSugerencia('${p.nombre}')">
                                        <i class="${getComponentIcon(p.nombre)} me-2"></i>
                                        ${p.nombre}
                                        <small class="text-muted float-end">S/ ${p.precio}</small>
                                    </div>
                                `).join("");
                            suggestions.style.display = "block";
                        } else {
                            suggestions.style.display = "none";
                        }
                    });
            }

            // Búsqueda automática después de 500ms
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                buscarProductos();
            }, 500);
        });

        // Seleccionar sugerencia
        function seleccionarSugerencia(nombre) {
            document.getElementById("searchInput").value = nombre;
            document.getElementById("searchSuggestions").style.display = "none";
            buscarProductos();
        }

        // Cerrar sugerencias al hacer clic fuera
        document.addEventListener("click", function(e) {
            if (!e.target.closest(".search-container")) {
                document.getElementById("searchSuggestions").style.display = "none";
            }
        });

        // Búsqueda al presionar Enter
        document.getElementById("searchInput").addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                buscarProductos();
                document.getElementById("searchSuggestions").style.display = "none";
            }
        });
        
        function agregarAlCarrito(id, nombre, precio, stock) {
            const cantidad = parseInt(document.getElementById("cantidad-" + id).value);
            
            if (!cantidad || cantidad <= 0) {
                alert("Por favor, ingresa una cantidad válida");
                return;
            }
            
            if (cantidad > stock) {
                alert("No hay suficiente stock disponible");
                return;
            }

            const productoExistente = carrito.find(item => item.id === id);
            
            if (productoExistente) {
                const nuevaCantidad = productoExistente.cantidad + cantidad;
                if (nuevaCantidad > stock) {
                    alert("No puedes agregar más productos. Stock insuficiente.");
                    return;
                }
                productoExistente.cantidad = nuevaCantidad;
            } else {
                carrito.push({
                    id: id,
                    nombre: nombre,
                    precio: precio,
                    cantidad: cantidad,
                    stock: stock
                });
            }

            localStorage.setItem("carrito", JSON.stringify(carrito));
            actualizarCarrito();
            
            // Limpiar input
            document.getElementById("cantidad-" + id).value = "";
            
            // Feedback visual
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = "<i class=\"fas fa-check me-2\"></i>¡Agregado!";
            button.classList.add("btn-success");
            button.disabled = true;
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove("btn-success");
                button.disabled = false;
            }, 1500);
        }

        function actualizarCarrito() {
            const carritoLista = document.getElementById("carrito-lista");
            const carritoTotal = document.getElementById("carrito-total");
            
            carritoLista.innerHTML = "";
            let total = 0;

            carrito.forEach((item, index) => {
                const subtotal = item.precio * item.cantidad;
                total += subtotal;

                carritoLista.innerHTML += `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="cart-item-info">
                            <h6 class="mb-1">${item.nombre}</h6>
                            <small class="text-muted">S/ ${item.precio} x ${item.cantidad}</small>
                        </div>
                        <div class="cart-item-actions">
                            <span class="badge bg-primary rounded-pill me-2">S/ ${subtotal.toFixed(2)}</span>
                            <button class="btn btn-sm btn-outline-danger" onclick="eliminarDelCarrito(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </li>
                `;
            });

            carritoTotal.textContent = total.toFixed(2);
        }

        function eliminarDelCarrito(index) {
            carrito.splice(index, 1);
            localStorage.setItem("carrito", JSON.stringify(carrito));
            actualizarCarrito();
        }

        function vaciarCarrito() {
            if (carrito.length === 0) {
                alert("El carrito ya está vacío");
                return;
            }
            
            if (confirm("¿Estás seguro de que quieres vaciar el carrito?")) {
                carrito = [];
                localStorage.removeItem("carrito");
                actualizarCarrito();
            }
        }

        function procesarCompra() {
            if (carrito.length === 0) {
                alert("El carrito está vacío");
                return;
            }

            <?php if (!isset($_SESSION["usuario_id"])): ?>
                alert("Debes iniciar sesión para realizar una compra");
                window.location.href = "login.php";
                return;
            <?php endif; ?>

            const btnCompra = event.target;
            const originalText = btnCompra.innerHTML;
            btnCompra.innerHTML = "<i class=\"fas fa-spinner fa-spin me-2\"></i>Procesando...";
            btnCompra.disabled = true;

            fetch("registrar_venta_lote.php", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(carrito)
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.json();
            })
            .then(res => {
                alert(res.message);
                if (res.success) {
                    carrito = [];
                    localStorage.removeItem("carrito");
                    actualizarCarrito();
                    
                    // Cerrar el offcanvas del carrito
                    const carritoOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById("carritoOffcanvas"));
                    if (carritoOffcanvas) {
                        carritoOffcanvas.hide();
                    }
                    
                    // Recargar la página para actualizar el stock
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            })
            .catch(error => {
                console.error("Error en la compra:", error);
                alert("❌ Error al procesar la compra. Intenta nuevamente.");
            })
            .finally(() => {
                // Restaurar botón
                btnCompra.innerHTML = originalText;
                btnCompra.disabled = false;
            });
        }

    </script>


    <!-- 🛒 Carrito tipo Amazon (Offcanvas Bootstrap) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="carritoOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">
                <i class="fas fa-shopping-cart me-2"></i>Carrito de Compras
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group mb-3" id="carrito-lista"></ul>
            <div class="cart-total">
                <i class="fas fa-calculator me-2"></i>Total: S/ <span id="carrito-total">0.00</span>
            </div>
            <button class="btn btn-clear-cart w-100 mb-3" onclick="vaciarCarrito()">
                <i class="fas fa-trash-alt me-2"></i>Vaciar Carrito
            </button>
            <button class="btn btn-checkout w-100" onclick="procesarCompra()">
                <i class="fas fa-credit-card me-2"></i>Finalizar Compra
            </button>
        </div>
    </div>
    <!-- Modal: Agregar Stock -->
    <div class="modal fade" id="modalAgregarStock" tabindex="-1" aria-labelledby="modalAgregarStockLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="agregar_stock.php" method="POST">
            <div class="modal-header bg-success text-white">
              <h5 class="modal-title" id="modalAgregarStockLabel">
                <i class="fas fa-plus-circle me-2"></i>Agregar Stock a Producto
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3 position-relative">
                <label for="buscar_producto" class="form-label fw-bold">Buscar Producto</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                  <input type="text" id="buscar_producto" class="form-control" placeholder="Escribe el nombre del producto..." autocomplete="off" required>
                </div>
                <input type="hidden" name="producto_id" id="producto_id" required>
                <div id="lista_productos" class="list-group position-absolute w-100 mt-1" style="z-index: 1050; max-height: 200px; overflow-y: auto;"></div>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle me-1"></i>Escribe al menos 2 caracteres para buscar
                </small>
              </div>

              <div class="mb-3" id="producto_seleccionado" style="display: none;">
                <div class="alert alert-info">
                  <i class="fas fa-check-circle me-2"></i>
                  <strong>Producto seleccionado:</strong> <span id="nombre_producto_seleccionado"></span>
                  <br><small>Stock actual: <span id="stock_actual"></span> unidades</small>
                </div>
              </div>

              <div class="mb-3">
                <label for="cantidad" class="form-label fw-bold">Cantidad a agregar</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                  <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" placeholder="Ej: 10" required>
                </div>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle me-1"></i>Esta cantidad se sumará al stock actual
                </small>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
              <button type="submit" class="btn btn-success w-50" id="btn_guardar_stock" disabled>
                <i class="fas fa-save me-1"></i> Agregar Stock
              </button>
              <button type="button" class="btn btn-outline-danger w-30" data-bs-dismiss="modal">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal: Agregar Nuevo Producto -->
    <div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-labelledby="modalNuevoProductoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form action="agregar_producto.php" method="POST">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="modalNuevoProductoLabel">
                <i class="fas fa-box-open me-2"></i>Agregar Nuevo Producto
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-tag"></i></span>
                  <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="categoria" class="form-label fw-bold">Categoría</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-list"></i></span>
                  <select name="categoria" id="categoria" class="form-select" required>
                    <option value="">Seleccionar categoría...</option>
                    <option value="Componentes PC">Componentes PC</option>
                    <option value="Componentes Laptop">Componentes Laptop</option>
                    <option value="Periféricos">Periféricos</option>
                    <option value="Otros">Otros</option>
                  </select>
                </div>
              </div>

              <div class="mb-3">
                <label for="precio" class="form-label fw-bold">Precio</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  <input type="number" name="precio" id="precio" class="form-control" step="0.01" min="0" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="stock" class="form-label fw-bold">Stock Inicial</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                  <input type="number" name="stock" id="stock" class="form-control" min="0" required>
                </div>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
              <button type="submit" class="btn btn-primary w-50">
                <i class="fas fa-save me-1"></i> Guardar
              </button>
              <button type="button" class="btn btn-outline-danger w-30" data-bs-dismiss="modal">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
                        <?php if (!isset($_SESSION["usuario_id"])): ?>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        // Limpiar formulario cuando se abre el modal
        $('#modalAgregarStock').on('show.bs.modal', function () {
            $('#buscar_producto').val('');
            $('#producto_id').val('');
            $('#cantidad').val('');
            $('#lista_productos').fadeOut();
            $('#producto_seleccionado').hide();
            $('#btn_guardar_stock').prop('disabled', true);
        });

        // Búsqueda de productos mejorada con debug
        $("#buscar_producto").on("input", function () {
            let query = $(this).val();
            console.log('Búsqueda iniciada con término:', query);
            
            if (query.length >= 2) {
                $.ajax({
                    url: "buscar_producto.php",
                    method: "GET",
                    data: { term: query },
                    dataType: 'json',
                    beforeSend: function() {
                        $("#lista_productos").html(`<div class="list-group-item text-center">
                                                      <i class="fas fa-spinner fa-spin me-2"></i>Buscando...
                                                   </div>`).fadeIn();
                    },
                    success: function (data) {
                        console.log('Respuesta recibida:', data);
                        let lista = "";
                        
                        if (data.error) {
                            lista = `<div class="list-group-item text-center text-danger">
                                        <i class="fas fa-exclamation-triangle me-2"></i>${data.error}
                                     </div>`;
                        } else if (data.length > 0) {
                            data.forEach(function (producto) {
                                lista += `<a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                             data-id="${producto.id}" 
                                             data-nombre="${producto.nombre}"
                                             data-stock="${producto.stock}">
                                              <div>
                                                <strong>${producto.nombre}</strong>
                                                <br><small class="text-muted">Stock: ${producto.stock} | Categoría: ${producto.categoria}</small>
                                              </div>
                                              <i class="fas fa-chevron-right text-muted"></i>
                                          </a>`;
                            });
                        } else {
                            lista = `<div class="list-group-item text-center text-muted">
                                        <i class="fas fa-search me-2"></i>No se encontraron productos con "${query}"
                                     </div>`;
                        }
                        
                        $("#lista_productos").html(lista).fadeIn();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error AJAX:', status, error);
                        console.error('Respuesta completa:', xhr.responseText);
                        $("#lista_productos").html(`<div class="list-group-item text-center text-danger">
                                                      <i class="fas fa-exclamation-triangle me-2"></i>Error de conexión: ${error}
                                                      <br><small>Revisa la consola para más detalles</small>
                                                   </div>`).fadeIn();
                    }
                });
            } else {
                $("#lista_productos").fadeOut();
                $('#producto_seleccionado').hide();
                $('#btn_guardar_stock').prop('disabled', true);
            }
        });

        // Cuando el usuario selecciona un producto
        $(document).on("click", "#lista_productos a", function (e) {
            e.preventDefault();
            const nombre = $(this).data("nombre");
            const id = $(this).data("id");
            const stock = $(this).data("stock");
            
            console.log('Producto seleccionado:', {id, nombre, stock});
            
            $("#buscar_producto").val(nombre);
            $("#producto_id").val(id);
            $("#nombre_producto_seleccionado").text(nombre);
            $("#stock_actual").text(stock);
            $("#lista_productos").fadeOut();
            $("#producto_seleccionado").fadeIn();
            $("#btn_guardar_stock").prop('disabled', false);
        });

        // Oculta la lista si se hace clic fuera
        $(document).click(function (e) {
            if (!$(e.target).closest("#buscar_producto, #lista_productos").length) {
                $("#lista_productos").fadeOut();
            }
        });

        // Validación adicional del formulario
        $('#modalAgregarStock form').on('submit', function(e) {
            const productoId = $('#producto_id').val();
            const cantidad = $('#cantidad').val();
            
            console.log('Enviando formulario:', {productoId, cantidad});
            
            if (!productoId) {
                e.preventDefault();
                alert('Por favor, selecciona un producto de la lista');
                return false;
            }
            
            if (!cantidad || cantidad <= 0) {
                e.preventDefault();
                alert('Por favor, ingresa una cantidad válida');
                return false;
            }
        });

        // Test de conectividad al cargar la página
        console.log('Testing conectividad con buscar_producto.php...');
        $.get('buscar_producto.php?term=test')
            .done(function(data) {
                console.log('✅ Conexión con buscar_producto.php exitosa');
            })
            .fail(function(xhr, status, error) {
                console.error('❌ Error de conexión con buscar_producto.php:', error);
            });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

