const CACHE_NAME = 'ulil-albab-v1';
const urlsToCache = [
  '/',
  '/manifest.json',
  '/favicon.ico'
];

// Install Service Worker
self.addEventListener('install', (event) => {
  console.log('Service Worker: Installing...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('Service Worker: Caching files');
        return cache.addAll(urlsToCache);
      })
      .then(() => self.skipWaiting())
  );
});

// Activate Service Worker
self.addEventListener('activate', (event) => {
  console.log('Service Worker: Activating...');
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            console.log('Service Worker: Clearing old cache');
            return caches.delete(cache);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch Event - Network First, fallback to Cache
self.addEventListener('fetch', (event) => {
  const { request } = event;
  
  // Skip cross-origin requests
  if (!request.url.startsWith(self.location.origin)) {
    return;
  }

  event.respondWith(
    fetch(request)
      .then((response) => {
        // Clone the response
        const responseClone = response.clone();
        
        // Don't cache POST requests or non-successful responses
        if (request.method === 'GET' && response.status === 200) {
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(request, responseClone);
          });
        }
        
        return response;
      })
      .catch(() => {
        // If network fails, try cache
        return caches.match(request).then((cachedResponse) => {
          if (cachedResponse) {
            return cachedResponse;
          }
          
          // Return offline page for navigation requests
          if (request.mode === 'navigate') {
            return caches.match('/');
          }
          
          return new Response('Offline - Content not available', {
            status: 503,
            statusText: 'Service Unavailable',
            headers: new Headers({
              'Content-Type': 'text/plain'
            })
          });
        });
      })
  );
});

// Background Sync
self.addEventListener('sync', (event) => {
  console.log('Service Worker: Background sync', event.tag);
  if (event.tag === 'sync-data') {
    event.waitUntil(syncData());
  }
});

// Push Notification
self.addEventListener('push', (event) => {
  console.log('Service Worker: Push notification received');
  
  const options = {
    body: event.data ? event.data.text() : 'New notification',
    icon: '/image/icon-192x192.png',
    badge: '/image/icon-72x72.png',
    vibrate: [200, 100, 200],
    data: {
      dateOfArrival: Date.now(),
      primaryKey: 1
    },
    actions: [
      {
        action: 'explore',
        title: 'Buka',
        icon: '/image/icon-72x72.png'
      },
      {
        action: 'close',
        title: 'Tutup',
        icon: '/image/icon-72x72.png'
      }
    ]
  };

  event.waitUntil(
    self.registration.showNotification('Sekolah Ulil Albab', options)
  );
});

// Notification Click
self.addEventListener('notificationclick', (event) => {
  console.log('Service Worker: Notification clicked');
  event.notification.close();

  if (event.action === 'explore') {
    event.waitUntil(
      clients.openWindow('/')
    );
  }
});

// Helper function for syncing data
async function syncData() {
  try {
    // Implement your sync logic here
    console.log('Syncing data...');
    return Promise.resolve();
  } catch (error) {
    console.error('Sync failed:', error);
    return Promise.reject(error);
  }
}
