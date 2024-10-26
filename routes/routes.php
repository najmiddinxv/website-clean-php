<?php

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\DashboardController;
use Core\Controller;

$authController = new AuthController();
$userController = new UserController();
$dashboardController = new DashboardController();
$coreController = new Controller();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'access-denied':
        $coreController->accessDenied();
        break;
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
            $dashboardController->dashboard();
        break;
    case 'users':
            $userController->users();
        break;
    case 'users-create':
        $userController->create();
        break;
    default:
        $authController->login();
}
