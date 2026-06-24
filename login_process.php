<?php

session_start();

header('Content-Type: application/json');

require_once 'db.php';

$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("
SELECT *
FROM users
WHERE username = :login
OR email = :login
LIMIT 1
");

$stmt->execute([
    ':login'=>$login
]);

$user = $stmt->fetch();

if(!$user){

    echo json_encode([
        "status"=>"error",
        "message"=>"Akun tidak ditemukan"
    ]);

    exit;
}

if(!password_verify($password,$user['password'])){

    echo json_encode([
        "status"=>"error",
        "message"=>"Password salah"
    ]);

    exit;
}

$_SESSION['user_id'] = $user['id'];

echo json_encode([
    "status"=>"success",
    "message"=>"Login berhasil"
]);
?>