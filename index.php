<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Sistem</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<div class="container">

<div class="row min-vh-100 align-items-center">

<div class="col-lg-6 text-white">

<h1 class="display-3 fw-bold">
Selamat Datang
</h1>

<p class="lead">
Secure User Dashboard & Management System
</p>

<p>
Silakan login untuk mengakses dashboard pengguna.
</p>

<a href="register.php" class="btn btn-register">
Daftar Akun
</a>

</div>

<div class="col-lg-4 offset-lg-1">

<div class="glass-card">

<h2 class="text-center mb-4">
Login
</h2>

<div id="alertBox"></div>

<form id="loginForm">

<div class="mb-3">
<label class="form-label">
Username / Email
</label>

<input
type="text"
name="login"
class="form-control"
required>
</div>

<div class="mb-4">

<label class="form-label">
Password
</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-login w-100"
id="btnLogin">

<span id="btnText">
Masuk
</span>

<span
id="spinner"
class="spinner-border spinner-border-sm d-none">
</span>

</button>

</form>

</div>

</div>

</div>

</div>

<script>

document.getElementById('loginForm')
.addEventListener('submit', async function(e){

e.preventDefault();

const formData = new FormData(this);

const alertBox =
document.getElementById('alertBox');

const btn =
document.getElementById('btnLogin');

const spinner =
document.getElementById('spinner');

const btnText =
document.getElementById('btnText');

btn.disabled = true;
spinner.classList.remove('d-none');
btnText.innerText = 'Memproses...';

try{

const response =
await fetch(
'login_process.php',
{
method:'POST',
body:formData
}
);

const data =
await response.json();

if(data.status === 'success'){

alertBox.innerHTML = `
<div class="alert alert-success">
${data.message}
</div>
`;

setTimeout(()=>{
window.location =
'dashboard.php';
},1000);

}else{

alertBox.innerHTML = `
<div class="alert alert-danger">
${data.message}
</div>
`;

}

}catch(error){

alertBox.innerHTML = `
<div class="alert alert-danger">
Gagal terhubung ke server.
</div>
`;

}

btn.disabled = false;
spinner.classList.add('d-none');
btnText.innerText = 'Masuk';

});

</script>

</body>
</html>