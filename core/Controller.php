<?php

namespace Core;

class Controller {

    protected $config;
    
    public function __construct(){
        
        $this->config = require __DIR__ . '/../config/config.php';
    }

    protected function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../app/views/' . $view . '.php';
    }

    protected function checkAccess($requiredRole = null) {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: {$this->config['site_url']}?action=login");
            exit();
        }

        // Check if the user has the required role (e.g., 'admin')
        if ($requiredRole && (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole)) {
            header("Location: {$this->config['site_url']}?action=access-denied");
            exit();
        }
    }

    
    public function accessDenied() {
        $this->render('access-denied');
    }
}
