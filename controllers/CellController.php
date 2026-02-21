<?php
// controllers/CellController.php

require_once __DIR__ . '/../models/Cell.php';
require_once __DIR__ . '/../models/Member.php';
require_once __DIR__ . '/AuthController.php';

class CellController {
    private $pdo;
    private $cellModel;
    private $memberModel;
    

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->cellModel = new Cell($pdo);
        $this->memberModel = new Member($pdo);
    }

    public function index() {
        $cells = Cell::getAll($this->pdo);
        $members = Member::getAll($this->pdo);
        $totalMembers = count($members);
        AuthController::checkAuth();
        // Calculer le total des cotisations (optionnel)
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cells/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function list() {
        $cells = Cell::getAll($this->pdo);
        $members = Member::getAll($this->pdo);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cells/list.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function show($id) {
        $cell = Cell::find($this->pdo, $id);
        if (!$cell) {
            header('Location: /cellules');
            exit;
        }
        $members = Member::getAll($this->pdo, $id);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cells/show.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}