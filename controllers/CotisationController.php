<?php
// controllers/CotisationController.php

require_once __DIR__ . '/../models/Cotisation.php';
require_once __DIR__ . '/../models/Member.php';
require_once __DIR__ . '/../models/Cell.php';

class CotisationController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
        $cellId = isset($_GET['cell_id']) && $_GET['cell_id'] !== '' ? (int)$_GET['cell_id'] : null;

        $members = Member::getAll($this->pdo, $cellId);
        $cotisations = Cotisation::getAll($this->pdo, $year, $cellId);
        $cells = Cell::getAll($this->pdo);

        // Organiser les cotisations par membre et mois
        $cotisationsByMember = [];
        foreach ($cotisations as $c) {
            $cotisationsByMember[$c['member_id']][$c['month']] = $c;
        }

        $stats = Cotisation::getStats($this->pdo, $year, $cellId);

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cotisations/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function toggle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $memberId = $_POST['member_id'];
            $cellId = $_POST['cell_id'];
            $month = $_POST['month'];
            $year = $_POST['year'];

            Cotisation::toggle($this->pdo, $memberId, $cellId, $month, $year);
            // Répondre en JSON pour AJAX
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }
}