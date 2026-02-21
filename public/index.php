<?php
// public/index.php

session_start();

// Inclure la configuration et les modèles
$pdo = require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/CellController.php';
require_once __DIR__ . '/../controllers/MemberController.php';
require_once __DIR__ . '/../controllers/CotisationController.php';

$request = $_SERVER['REQUEST_URI'];
$base = '/dahira-gestion/public'; // À adapter selon votre configuration
$path = str_replace($base, '', parse_url($request, PHP_URL_PATH));

// ... après l'inclusion des contrôleurs

$request = $_SERVER['REQUEST_URI'];
$base = '/dahira-gestion/public';
$path = str_replace($base, '', parse_url($request, PHP_URL_PATH));

// Routes d'authentification (publiques)
if ($path === '/login') {
    $controller = new AuthController($pdo);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    } else {
        $controller->loginForm();
    }
    exit;
}

if ($path === '/logout') {
    $controller = new AuthController($pdo);
    $controller->logout();
    exit;
}

// Routes protégées (tout le reste nécessite authentification)
// On vérifie l'authentification avant d'instancier les contrôleurs
// Mais il est plus simple de faire la vérification dans chaque contrôleur.

// ... suite du switch existant

// Routage simple
switch ($path) {
    case '/':
    case '/index.php':
        $controller = new CellController($pdo);
        $controller->index();
        break;
    case '/cellules':
        $controller = new CellController($pdo);
        $controller->list();
        break;
    case (preg_match('/^\/cellule\/(\d+)$/', $path, $matches) ? true : false):
        $controller = new CellController($pdo);
        $controller->show($matches[1]);
        break;
    case '/membres':
        $controller = new MemberController($pdo);
        $controller->index();
        break;
    case '/membre/ajouter':
        $controller = new MemberController($pdo);
        $controller->add();
        break;
    case (preg_match('/^\/membre\/modifier\/(\d+)$/', $path, $matches) ? true : false):
        $controller = new MemberController($pdo);
        $controller->edit($matches[1]);
        break;
    case (preg_match('/^\/membre\/supprimer\/(\d+)$/', $path, $matches) ? true : false):
        $controller = new MemberController($pdo);
        $controller->delete($matches[1]);
        break;
    case '/cotisations':
        $controller = new CotisationController($pdo);
        $controller->index();
        break;
    case '/cotisations/toggle':
        $controller = new CotisationController($pdo);
        $controller->toggle();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
    case '/cotisations/graph-data':
    $controller = new CotisationController($pdo);
    $controller->graphData();
    break;
}
// Routes publiques (authentification)
if ($path === '/login') {
    $controller = new AuthController($pdo);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    } else {
        $controller->loginForm();
    }
    return;
}

if ($path === '/logout') {
    $controller = new AuthController($pdo);
    $controller->logout();
    return;
}