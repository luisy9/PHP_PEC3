<?php
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