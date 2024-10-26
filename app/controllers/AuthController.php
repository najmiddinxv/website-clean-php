<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class AuthController extends Controller {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role']; 

                header("Location: {$this->config['site_url']}?action=dashboard");
            } else {
                $this->render('login', ['error' => 'Invalid credentials']);
            }
        } else {
            $this->render('login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $password_confirmation = $_POST['password_confirmation'];
    
            if ($password !== $password_confirmation) {
                $this->render('register', ['error' => 'Passwords do not match']);
                return;
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->render('register', ['error' => 'Invalid email format']);
                return;
            }
    
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            $stmt = $this->pdo->prepare("INSERT INTO users (`username`, `email`, `password`) VALUES (:username, :email, :password)");
            
            if ($stmt->execute([':username' => $username, ':email' => $email, ':password' => $hashedPassword])) {
                $succesMessage = "Registration successful. Please login.";
                header("Location: {$this->config['site_url']}?action=login&success={$succesMessage}");
                exit();
            } else {
                $this->render('register', ['error' => 'Registration failed. Please try again.']);
            }
        } else {
            $this->render('register');
        }
    }
    

    public function logout() {
        session_destroy();
        header("Location: {$this->config['site_url']}?action=login");
    }
}
