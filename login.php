<?php
session_start();

if (!empty($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($user === 'admin' && $pass === '1234') {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
body{font-family:Arial;background:#ffe4ec;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
.card{background:white;padding:24px;border-radius:18px;box-shadow:0 12px 30px rgba(214,51,132,.08);width:320px}
input,button{width:100%;padding:12px;margin-top:10px;border-radius:12px;border:1px solid #f3c7d4;font-size:15px}
button{background:#ff85a2;color:white;border:none;cursor:pointer}
h2{text-align:center;color:#d63384;margin-top:0}
.err{color:#c62828;text-align:center;margin-top:10px}
</style>
</head>
<body>
  <form class="card" method="POST">
    <h2>Panel privado</h2>
    <input type="text" name="user" placeholder="Usuario" required>
    <input type="password" name="pass" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
    <?php if ($error): ?><div class="err"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
  </form>
</body>
</html>
