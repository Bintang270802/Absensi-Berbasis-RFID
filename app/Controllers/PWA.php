<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PWA extends Controller
{
    /**
     * Serve manifest.json
     */
    public function manifest()
    {
        $manifest = [
            'name' => 'Sekolah Ulil Albab',
            'short_name' => 'Ulil Albab',
            'description' => 'Aplikasi Sekolah Ulil Albab',
            'start_url' => base_url('/'),
            'display' => 'standalone',
            'background_color' => '#ffffff',
            'theme_color' => '#4CAF50',
            'orientation' => 'portrait-primary',
            'icons' => [
                [
                    'src' => base_url('image/icon-72x72.png'),
                    'sizes' => '72x72',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-96x96.png'),
                    'sizes' => '96x96',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-128x128.png'),
                    'sizes' => '128x128',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-144x144.png'),
                    'sizes' => '144x144',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-152x152.png'),
                    'sizes' => '152x152',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-192x192.png'),
                    'sizes' => '192x192',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-384x384.png'),
                    'sizes' => '384x384',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => base_url('image/icon-512x512.png'),
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ]
            ]
        ];

        return $this->response
            ->setContentType('application/json')
            ->setBody(json_encode($manifest));
    }

    /**
     * Serve service worker
     */
    public function serviceWorker()
    {
        $this->response->setContentType('application/javascript');
        return view('pwa/service_worker');
    }

    /**
     * Offline page
     */
    public function offline()
    {
        return view('pwa/offline');
    }

    /**
     * Check PWA status
     */
    public function status()
    {
        $data = [
            'pwa_enabled' => true,
            'service_worker' => 'active',
            'cache_version' => pwa_cache_version(),
            'is_pwa' => is_pwa(),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        return $this->response
            ->setContentType('application/json')
            ->setBody(json_encode($data));
    }

    /**
     * Install instructions page
     */
    public function installInstructions()
    {
        return view('pwa/install_instructions');
    }
}
