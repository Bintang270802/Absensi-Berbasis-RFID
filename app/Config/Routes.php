<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Cpanel::index');
$routes->get('/Web/(:alpha)', 'Web::index/$1');

// PWA Routes
$routes->get('manifest.json', 'PWA::manifest');
$routes->get('sw.js', 'PWA::serviceWorker');
$routes->get('offline', 'PWA::offline');
$routes->get('pwa/status', 'PWA::status');
$routes->get('pwa/install', 'PWA::installInstructions');

// PWA Download Routes
$routes->get('pwa/download', 'PWADownload::generatePackage');
$routes->get('pwa/download/package', 'PWADownload::downloadPackage');
$routes->get('pwa/download/offline-installer', 'PWADownload::createOfflineInstaller');
$routes->get('pwa/download/generate-offline-installer', 'PWADownload::generateOfflineInstaller');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
