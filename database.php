<?php
$server_name = 'localhost';
$username = 'root';
$password = '';


$conect = new mysqli($server_name, $username, $password);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}
echo 'Conexión correcta!';

//db name
$db_name = 'luis_db';
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conect->select_db($db_name)) {
    echo 'Esta creada';

    //create table
    $sql = "CREATE TABLE Eventos_Culturales (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre_del_evento VARCHAR(30) NOT NULL,
        fecha TIMESTAMP(6) NOT NULL,
        hora_evento TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
        descripcion VARCHAR(99) NOT NULL,
        ubicacion VARCHAR(60) NOT NULL,
        imagen VARCHAR(30) NOT NULL,
        categoria VARCHAR(30) NOT NULL
        )";

    if ($conect->query($sql) === true) {
        echo 'Tabla creada!';
    } else {
        echo 'Error creando la tabla';
    }
    
} else {
    if ($conect->query($sql) === true) {
        echo "Base de datos creada con exito";
    } else {
        echo "No se ha podido crear la base de datos";
    }
}




$conect->close();
