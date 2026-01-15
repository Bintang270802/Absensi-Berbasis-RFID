<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Install Aplikasi - Ulil Albab</title>
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
        
        .platform-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
        }
        
        .tab {
            padding: 15px 30px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        
        .tab:hover {
            color: #667eea;
        }
        
        .platform-content {
            display: none;
        }
        
        .platform-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .step {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }
        
        .step-number {
            display: inline-block;
            width: 32px;
            height: 32px;
            background: #667eea;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 32px;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .step h3 {
            display: inline-block;
            color: #333;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .step p {
            color: #666;
            line-height: 1.6;
            margin-top: 10px;
        }
        
        .step-image {
            margin-top: 15px;
            text-align: center;
        }
        
        .step-image img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .icon-placeholder {
            width: 200px;
            height: 200px;
            background: #e0e0e0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            margin: 0 auto;
        }
        
        .note {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .note strong {
            color: #856404;
        }
        
        .note p {
            color: #856404;
            margin-top: 5px;
        }
        
        .btn-back {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 30px;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .tab {
                padding: 12px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📱 Cara Install Aplikasi</h1>
        <p class="subtitle">Pilih platform Anda untuk melihat panduan instalasi</p>
        
        <div class="platform-tabs">
            <button class="tab active" onclick="showPlatform('android')">🤖 Android</button>
            <button class="tab" onclick="showPlatform('ios')">🍎 iOS</button>
            <button class="tab" onclick="showPlatform('desktop')">💻 Desktop</button>
        </div>
        
        <!-- Android Instructions -->
        <div id="android" class="platform-content active">
            <div class="step">
                <span class="step-number">1</span>
                <h3>Buka di Chrome</h3>
                <p>Buka aplikasi menggunakan browser Google Chrome di Android Anda.</p>
            </div>
            
            <div class="step">
                <span class="step-number">2</span>
                <h3>Klik Menu atau Banner</h3>
                <p>Akan muncul banner "Tambahkan ke Layar Utama" di bagian bawah, atau klik menu (⋮) di pojok kanan atas dan pilih "Tambahkan ke Layar Utama".</p>
                <div class="step-image">
                    <div class="icon-placeholder">📱</div>
                </div>
            </div>
            
            <div class="step">
                <span class="step-number">3</span>
                <h3>Konfirmasi Instalasi</h3>
                <p>Klik "Tambahkan" atau "Install" pada dialog yang muncul.</p>
            </div>
            
            <div class="step">
                <span class="step-number">4</span>
                <h3>Selesai!</h3>
                <p>Icon aplikasi akan muncul di layar utama Anda. Klik untuk membuka aplikasi.</p>
            </div>
            
            <div class="note">
                <strong>💡 Tips:</strong>
                <p>Setelah diinstall, aplikasi akan berjalan seperti aplikasi native dan dapat diakses bahkan saat offline!</p>
            </div>
        </div>
        
        <!-- iOS Instructions -->
        <div id="ios" class="platform-content">
            <div class="step">
                <span class="step-number">1</span>
                <h3>Buka di Safari</h3>
                <p>Buka aplikasi menggunakan browser Safari di iPhone atau iPad Anda.</p>
            </div>
            
            <div class="step">
                <span class="step-number">2</span>
                <h3>Klik Tombol Share</h3>
                <p>Klik tombol Share (kotak dengan panah ke atas) di bagian bawah browser.</p>
                <div class="step-image">
                    <div class="icon-placeholder">🍎</div>
                </div>
            </div>
            
            <div class="step">
                <span class="step-number">3</span>
                <h3>Pilih "Add to Home Screen"</h3>
                <p>Scroll ke bawah dan pilih opsi "Add to Home Screen" atau "Tambahkan ke Layar Utama".</p>
            </div>
            
            <div class="step">
                <span class="step-number">4</span>
                <h3>Beri Nama dan Tambahkan</h3>
                <p>Anda dapat mengubah nama aplikasi jika mau, lalu klik "Add" atau "Tambahkan".</p>
            </div>
            
            <div class="step">
                <span class="step-number">5</span>
                <h3>Selesai!</h3>
                <p>Icon aplikasi akan muncul di layar utama Anda. Tap untuk membuka aplikasi.</p>
            </div>
            
            <div class="note">
                <strong>⚠️ Catatan:</strong>
                <p>Pastikan menggunakan Safari, bukan Chrome atau browser lain di iOS.</p>
            </div>
        </div>
        
        <!-- Desktop Instructions -->
        <div id="desktop" class="platform-content">
            <div class="step">
                <span class="step-number">1</span>
                <h3>Buka di Chrome atau Edge</h3>
                <p>Buka aplikasi menggunakan browser Google Chrome atau Microsoft Edge di komputer Anda.</p>
            </div>
            
            <div class="step">
                <span class="step-number">2</span>
                <h3>Klik Tombol Install</h3>
                <p>Akan muncul tombol "Install" atau icon ⊕ di address bar. Klik tombol tersebut.</p>
                <div class="step-image">
                    <div class="icon-placeholder">💻</div>
                </div>
            </div>
            
            <div class="step">
                <span class="step-number">3</span>
                <h3>Konfirmasi Instalasi</h3>
                <p>Klik "Install" pada dialog yang muncul.</p>
            </div>
            
            <div class="step">
                <span class="step-number">4</span>
                <h3>Selesai!</h3>
                <p>Aplikasi akan terbuka di window terpisah dan shortcut akan ditambahkan ke desktop atau Start Menu.</p>
            </div>
            
            <div class="note">
                <strong>💡 Tips:</strong>
                <p>Aplikasi yang sudah diinstall dapat diakses dari Start Menu (Windows) atau Applications (Mac) seperti aplikasi desktop biasa.</p>
            </div>
        </div>
        
        <div style="text-align: center;">
            <a href="<?= base_url('/') ?>" class="btn-back">← Kembali ke Aplikasi</a>
        </div>
    </div>
    
    <script>
        function showPlatform(platform) {
            // Hide all contents
            document.querySelectorAll('.platform-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active from all tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected content
            document.getElementById(platform).classList.add('active');
            
            // Add active to selected tab
            event.target.classList.add('active');
        }
    </script>
    
    <?= pwa_scripts() ?>
</body>
</html>
