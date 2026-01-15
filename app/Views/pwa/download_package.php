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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
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
        
        .download-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .download-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .download-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }
        
        .download-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        
        .download-card h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 20px;
        }
        
        .download-card p {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .btn {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .features {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .features h3 {
            color: #1976D2;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .features ul {
            list-style: none;
            padding: 0;
        }
        
        .features li {
            color: #555;
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
        }
        
        .features li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4CAF50;
            font-weight: bold;
        }
        
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .info-box strong {
            color: #856404;
        }
        
        .info-box p {
            color: #856404;
            margin-top: 5px;
            font-size: 14px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .download-options {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📥 Download PWA Package</h1>
        <p class="subtitle">Pilih jenis package yang ingin Anda download</p>
        
        <div class="features">
            <h3>✨ Fitur PWA Package:</h3>
            <ul>
                <li>Dapat diinstall di semua perangkat (Android, iOS, Desktop)</li>
                <li>Bekerja offline setelah instalasi pertama</li>
                <li>Loading cepat dengan caching</li>
                <li>Push notifications ready</li>
                <li>Update otomatis</li>
                <li>Hemat data dengan caching</li>
            </ul>
        </div>
        
        <div class="download-options">
            <div class="download-card">
                <div class="download-icon">📦</div>
                <h3>PWA Package</h3>
                <p>Download file PWA lengkap dengan icon dan dokumentasi. Cocok untuk distribusi dan backup.</p>
                <a href="<?= base_url('pwa/download/package') ?>" class="btn">
                    📥 Download Package
                </a>
            </div>
            
            <div class="download-card">
                <div class="download-icon">💿</div>
                <h3>Offline Installer</h3>
                <p>Download installer offline yang dapat dijalankan tanpa koneksi internet. Termasuk autorun script.</p>
                <a href="<?= base_url('pwa/download/offline-installer') ?>" class="btn">
                    💿 Download Installer
                </a>
            </div>
            
            <div class="download-card">
                <div class="download-icon">🌐</div>
                <h3>Install Online</h3>
                <p>Install langsung dari website tanpa download. Memerlukan koneksi internet.</p>
                <button class="btn" onclick="pwaManager.installApp()">
                    📱 Install Sekarang
                </button>
            </div>
        </div>
        
        <div class="info-box">
            <strong>💡 Catatan Penting:</strong>
            <p>
                • Package dapat dibagikan ke user lain untuk instalasi offline<br>
                • Untuk production, pastikan HTTPS aktif<br>
                • Icon aplikasi harus sudah di-generate sebelum download<br>
                • Installer offline cocok untuk distribusi internal
            </p>
        </div>
        
        <div class="back-link">
            <a href="<?= base_url('/') ?>">← Kembali ke Aplikasi</a>
        </div>
    </div>
    
    <?= pwa_scripts() ?>
</body>
</html>
