<?php

// session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
// include 'navbar/navbar.php';

$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}

echo 'Conexion correcta ';


$sql_select = "SELECT * FROM eventos_culturales WHERE categoría = 'Cultural Alternativo'";
$res = $conect->query($sql_select);

if ($res !== false) {
    echo 'Consulta exitosa!';

    while ($row = $res->fetch_assoc()) {
        print_r($row);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <?php if (isset($user)) : ?>
        <h1>Hola <?php echo $user ?></h1>
    <?php endif; ?>
</body>

</html>