<?php
// models/Cell.php

require_once __DIR__ . '/../config/database.php';

class Cell {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM cells ORDER BY id");
        return $stmt->fetchAll();
    }

    public static function find($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM cells WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getMemberCount($cellId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM members WHERE cell_id = ?");
        $stmt->execute([$cellId]);
        return $stmt->fetchColumn();
    }
}