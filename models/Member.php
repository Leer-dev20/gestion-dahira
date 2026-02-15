<?php
// models/Member.php

require_once __DIR__ . '/../config/database.php';

class Member {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public static function getAll($pdo, $cellId = null) {
        $sql = "SELECT m.*, c.short_name as cell_name FROM members m JOIN cells c ON m.cell_id = c.id";
        $params = [];
        if ($cellId) {
            $sql .= " WHERE m.cell_id = ?";
            $params[] = $cellId;
        }
        $sql .= " ORDER BY m.last_name, m.first_name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function find($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create($pdo, $data) {
        $sql = "INSERT INTO members (cell_id, first_name, last_name, phone, email, address, join_date, role) 
                VALUES (:cell_id, :first_name, :last_name, :phone, :email, :address, :join_date, :role)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public static function update($pdo, $id, $data) {
        $data['id'] = $id;
        $sql = "UPDATE members SET cell_id=:cell_id, first_name=:first_name, last_name=:last_name, 
                phone=:phone, email=:email, address=:address, join_date=:join_date, role=:role WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public static function delete($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
        return $stmt->execute([$id]);
    }
}