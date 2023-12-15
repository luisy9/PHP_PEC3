<?php

// session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
// include 'navbar/navbar.php';

$server_name = 'localhost';
$username = 'lde_harop';
$password = 'QlX0OGOz';
$db = 'lde_harop';
$port = 3306;

$conect = new mysqli($server_name, $username, $password, $db, $port);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}

$conect->set_charset("utf8mb4");

echo 'Conexion correcta ';


$sql_select = "SELECT * FROM eventos_culturales ORDER BY RAND() LIMIT 1";
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