<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Base Authentication Controller
 * 
 * Provides authentication and authorization functionality
 * All authenticated controllers should extend this class
 * 
 * @package    App\Controllers
 * @author     Your Name
 * @copyright  2024
 */
class BaseAuthController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseAuthController.
     *
     * @var array
     */
    protected $helpers = ['attendance', 'form', 'url'];

    /**
     * Session instance
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Current user data
     *
     * @var array
     */
    protected $currentUser = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        
        // Set timezone
        date_default_timezone_set('Asia/Jakarta');
        
        // Load current user data
        $this->loadCurrentUser();
    }

    /**
     * Load current user data from session
     *
     * @return void
     */
    protected function loadCurrentUser(): void
    {
        if ($this->session->has('logged_in') && $this->session->get('logged_in')) {
            $this->currentUser = [
                'id' => $this->session->get('id'),
                'nama' => $this->session->get('nama'),
                'level' => $this->session->get('level'),
                'id_tapel' => $this->session->get('id_tapel') ?? 1
            ];
        }
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    protected function isAuthenticated(): bool
    {
        return $this->session->has('logged_in') && $this->session->get('logged_in');
    }

    /**
     * Require authentication
     * Redirect to login if not authenticated
     *
     * @return void
     */
    protected function requireAuth(): void
    {
        if (!$this->isAuthenticated()) {
            $this->session->setFlashdata('error', 'Silakan login terlebih dahulu');
            redirect()->to('Cpanel')->send();
            exit;
        }
    }

    /**
     * Check if user has specific level
     *
     * @param int|array $levels Required level(s)
     * @return bool
     */
    protected function hasLevel($levels): bool
    {
        if (!$this->isAuthenticated()) {
            return false;
        }

        $userLevel = $this->currentUser['level'] ?? 0;
        
        if (is_array($levels)) {
            return in_array($userLevel, $levels);
        }
        
        return $userLevel === $levels;
    }

    /**
     * Require specific user level
     * Redirect if user doesn't have required level
     *
     * @param int|array $levels Required level(s)
     * @param string $message Error message
     * @return void
     */
    protected function requireLevel($levels, string $message = 'Anda tidak memiliki akses'): void
    {
        $this->requireAuth();
        
        if (!$this->hasLevel($levels)) {
            $this->session->setFlashdata('error', $message);
            redirect()->to('Dashboard')->send();
            exit;
        }
    }

    /**
     * Get current user data
     *
     * @param string|null $key Specific key to get
     * @return mixed
     */
    protected function getCurrentUser(?string $key = null)
    {
        if ($key === null) {
            return $this->currentUser;
        }
        
        return $this->currentUser[$key] ?? null;
    }

    /**
     * Get current academic year ID
     *
     * @return int
     */
    protected function getCurrentAcademicYear(): int
    {
        return $this->currentUser['id_tapel'] ?? 1;
    }

    /**
     * Set success message
     *
     * @param string $message Success message
     * @return void
     */
    protected function setSuccess(string $message): void
    {
        $this->session->setFlashdata('success', $message);
    }

    /**
     * Set error message
     *
     * @param string $message Error message
     * @return void
     */
    protected function setError(string $message): void
    {
        $this->session->setFlashdata('error', $message);
    }

    /**
     * Set info message
     *
     * @param string $message Info message
     * @return void
     */
    protected function setInfo(string $message): void
    {
        $this->session->setFlashdata('info', $message);
    }

    /**
     * Validate CSRF token
     *
     * @return bool
     */
    protected function validateCSRF(): bool
    {
        $validation = \Config\Services::validation();
        return $validation->check($this->request->getPost('csrf_token'), 'required');
    }

    /**
     * Log activity
     *
     * @param string $action Action performed
     * @param string $description Description of action
     * @return void
     */
    protected function logActivity(string $action, string $description = ''): void
    {
        if (!$this->isAuthenticated()) {
            return;
        }

        $db = \Config\Database::connect();
        $builder = $db->table('t_log_activity');
        
        $data = [
            'user_id' => $this->currentUser['id'],
            'action' => $action,
            'description' => $description,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        try {
            $builder->insert($data);
        } catch (\Exception $e) {
            // Log error but don't break the application
            log_message('error', 'Failed to log activity: ' . $e->getMessage());
        }
    }

    /**
     * Render view with common data
     *
     * @param string $view View name
     * @param array $data Data to pass to view
     * @param bool $withLayout Include layout
     * @return string
     */
    protected function renderView(string $view, array $data = [], bool $withLayout = true): string
    {
        // Add common data
        $commonData = [
            'currentUser' => $this->currentUser,
            'pageTitle' => $data['title'] ?? 'Dashboard',
            'currentYear' => date('Y')
        ];
        
        $data = array_merge($commonData, $data);
        
        if ($withLayout) {
            return view('index/sidebar', $data)
                . view('func')
                . view('index/navbar', $data)
                . view($view, $data)
                . view('index/footer', $data);
        }
        
        return view($view, $data);
    }

    /**
     * Return JSON response
     *
     * @param mixed $data Data to return
     * @param int $statusCode HTTP status code
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    protected function jsonResponse($data, int $statusCode = 200): ResponseInterface
    {
        return $this->response
            ->setStatusCode($statusCode)
            ->setJSON($data);
    }

    /**
     * Return success JSON response
     *
     * @param mixed $data Data to return
     * @param string $message Success message
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    protected function jsonSuccess($data = null, string $message = 'Success'): ResponseInterface
    {
        return $this->jsonResponse([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Return error JSON response
     *
     * @param string $message Error message
     * @param int $statusCode HTTP status code
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    protected function jsonError(string $message, int $statusCode = 400): ResponseInterface
    {
        return $this->jsonResponse([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
}
