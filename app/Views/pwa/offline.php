<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline - Ulil Albab</title>
    <?= pwa_meta_tags() ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        
        .offline-container {
            text-align: center;
            padding: 60px 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .offline-icon {
            font-size: 80px;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        h1 {
            color: #333;
            margin-bottom: 15px;
            font-size: 32px;
            font-weight: 700;
        }
        
        p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .btn-retry {
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        
        .btn-retry:active {
            transform: translateY(0);
        }
        
        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            background: #ff6b6b;
            border-radius: 50%;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .status-text {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            color: #999;
            font-size: 14px;
        }
        
        @media (max-width: 480px) {
            .offline-container {
                padding: 40px 30px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .offline-icon {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="offline-container">
        <div class="offline-icon">📡</div>
        <h1>Tidak Ada Koneksi</h1>
        <p>Maaf, Anda sedang offline. Silakan periksa koneksi internet Anda dan coba lagi.</p>
        <button class="btn-retry" onclick="window.location.reload()">
            Coba Lagi
        </button>
        <div class="status-text">
            <span class="status-indicator"></span>
            <span>Offline Mode</span>
        </div>
    </div>
    
    <script>
        // Auto retry when online
        window.addEventListener('online', () => {
            window.location.reload();
        });
        
        // Check connection status
        if (navigator.onLine) {
            window.location.reload();
        }
    </script>
</body>
</html>
