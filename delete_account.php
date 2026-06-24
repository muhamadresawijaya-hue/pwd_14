<?php

session_start();

header('Content-Type: application/json');

require_once 'db.php';

if(!isset($_SESSION['user_id'])){
    echo json_encode([
        "status"=>"error",
        "message"=>"Silakan login terlebih dahulu"
    ]);
    exit;
}

$id = $_SESSION['user_id'];

$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("
SELECT *
FROM users
WHERE id=:id
");

$stmt->execute([
    ':id'=>$id
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){

    echo json_encode([
        "status"=>"error",
        "message"=>"User tidak ditemukan"
    ]);

    exit;
}

if(!password_verify($password,$user['password'])){

    echo json_encode([
        "status"=>"error",
        "message"=>"Password konfirmasi salah"
    ]);

    exit;
}

$stmt = $pdo->prepare("
DELETE FROM users
WHERE id=:id
");

$stmt->execute([
    ':id'=>$id
]);

session_destroy();

echo json_encode([
    "status"=>"success",
    "message"=>"Akun berhasil dihapus"
]);

?>