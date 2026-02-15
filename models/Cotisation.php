<?php
// models/Cotisation.php

require_once __DIR__ . '/../config/database.php';

class Cotisation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public static function getAll($pdo, $year, $cellId = null) {
        $sql = "SELECT * FROM cotisations WHERE year = ?";
        $params = [$year];
        if ($cellId) {
            $sql .= " AND cell_id = ?";
            $params[] = $cellId;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function getByMember($pdo, $memberId, $year) {
        $stmt = $pdo->prepare("SELECT * FROM cotisations WHERE member_id = ? AND year = ?");
        $stmt->execute([$memberId, $year]);
        $rows = $stmt->fetchAll();
        $indexed = [];
        foreach ($rows as $row) {
            $indexed[$row['month']] = $row;
        }
        return $indexed;
    }

    public static function toggle($pdo, $memberId, $cellId, $month, $year) {
        // Vérifier si une ligne existe
        $stmt = $pdo->prepare("SELECT id, paid FROM cotisations WHERE member_id = ? AND month = ? AND year = ?");
        $stmt->execute([$memberId, $month, $year]);
        $existing = $stmt->fetch();

        if ($existing) {
            // Basculer paid
            $newPaid = !$existing['paid'];
            $update = $pdo->prepare("UPDATE cotisations SET paid = ?, paid_date = IF(? = 1, CURDATE(), NULL) WHERE id = ?");
            return $update->execute([$newPaid, $newPaid, $existing['id']]);
        } else {
            // Créer une nouvelle ligne avec paid = true
            $insert = $pdo->prepare("INSERT INTO cotisations (member_id, cell_id, month, year, amount, paid, paid_date) VALUES (?, ?, ?, ?, 100, 1, CURDATE())");
            return $insert->execute([$memberId, $cellId, $month, $year]);
        }
    }

    public static function getStats($pdo, $year, $cellId = null) {
        // Compter le nombre total de membres (distincts) dans la cellule ou global
        $sqlMembers = "SELECT COUNT(DISTINCT id) FROM members";
        $params = [];
        if ($cellId) {
            $sqlMembers .= " WHERE cell_id = ?";
            $params[] = $cellId;
        }
        $stmt = $pdo->prepare($sqlMembers);
        $stmt->execute($params);
        $totalMembers = $stmt->fetchColumn();

        // Nombre total de cotisations payées pour l'année
        $sqlPaid = "SELECT COUNT(*) FROM cotisations WHERE year = ? AND paid = 1";
        $paramsPaid = [$year];
        if ($cellId) {
            $sqlPaid .= " AND cell_id = ?";
            $paramsPaid[] = $cellId;
        }
        $stmt = $pdo->prepare($sqlPaid);
        $stmt->execute($paramsPaid);
        $totalPaid = $stmt->fetchColumn();

        // Montant total collecté
        $sqlAmount = "SELECT SUM(amount) FROM cotisations WHERE year = ? AND paid = 1";
        $paramsAmount = [$year];
        if ($cellId) {
            $sqlAmount .= " AND cell_id = ?";
            $paramsAmount[] = $cellId;
        }
        $stmt = $pdo->prepare($sqlAmount);
        $stmt->execute($paramsAmount);
        $totalAmount = $stmt->fetchColumn() ?: 0;

        // Membres en retard (ayant au moins un mois impayé pour les mois écoulés de l'année)
        // Pour simplifier, on ne calcule pas ce chiffre ici, on le fera dans le contrôleur si nécessaire.

        return [
            'totalMembers' => $totalMembers,
            'totalPaid' => $totalPaid,
            'totalAmount' => $totalAmount,
        ];
    }
}