<?php
// controllers/CotisationController.php

require_once __DIR__ . '/../models/Cotisation.php';
require_once __DIR__ . '/../models/Member.php';
require_once __DIR__ . '/../models/Cell.php';
require_once __DIR__ . '/AuthController.php';

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
        AuthController::checkAuth();
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
        $memberId = $_POST['member_id'] ?? null;
        $cellId = $_POST['cell_id'] ?? null;
        $month = $_POST['month'] ?? null;
        $year = $_POST['year'] ?? null;

        if (!$memberId || !$cellId || !$month || !$year) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Paramètres manquants']);
            exit;
        }

        $success = Cotisation::toggle($this->pdo, $memberId, $cellId, $month, $year);
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
        exit;
    }
}
public function graphData() {
    $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
    $cellId = isset($_GET['cell_id']) && $_GET['cell_id'] !== '' ? (int)$_GET['cell_id'] : null;

    // Récupérer les cotisations pour l'année
    $cotisations = Cotisation::getAll($this->pdo, $year, $cellId);

    // Initialiser un tableau de 12 mois avec 0
    $paidByMonth = array_fill(1, 12, 0);
    $totalByMonth = array_fill(1, 12, 0);

    foreach ($cotisations as $c) {
        $month = $c['month'];
        if ($c['paid']) {
            $paidByMonth[$month] += 1;
        }
        $totalByMonth[$month] += 1; // total de cotisations pour le mois (y compris impayées)
    }

    // Calculer les pourcentages de paiement par mois
    $percentByMonth = [];
    for ($m = 1; $m <= 12; $m++) {
        $percent = ($totalByMonth[$m] > 0) ? round(($paidByMonth[$m] / $totalByMonth[$m]) * 100) : 0;
        $percentByMonth[$m] = $percent;
    }

    // Données pour un graphique par cellule (si pas de filtre cellule)
    $cellData = [];
    if (!$cellId) {
        $cells = Cell::getAll($this->pdo);
        foreach ($cells as $cell) {
            // Compter les cotisations payées pour cette cellule et cette année
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM cotisations WHERE cell_id = ? AND year = ? AND paid = 1");
            $stmt->execute([$cell['id'], $year]);
            $paidCount = $stmt->fetchColumn();
            $cellData[] = [
                'cell' => $cell['short_name'],
                'paid' => $paidCount
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode([
        'year' => $year,
        'cellId' => $cellId,
        'paidByMonth' => array_values($paidByMonth), // pour Chart.js (indexé 0-11)
        'percentByMonth' => array_values($percentByMonth),
        'cellData' => $cellData
    ]);
    exit;
}
}