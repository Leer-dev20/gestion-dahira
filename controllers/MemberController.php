<?php
// controllers/MemberController.php

require_once __DIR__ . '/../models/Member.php';
require_once __DIR__ . '/../models/Cell.php';
require_once __DIR__ . '/AuthController.php';

class MemberController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        AuthController::checkAuth();
        $members = Member::getAll($this->pdo);
        $cells = Cell::getAll($this->pdo);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/members/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'cell_id' => $_POST['cell_id'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'join_date' => $_POST['join_date'],
                'role' => $_POST['role'],
            ];
            Member::create($this->pdo, $data);
            header('Location: /dahira-gestion/public/membres');
            exit;
        }
        $cells = Cell::getAll($this->pdo);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/members/form.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function edit($id) {
        $member = Member::find($this->pdo, $id);
        if (!$member) {
            header('Location: /dahira-gestion/public/membres');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'cell_id' => $_POST['cell_id'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'join_date' => $_POST['join_date'],
                'role' => $_POST['role'],
            ];
            Member::update($this->pdo, $id, $data);
            header('Location: /dahira-gestion/public/membres');
            exit;
        }
        $cells = Cell::getAll($this->pdo);
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/members/form.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function delete($id) {
        Member::delete($this->pdo, $id);
        header('Location: /dahira-gestion/public/membres');
        exit;
    }
}