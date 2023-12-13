<?php

$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';


$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}


if (isset($_POST['update_event'])) {
    if (!empty($_POST['nombre_del_evento']) && !empty($_POST['descripcion']) && !empty($_POST['ubicacion']) && !empty($_POST['imagen']) && !empty($_POST['categoría']) && !empty($_POST['fecha']) && !empty($_POST['hora'])) {
        $nombre_del_evento = $_POST['nombre_del_evento'];
        $descripcion = $_POST['descripcion'];
        $ubicacion = $_POST['ubicacion'];
        $imagen = $_POST['imagen'];
        $categoría = $_POST['categoría'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
    } else {
        echo "todos los campos son obligatorios";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Eventos</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <div class="div_form">
        <form method="POST">
            <h2>Create Event</h2>
            <div class="div_control_input">
                <label for="nombre_del_evento">Nombre del Evento:</label>
                <input type="text" class="" name="nombre_del_evento" id="nombre_del_evento" />
            </div>

            <div class="div_control_input">
                <label for="descripcion">Descripcion:</label>
                <input type="text" class="" name="descripcion" id="descripcion" />
            </div>
            <div class="div_control_input">
                <label for="ubicacion">Ubicacion:</label>
                <input type="text" class="" name="ubicacion" id="ubicacion" />
            </div>
            <div class="div_control_input">
                <label for="imagen">Imagen:</label>
                <input type="file" class="" name="imagen" id="imagen" />
            </div>

            <div class="div_control_input">
                <label for="categoría">Categoria:</label>
                <input type="text" class="" name="categoría" id="categoría" />
            </div>

            <div class="div_control_input">
                <label for="text">Fecha:</label>
                <input type="date" class="" name="fecha" id="fecha" />
            </div>

            <div class="div_control_input">
                <label for="hora">Hora:</label>
                <input type="time" class="" name="hora" id="hora" />
            </div>

            <div class="div_control_button">
                <input type="submit" value="Login" name="update_event" class="button" />
            </div>
        </form>
    </div>
</body>

</html>