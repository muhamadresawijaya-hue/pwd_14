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

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');

$stmt = $pdo->prepare("
UPDATE users
SET username=:username,
email=:email
WHERE id=:id
");

$stmt->execute([
    ':username'=>$username,
    ':email'=>$email,
    ':id'=>$id
]);

echo json_encode([
    "status"=>"success",
    "message"=>"Profil berhasil diperbarui"
]);
?>