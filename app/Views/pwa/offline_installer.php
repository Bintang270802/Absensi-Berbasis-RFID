<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?= pwa_meta_tags() ?>
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
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 32px;
            text-align: center;
        }
        
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 40px;
            font-size: 16px;
        }
        
        .installer-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .installer-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        
        .installer-preview h3 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .installer-preview p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .btn {
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        
        .features-list {
            margin-bottom: 30px;
        }
        
        .feature-item {
            display: flex;
            align-items: start;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .feature-icon {
            font-size: 24px;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .feature-content h4 {
            color: #333;
            margin-bottom: 5px;
            font-size: 16px;
        }
        
        .feature-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .info-box h3 {
            color: #1976D2;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .info-box ul {
            margin-left: 20px;
            color: #555;
        }
        
        .info-box li {
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .actions {
            text-align: center;
            margin-top: 30px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💿 Offline Installer</h1>
        <p class="subtitle">Buat installer offline untuk distribusi PWA</p>
        
        <div class="installer-preview">
            <div class="installer-icon">📦</div>
            <h3>Offline Installer Package</h3>
            <p>Package ini berisi semua file yang diperlukan untuk menginstall PWA tanpa koneksi internet.</p>
        </div>
        
        <div class="info-box">
            <h3>📋 Isi Package:</h3>
            <ul>
                <li>File PWA lengkap (pwa.js, sw.js, manifest.json, styles)</li>
                <li>Icon aplikasi (8 ukuran)</li>
                <li>index.html - Installer page</li>
                <li>install.bat - Autorun script (Windows)</li>
                <li>README.txt - Dokumentasi</li>
                <li>CARA_INSTALL.txt - Panduan instalasi</li>
            </ul>
        </div>
        
        <div class="features-list">
            <div class="feature-item">
                <div class="feature-icon">💿</div>
                <div class="feature-content">
                    <h4>Instalasi Offline</h4>
                    <p>Dapat diinstall tanpa koneksi internet setelah download pertama kali.</p>
                </div>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">📤</div>
                <div class="feature-content">
                    <h4>Mudah Dibagikan</h4>
                    <p>Package dapat dibagikan via USB, email, atau media lain untuk distribusi internal.</p>
                </div>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">🚀</div>
                <div class="feature-content">
                    <h4>Autorun Script</h4>
                    <p>Termasuk script autorun untuk Windows yang memudahkan proses instalasi.</p>
                </div>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">📚</div>
                <div class="feature-content">
                    <h4>Dokumentasi Lengkap</h4>
                    <p>Dilengkapi dengan README dan panduan instalasi untuk user.</p>
                </div>
            </div>
        </div>
        
        <div class="actions">
            <a href="<?= base_url('pwa/download/generate-offline-installer') ?>" class="btn">
                💿 Generate Offline Installer
            </a>
        </div>
        
        <div class="back-link">
            <a href="<?= base_url('pwa/download') ?>">← Kembali ke Download Options</a>
        </div>
    </div>
    
    <?= pwa_scripts() ?>
</body>
</html>
