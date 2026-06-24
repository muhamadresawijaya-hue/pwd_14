<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registrasi Akun</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<div class="container">

<div class="row min-vh-100 justify-content-center align-items-center">

<div class="col-lg-5">

<div class="glass-card">

<h2 class="text-center mb-4">
Registrasi Akun
</h2>

<div id="alertBox"></div>

<form id="registerForm">

<div class="mb-3">
<label class="form-label">
Username
</label>

<input
type="text"
name="username"
class="form-control"
required>
</div>

<div class="mb-3">
<label class="form-label">
Email
</label>

<input
type="email"
name="email"
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
id="btnRegister">

<span id="btnText">
Daftar Akun
</span>

<span
id="spinner"
class="spinner-border spinner-border-sm d-none">
</span>

</button>

<div class="text-center mt-3">

<a
href="index.php"
class="text-white text-decoration-none">

Sudah punya akun? Login

</a>

</div>

</form>

</div>

</div>

</div>

</div>

<script>

document
.getElementById('registerForm')
.addEventListener('submit', async function(e){

e.preventDefault();

const formData = new FormData(this);

const alertBox =
document.getElementById('alertBox');

const btn =
document.getElementById('btnRegister');

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
'register_process.php',
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
window.location.href='index.php';
},1500);

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

console.log(error);

}

btn.disabled = false;

spinner.classList.add('d-none');

btnText.innerText = 'Daftar Akun';

});

</script>

</body>
</html>