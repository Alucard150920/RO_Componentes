// Service Worker para RO Componentes
// Mejora el rendimiento con caché offline

const CACHE_NAME = 'ro-componentes-v1';
const urlsToCache = [
    '/',
    '/index_optimizado.php',
    '/assets/style.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'
];

// Instalación del Service Worker
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Cache abierto');
                return cache.addAll(urlsToCache);
            })
    );
});

// Interceptar requests
self.addEventListener('fetch', event => {
    // Solo cachear requests GET
    if (event.request.method !== 'GET') {
        return;
    }

    // Estrategia: Cache First para assets estáticos
    if (event.request.url.includes('.css') || 
        event.request.url.includes('.js') || 
        event.request.url.includes('bootstrap') || 
        event.request.url.includes('font-awesome')) {
        
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    // Retornar desde caché si existe
                    if (response) {
                        return response;
                    }
                    // Si no, fetch y cachear
                    return fetch(event.request).then(response => {
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }
                        
                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });
                        
                        return response;
                    });
                })
        );
    }
    
    // Estrategia: Network First para API calls
    else if (event.request.url.includes('catalogo_optimizado.php')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    // Si la respuesta es exitosa, cachearla
                    if (response.status === 200) {
                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                // Cachear por 5 minutos
                                cache.put(event.request, responseToCache);
                            });
                    }
                    return response;
                })
                .catch(() => {
                    // Si falla la red, intentar desde caché
                    return caches.match(event.request);
                })
        );
    }
    
    // Para otras requests, estrategia normal
    else {
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    return response || fetch(event.request);
                })
        );
    }
});

// Limpiar cachés antiguos
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Eliminando caché antiguo:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Manejar actualizaciones del Service Worker
self.addEventListener('message', event => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

