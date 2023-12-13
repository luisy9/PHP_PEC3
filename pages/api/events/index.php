<?php

$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . $conect->connect_error);
}


$allEventos = "SELECT * FROM eventos_culturales";
$res = $conect->query($allEventos);

if ($res !== false) {
    while ($row = $res->fetch_assoc()) {
        $events[] = $row;
    }

    header('Content-Type: application/json');
    $JSONdata = json_encode($events);
    
    echo $JSONdata;
} else {
    http_response_code(500);
    echo json_encode(['error => Error al obtener eventos']);
}

exit;
