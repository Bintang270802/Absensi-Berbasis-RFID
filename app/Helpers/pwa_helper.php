<?php

/**
 * PWA Helper Functions
 * Helper untuk memudahkan implementasi PWA di CodeIgniter 4
 */

if (!function_exists('pwa_meta_tags')) {
    /**
     * Generate PWA meta tags
     * 
     * @return string
     */
    function pwa_meta_tags(): string
    {
        $baseUrl = base_url();
        
        return <<<HTML
<!-- PWA Meta Tags -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Ulil Albab">
<meta name="application-name" content="Ulil Albab">
<meta name="theme-color" content="#4CAF50">
<meta name="msapplication-TileColor" content="#4CAF50">
<meta name="msapplication-navbutton-color" content="#4CAF50">

<!-- Manifest -->
<link rel="manifest" href="{$baseUrl}/manifest.json">

<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" sizes="72x72" href="{$baseUrl}/image/icon-72x72.png">
<link rel="apple-touch-icon" sizes="96x96" href="{$baseUrl}/image/icon-96x96.png">
<link rel="apple-touch-icon" sizes="128x128" href="{$baseUrl}/image/icon-128x128.png">
<link rel="apple-touch-icon" sizes="144x144" href="{$baseUrl}/image/icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="{$baseUrl}/image/icon-152x152.png">
<link rel="apple-touch-icon" sizes="192x192" href="{$baseUrl}/image/icon-192x192.png">
<link rel="apple-touch-icon" sizes="384x384" href="{$baseUrl}/image/icon-384x384.png">
<link rel="apple-touch-icon" sizes="512x512" href="{$baseUrl}/image/icon-512x512.png">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="{$baseUrl}/favicon.ico">

<!-- PWA Styles -->
<link rel="stylesheet" href="{$baseUrl}/pwa-styles.css">
HTML;
    }
}

if (!function_exists('pwa_scripts')) {
    /**
     * Generate PWA scripts
     * 
     * @return string
     */
    function pwa_scripts(): string
    {
        $baseUrl = base_url();
        
        return <<<HTML
<!-- PWA Scripts -->
<script src="{$baseUrl}/pwa.js"></script>
HTML;
    }
}

if (!function_exists('pwa_install_button')) {
    /**
     * Generate PWA install button
     * 
     * @param string $text
     * @param string $class
     * @return string
     */
    function pwa_install_button(string $text = 'Install Aplikasi', string $class = ''): string
    {
        return <<<HTML
<button id="pwa-install-btn" class="{$class}">{$text}</button>
HTML;
    }
}

if (!function_exists('is_pwa')) {
    /**
     * Check if app is running as PWA
     * 
     * @return bool
     */
    function is_pwa(): bool
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        // Check for standalone mode indicators
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            $_SERVER['HTTP_X_REQUESTED_WITH'] === 'PWA') {
            return true;
        }
        
        // Check user agent for PWA indicators
        if (strpos($userAgent, 'wv') !== false) {
            return true;
        }
        
        return false;
    }
}

if (!function_exists('pwa_cache_version')) {
    /**
     * Get PWA cache version
     * 
     * @return string
     */
    function pwa_cache_version(): string
    {
        return 'ulil-albab-v1';
    }
}

if (!function_exists('pwa_offline_page')) {
    /**
     * Generate offline page content
     * 
     * @return string
     */
    function pwa_offline_page(): string
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline - Ulil Albab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: #f5f5f5;
        }
        .offline-container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .offline-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        button {
            padding: 12px 24px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="offline-container">
        <div class="offline-icon">📡</div>
        <h1>Tidak Ada Koneksi</h1>
        <p>Anda sedang offline. Beberapa fitur mungkin tidak tersedia.</p>
        <button onclick="window.location.reload()">Coba Lagi</button>
    </div>
</body>
</html>
HTML;
    }
}
