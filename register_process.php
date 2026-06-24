<?php

header('Content-Type: application/json');

require_once 'db.php';

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if(empty($username) || empty($email) || empty($password)){

    echo json_encode([
        "status"=>"error",
        "message"=>"Semua field wajib diisi"
    ]);

    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    echo json_encode([
        "status"=>"error",
        "message"=>"Format email tidak valid"
    ]);

    exit;
}

$stmt = $pdo->prepare("
SELECT COUNT(*)
FROM users
WHERE username = :username
OR email = :email
");

$stmt->execute([
    ':username'=>$username,
    ':email'=>$email
]);

if($stmt->fetchColumn() > 0){

    echo json_encode([
        "status"=>"error",
        "message"=>"Username atau Email sudah digunakan"
    ]);

    exit;
}

$hashPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$stmt = $pdo->prepare("
INSERT INTO users
(username,email,password)
VALUES
(:username,:email,:password)
");

$stmt->execute([
    ':username'=>$username,
    ':email'=>$email,
    ':password'=>$hashPassword
]);

echo json_encode([
    "status"=>"success",
    "message"=>"Registrasi berhasil"
]);