<?php

session_start();

header('Content-Type: application/json');

require_once 'db.php';

if(!isset($_SESSION['user_id'])){
    echo json_encode([
        "status"=>"error",
        "message"=>"Belum login"
    ]);
    exit;
}

$id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
SELECT username,email
FROM users
WHERE id = ?
LIMIT 1
");

$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){

    echo json_encode([
        "status"=>"error",
        "message"=>"User tidak ditemukan",
        "id_session"=>$id
    ]);

    exit;
}

echo json_encode($user);