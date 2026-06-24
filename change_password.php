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

$old = $_POST['old_password'] ?? '';
$new = $_POST['new_password'] ?? '';

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

if(!password_verify($old,$user['password'])){

    echo json_encode([
        "status"=>"error",
        "message"=>"Password lama salah"
    ]);

    exit;
}

$newHash = password_hash(
    $new,
    PASSWORD_DEFAULT
);

$stmt = $pdo->prepare("
UPDATE users
SET password=:password
WHERE id=:id
");

$stmt->execute([
    ':password'=>$newHash,
    ':id'=>$id
]);

echo json_encode([
    "status"=>"success",
    "message"=>"Password berhasil diubah"
]);

?>