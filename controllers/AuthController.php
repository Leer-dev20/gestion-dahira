<?php
// controllers/AuthController.php

class AuthController {
    private $pdo;
    
public function index() {
    AuthController::checkAuth();
    // reste du code
}
    public function __construct($pdo) {
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Afficher le formulaire de connexion
    public function loginForm() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Traiter la soumission du formulaire
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Identifiants par défaut (à modifier ou à stocker en base)
            if ($username === 'admin' && $password === 'password') {
                $_SESSION['user'] = $username;
                header('Location: /dahira-gestion/public/');
                exit;
            } else {
                $error = "Identifiants incorrects";
                require_once __DIR__ . '/../views/layouts/header.php';
                require_once __DIR__ . '/../views/auth/login.php';
                require_once __DIR__ . '/../views/layouts/footer.php';
            }
        }
    }

    // Déconnexion
    public function logout() {
        session_destroy();
        header('Location: /dahira-gestion/public/login');
        exit;
    }

    // Vérifier si l'utilisateur est connecté
    public static function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: /dahira-gestion/public/login');
            exit;
        }
    }
}