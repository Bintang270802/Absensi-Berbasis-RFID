// PWA Installation and Management
class PWAManager {
  constructor() {
    this.deferredPrompt = null;
    this.init();
  }

  init() {
    // Register Service Worker
    if ('serviceWorker' in navigator) {
      this.registerServiceWorker();
    }

    // Handle install prompt
    this.handleInstallPrompt();

    // Check if app is installed
    this.checkInstallStatus();

    // Handle online/offline status
    this.handleConnectionStatus();
  }

  async registerServiceWorker() {
    try {
      const registration = await navigator.serviceWorker.register('/sw.js', {
        scope: '/'
      });

      console.log('Service Worker registered successfully:', registration.scope);

      // Check for updates
      registration.addEventListener('updatefound', () => {
        const newWorker = registration.installing;
        console.log('Service Worker update found');

        newWorker.addEventListener('statechange', () => {
          if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
            // New service worker available
            this.showUpdateNotification();
          }
        });
      });

      // Check for updates every hour
      setInterval(() => {
        registration.update();
      }, 3600000);

    } catch (error) {
      console.error('Service Worker registration failed:', error);
    }
  }

  handleInstallPrompt() {
    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      this.deferredPrompt = e;
      this.showInstallButton();
    });

    window.addEventListener('appinstalled', () => {
      console.log('PWA installed successfully');
      this.deferredPrompt = null;
      this.hideInstallButton();
      this.showInstalledMessage();
    });
  }

  async installApp() {
    if (!this.deferredPrompt) {
      console.log('Install prompt not available');
      return;
    }

    this.deferredPrompt.prompt();
    const { outcome } = await this.deferredPrompt.userChoice;
    
    console.log(`User response to install prompt: ${outcome}`);
    this.deferredPrompt = null;
  }

  showInstallButton() {
    const installBtn = document.getElementById('pwa-install-btn');
    if (installBtn) {
      installBtn.style.display = 'block';
      installBtn.addEventListener('click', () => this.installApp());
    }
  }

  hideInstallButton() {
    const installBtn = document.getElementById('pwa-install-btn');
    if (installBtn) {
      installBtn.style.display = 'none';
    }
  }

  checkInstallStatus() {
    // Check if running as installed PWA
    if (window.matchMedia('(display-mode: standalone)').matches || 
        window.navigator.standalone === true) {
      console.log('Running as installed PWA');
      document.body.classList.add('pwa-installed');
    }
  }

  handleConnectionStatus() {
    const updateOnlineStatus = () => {
      if (navigator.onLine) {
        document.body.classList.remove('offline');
        document.body.classList.add('online');
        this.showConnectionMessage('Online', 'success');
      } else {
        document.body.classList.remove('online');
        document.body.classList.add('offline');
        this.showConnectionMessage('Offline - Beberapa fitur mungkin tidak tersedia', 'warning');
      }
    };

    window.addEventListener('online', updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);
    updateOnlineStatus();
  }

  showUpdateNotification() {
    const message = 'Update tersedia! Refresh halaman untuk mendapatkan versi terbaru.';
    this.showNotification(message, 'info', () => {
      window.location.reload();
    });
  }

  showInstalledMessage() {
    this.showNotification('Aplikasi berhasil diinstall!', 'success');
  }

  showConnectionMessage(message, type) {
    const existingMsg = document.getElementById('connection-status');
    if (existingMsg) {
      existingMsg.remove();
    }

    const statusDiv = document.createElement('div');
    statusDiv.id = 'connection-status';
    statusDiv.className = `connection-status ${type}`;
    statusDiv.textContent = message;
    document.body.appendChild(statusDiv);

    if (type === 'success') {
      setTimeout(() => statusDiv.remove(), 3000);
    }
  }

  showNotification(message, type = 'info', callback = null) {
    const notification = document.createElement('div');
    notification.className = `pwa-notification ${type}`;
    notification.innerHTML = `
      <div class="notification-content">
        <span>${message}</span>
        ${callback ? '<button class="notification-btn">Refresh</button>' : ''}
        <button class="notification-close">&times;</button>
      </div>
    `;

    document.body.appendChild(notification);

    if (callback) {
      notification.querySelector('.notification-btn').addEventListener('click', callback);
    }

    notification.querySelector('.notification-close').addEventListener('click', () => {
      notification.remove();
    });

    setTimeout(() => notification.classList.add('show'), 100);
  }

  // Request notification permission
  async requestNotificationPermission() {
    if (!('Notification' in window)) {
      console.log('This browser does not support notifications');
      return false;
    }

    if (Notification.permission === 'granted') {
      return true;
    }

    if (Notification.permission !== 'denied') {
      const permission = await Notification.requestPermission();
      return permission === 'granted';
    }

    return false;
  }

  // Show local notification
  showLocalNotification(title, options = {}) {
    if (Notification.permission === 'granted') {
      const notification = new Notification(title, {
        icon: '/image/icon-192x192.png',
        badge: '/image/icon-72x72.png',
        ...options
      });

      notification.onclick = () => {
        window.focus();
        notification.close();
      };
    }
  }
}

// Initialize PWA Manager
const pwaManager = new PWAManager();

// Expose to global scope
window.pwaManager = pwaManager;
