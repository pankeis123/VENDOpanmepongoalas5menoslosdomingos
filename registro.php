<?php
session_start(); // Se supone que esto almacena los usuarios para poder mostrar la demostrasion
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = trim($_POST['nombre']);
    $u = trim($_POST['usuario']);
    $p = $_POST['password'];
    $c = $_POST['confirm_password'];
    if (empty($n) || empty($u) || empty($p) || empty($c)) {
        $msg = "Todos los campos son obligatorios.";
    } elseif (strlen($p) < 6) {
        $msg = "Mínimo 6 caracteres.";
    } elseif ($p !== $c) {
        $msg = "Las contraseñas no son identicas.";
    } else {
        $_SESSION['usuarios'][$u] = [
            'nombre' => $n,
            'password_hash' => password_hash($p, PASSWORD_DEFAULT)  ];
        $msg = "Registrado Guardado.";
    }
}
?>
<form method="POST">
    Nombre: <input type="text" name="nombre"><br>
    Usuario: <input type="text" name="usuario"><br>
    Contraseña: <input type="password" name="password"><br>
    Confirmar: <input type="password" name="confirm_password"><br>
    <input type="submit" value="Registrar">
</form>
<p><?php echo $msg; ?></p>
<a href="login.php">Ir a Login</a>