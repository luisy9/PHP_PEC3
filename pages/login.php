<?php
// include '../navbar/navbar.php';


$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . $conect->connect_error);
}


if (isset($_POST['add_user'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['password'])) {

        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        $query = $conect->prepare("SELECT * FROM users WHERE nombre=?");
        $query->bind_param('s', $nombre);
        $query->execute();
        $resultado = $query->get_result();
        $usuarioBD = $resultado->fetch_assoc();

        if ($usuarioBD && password_verify($password, $usuarioBD['password'])) {
            session_start();
            $_SESSION['user'] = $usuarioBD['nombre'];
            header('Location: index.php');
        } else {
            echo "";
        }
    } else {
        echo 'falta un campo';
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="index.css" rel="stylesheet" />
</head>

<body>
    <div class="div_form">
        <form method="POST">
            <h2>Login</h2>
            <div class="div_control_input">
                <label for="nombre">Nombre:</label>
                <input type="text" class="" name="nombre" id="nombre" />
            </div>

            <div class="div_control_input">
                <label for="password">Password:</label>
                <input type="password" class="" name="password" id="password" />
            </div>
            <div class="div_control_button">
                <input type="submit" value="Login" name="add_user" class="button" />
            </div>
        </form>
    </div>
</body>

</html>