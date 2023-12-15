<?php

include 'includes/navbar.php';

$server_name = 'localhost';
$username = 'lde_harop';
$password = 'QlX0OGOz';
$db = 'lde_harop';

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . $conect->connect_error);
}

$conect->set_charset("utf8mb4");

$allEventos = $conect->prepare("SELECT * FROM eventos_culturales");
$res = $allEventos->execute();

if ($res !== false) {
    $result = $allEventos->get_result();
    $events = $result->fetch_all(MYSQLI_ASSOC);
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($events);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener eventos']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" />
    <title>api/events</title>
</head>

<body>

</body>

</html>