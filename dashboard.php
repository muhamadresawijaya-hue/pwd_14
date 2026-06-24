<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Pengguna</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<div class="container py-5">

<div class="glass-card mx-auto" style="max-width:900px;">

<div class="text-center mb-5">

<div class="profile-icon mb-3">
👤
</div>

<h1 id="welcomeUser">
Halo, Pengguna 👋
</h1>

<p class="text-light">
Selamat datang di Dashboard Pengguna
</p>

</div>

<div id="alertBox"></div>

<!-- DATA PROFIL -->

<h3 class="mb-3">
👤 Profil Saya
</h3>

<table class="table table-bordered">

<tr>
<th width="30%">Username</th>
<td id="username"></td>
</tr>

<tr>
<th>Email</th>
<td id="email"></td>
</tr>

</table>

<hr class="my-4">

<!-- UPDATE PROFIL -->

<h3 class="mb-3">
✏️ Update Profil
</h3>

<form id="updateForm">

<div class="mb-3">

<label class="form-label">
Username Baru
</label>

<input
type="text"
name="username"
id="updateUsername"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Email Baru
</label>

<input
type="email"
name="email"
id="updateEmail"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-update">

Simpan Perubahan

</button>

</form>

<hr class="my-4">

<!-- GANTI PASSWORD -->

<h3 class="mb-3">
🔒 Ganti Password
</h3>

<form id="passwordForm">

<div class="mb-3">

<label class="form-label">
Password Lama
</label>

<input
type="password"
name="old_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Password Baru
</label>

<input
type="password"
name="new_password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-warning">

Ganti Password

</button>

</form>

<hr class="my-4">

<!-- HAPUS AKUN -->

<h3 class="mb-3">
🗑️ Hapus Akun
</h3>

<form id="deleteForm">

<div class="mb-3">

<label class="form-label">
Masukkan Password
</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-delete">

Hapus Akun

</button>

</form>

<hr class="my-4">

<!-- LOGOUT -->

<button
id="logoutBtn"
class="btn btn-logout w-100">

🚪 Logout

</button>

</div>

</div>

<script>

loadProfile();

async function loadProfile(){

try{

const response =
await fetch('get_profile.php');

const data =
await response.json();

document.getElementById('username').innerText =
data.username;

document.getElementById('email').innerText =
data.email;

document.getElementById('welcomeUser').innerText =
'Halo, ' + data.username + ' 👋';

document.getElementById('updateUsername').value =
data.username;

document.getElementById('updateEmail').value =
data.email;

}catch(error){

console.log(error);

}

}

/* UPDATE PROFIL */

document
.getElementById('updateForm')
.addEventListener('submit', async function(e){

e.preventDefault();

const formData =
new FormData(this);

const response =
await fetch(
'update_profile.php',
{
method:'POST',
body:formData
}
);

const data =
await response.json();

alert(data.message);

loadProfile();

});

/* GANTI PASSWORD */

document
.getElementById('passwordForm')
.addEventListener('submit', async function(e){

e.preventDefault();

const formData =
new FormData(this);

const response =
await fetch(
'change_password.php',
{
method:'POST',
body:formData
}
);

const data =
await response.json();

alert(data.message);

this.reset();

});

/* HAPUS AKUN */

document
.getElementById('deleteForm')
.addEventListener('submit', async function(e){

e.preventDefault();

if(!confirm('Yakin ingin menghapus akun?')){
return;
}

const formData =
new FormData(this);

const response =
await fetch(
'delete_account.php',
{
method:'POST',
body:formData
}
);

const data =
await response.json();

alert(data.message);

if(data.status === 'success'){
window.location='index.php';
}

});

/* LOGOUT */

document
.getElementById('logoutBtn')
.addEventListener('click', async ()=>{

await fetch('logout.php');

window.location='index.php';

});

</script>

</body>
</html>