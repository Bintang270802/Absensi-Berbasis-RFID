<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use ZipArchive;

class PWADownload extends Controller
{
    /**
     * Download PWA Package
     */
    public function downloadPackage()
    {
        $zipFileName = 'sekolah_ulil_albab' . date('Y-m-d') . '.zip';
        $zipPath = WRITEPATH . 'uploads/' . $zipFileName;

        // Create zip file
        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak dapat membuat file ZIP'
            ]);
        }

        // Add PWA files
        $this->addPWAFiles($zip);

        $zip->close();

        // Download file
        return $this->response->download($zipPath, null)->setFileName($zipFileName);
    }

    /**
     * Generate PWA Package for distribution
     */
    public function generatePackage()
    {
        $data = [
            'title' => 'Download PWA Package',
            'description' => 'Download aplikasi sebagai PWA package'
        ];

        return view('pwa/download_package', $data);
    }

    /**
     * Add PWA files to zip
     */
    private function addPWAFiles($zip)
    {
        // PWA Core Files
        $files = [
            'public/pwa.js' => 'pwa.js',
            'public/sw.js' => 'sw.js',
            'public/manifest.json' => 'manifest.json',
            'public/pwa-styles.css' => 'pwa-styles.css',
        ];

        foreach ($files as $source => $dest) {
            if (file_exists($source)) {
                $zip->addFile($source, $dest);
            }
        }

        // Add icons if exist
        $iconSizes = [72, 96, 128, 144, 152, 192, 384, 512];
        foreach ($iconSizes as $size) {
            $iconPath = "public/image/icon-{$size}x{$size}.png";
            if (file_exists($iconPath)) {
                $zip->addFile($iconPath, "icons/icon-{$size}x{$size}.png");
            }
        }

        // Add README
        $readme = $this->generateReadme();
        $zip->addFromString('README.txt', $readme);

        // Add install instructions
        $instructions = $this->generateInstructions();
        $zip->addFromString('CARA_INSTALL.txt', $instructions);
    }

    /**
     * Generate README content
     */
    private function generateReadme()
    {
        return <<<TEXT
================================================================================
PROGRESSIVE WEB APP (PWA) - SEKOLAH ULIL ALBAB
Package Download
================================================================================

TENTANG PACKAGE INI:
Package ini berisi file-file PWA yang dapat Anda install di perangkat Anda.

ISI PACKAGE:
- pwa.js              : PWA manager
- sw.js               : Service worker
- manifest.json       : Web app manifest
- pwa-styles.css      : Styling PWA
- icons/              : Icon aplikasi (8 ukuran)
- README.txt          : File ini
- CARA_INSTALL.txt    : Panduan instalasi

CARA MENGGUNAKAN:
1. Extract file ZIP ini
2. Buka file CARA_INSTALL.txt untuk panduan lengkap
3. Atau kunjungi: {$this->getBaseUrl()}/pwa/install

SYSTEM REQUIREMENTS:
- Browser modern (Chrome, Firefox, Safari, Edge)
- Koneksi internet (untuk instalasi pertama)
- HTTPS (untuk production)

SUPPORT:
Website: {$this->getBaseUrl()}
Install Guide: {$this->getBaseUrl()}/pwa/install

================================================================================
Made with ❤️ for Sekolah Ulil Albab
================================================================================
TEXT;
    }

    /**
     * Generate installation instructions
     */
    private function generateInstructions()
    {
        return <<<TEXT
================================================================================
CARA INSTALL PWA - SEKOLAH ULIL ALBAB
================================================================================

ANDROID (Chrome):
1. Buka {$this->getBaseUrl()} di Chrome
2. Klik banner "Tambahkan ke Layar Utama"
3. Atau: Menu (⋮) > Tambahkan ke Layar Utama
4. Klik "Tambahkan"
5. Icon akan muncul di layar utama

iOS (Safari):
1. Buka {$this->getBaseUrl()} di Safari
2. Klik tombol Share (kotak dengan panah ke atas)
3. Scroll dan pilih "Add to Home Screen"
4. Klik "Add"
5. Icon akan muncul di layar utama

DESKTOP (Chrome/Edge):
1. Buka {$this->getBaseUrl()} di Chrome atau Edge
2. Klik icon Install di address bar
3. Atau: Menu > Install [Nama Aplikasi]
4. Klik "Install"
5. Aplikasi akan terbuka di window terpisah

FITUR PWA:
✓ Dapat diinstall seperti aplikasi native
✓ Bekerja offline
✓ Loading cepat
✓ Push notifications
✓ Update otomatis

TROUBLESHOOTING:
- Pastikan koneksi internet stabil
- Gunakan browser terbaru
- Clear cache jika ada masalah
- Untuk production, pastikan HTTPS aktif

SUPPORT:
Panduan lengkap: {$this->getBaseUrl()}/pwa/install

================================================================================
TEXT;
    }

    /**
     * Get base URL
     */
    private function getBaseUrl()
    {
        return base_url();
    }

    /**
     * Create offline installer
     */
    public function createOfflineInstaller()
    {
        $data = [
            'title' => 'Offline Installer',
            'description' => 'Buat installer offline untuk PWA'
        ];

        return view('pwa/offline_installer', $data);
    }

    /**
     * Generate offline installer package
     */
    public function generateOfflineInstaller()
    {
        $zipFileName = 'ulil-albab-pwa-offline-installer-' . date('Y-m-d') . '.zip';
        $zipPath = WRITEPATH . 'uploads/' . $zipFileName;

        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak dapat membuat file ZIP'
            ]);
        }

        // Add all necessary files for offline installation
        $this->addOfflineInstallerFiles($zip);

        $zip->close();

        return $this->response->download($zipPath, null)->setFileName($zipFileName);
    }

    /**
     * Add offline installer files
     */
    private function addOfflineInstallerFiles($zip)
    {
        // Add PWA files
        $this->addPWAFiles($zip);

        // Add offline installer HTML
        $installerHTML = $this->generateOfflineInstallerHTML();
        $zip->addFromString('index.html', $installerHTML);

        // Add autorun script
        $autorun = $this->generateAutorunScript();
        $zip->addFromString('install.bat', $autorun);
    }

    /**
     * Generate offline installer HTML
     */
    private function generateOfflineInstallerHTML()
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install PWA - Sekolah Ulil Albab</title>
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="pwa-styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .installer-container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        
        .logo {
            font-size: 80px;
            margin-bottom: 30px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 15px;
            font-size: 32px;
        }
        
        p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .btn-install {
            padding: 18px 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-install:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        
        .features {
            margin-top: 40px;
            text-align: left;
        }
        
        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .feature-icon {
            font-size: 24px;
            margin-right: 15px;
        }
        
        .feature-text {
            color: #555;
            font-size: 14px;
        }
        
        .status {
            margin-top: 30px;
            padding: 15px;
            background: #e7f3ff;
            border-radius: 8px;
            color: #1976D2;
            display: none;
        }
        
        .status.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="installer-container">
        <div class="logo">📱</div>
        <h1>Sekolah Ulil Albab</h1>
        <p>Install aplikasi untuk pengalaman terbaik</p>
        
        <button class="btn-install" id="installBtn">
            📥 Install Aplikasi
        </button>
        
        <div class="features">
            <div class="feature">
                <div class="feature-icon">⚡</div>
                <div class="feature-text">Loading cepat dengan caching</div>
            </div>
            <div class="feature">
                <div class="feature-icon">📡</div>
                <div class="feature-text">Bekerja offline</div>
            </div>
            <div class="feature">
                <div class="feature-icon">🔔</div>
                <div class="feature-text">Push notifications</div>
            </div>
            <div class="feature">
                <div class="feature-icon">💾</div>
                <div class="feature-text">Hemat data</div>
            </div>
        </div>
        
        <div class="status" id="status"></div>
    </div>
    
    <script src="pwa.js"></script>
    <script>
        const installBtn = document.getElementById('installBtn');
        const status = document.getElementById('status');
        
        installBtn.addEventListener('click', async () => {
            try {
                await pwaManager.installApp();
                showStatus('Aplikasi berhasil diinstall!', 'success');
            } catch (error) {
                showStatus('Gagal install: ' + error.message, 'error');
            }
        });
        
        function showStatus(message, type) {
            status.textContent = message;
            status.className = 'status show ' + type;
            setTimeout(() => {
                status.classList.remove('show');
            }, 5000);
        }
        
        // Auto-redirect to online version if available
        if (navigator.onLine) {
            const onlineUrl = '{$this->getBaseUrl()}';
            const redirectBtn = document.createElement('a');
            redirectBtn.href = onlineUrl;
            redirectBtn.textContent = '🌐 Buka Versi Online';
            redirectBtn.style.cssText = 'display: inline-block; margin-top: 20px; color: #667eea; text-decoration: none; font-weight: 600;';
            document.querySelector('.installer-container').appendChild(redirectBtn);
        }
    </script>
</body>
</html>
HTML;
    }

    /**
     * Generate autorun script
     */
    private function generateAutorunScript()
    {
        return <<<BAT
@echo off
echo ================================================================================
echo PWA INSTALLER - SEKOLAH ULIL ALBAB
echo ================================================================================
echo.
echo Membuka installer...
echo.
start index.html
echo.
echo Installer telah dibuka di browser Anda.
echo Ikuti instruksi di browser untuk menginstall aplikasi.
echo.
pause
BAT;
    }
}
