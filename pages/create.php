<?php

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$server_name = 'localhost';
$username = 'lde_harop';
$password = 'QlX0OGOz';
$db = 'lde_harop';


$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}

$conect->set_charset("utf8mb4");

$camposIncorrectos = false;


$query = "SELECT * FROM eventos_culturales";
$res = $conect->query($query);
while ($row = $res->fetch_assoc()) {
    $table[] = $row;
}

$newTable = $table[0];

function buildForm($newTable)
{
    echo "<div>";
    echo "<form method='POST'>";
    echo "<h2>Create Event</h2>";
    foreach ($newTable as $index => $element) {
        if ($index != 'id') {
            if ($index === 'imagen') {
                echo "<div class='div_control_input'>";
                echo "<label for='$index'>$index:</label>";
                echo "<input type='file' class='' name='$index' id='$index' />";
                echo "</div>";
            } else if ($index === 'fecha') {
                $date = date('Y-m-d', strtotime($element));
                echo "<div class='div_control_input'>";
                echo "<label for='$index'>$index:</label>";
                echo "<input type='date' class='' name='$index' id='$index' />";
                echo "</div>";
            } else if ($index === 'hora') {
                echo "<div class='div_control_input'>";
                echo "<label for='$index'>$index:</label>";
                echo "<input type='time' class='' name='$index' id='$index' />";
                echo "</div>";
            } else {
                echo "<div class='div_control_input'>";
                echo "<label for='$index'>$index:</label>";
                echo "<input type='text' class='' name='$index' id='$index' />";
                echo "</div>";
            }
        }
    }
    echo  "<div class='div_control_button'>
            <input type='submit' value='Update' name='create_event' class='button' />
        </div>";
    echo "</form>";
    echo "</div>";
}


if (isset($_POST['create_event'])) {
    if (!empty($_POST['nombre_del_evento']) && !empty($_POST['descripcion']) && !empty($_POST['ubicacion']) && !empty($_POST['imagen']) && !empty($_POST['categoria']) && !empty($_POST['fecha']) && !empty($_POST['hora'])) {
        $nombre_del_evento = $_POST['nombre_del_evento'];
        $descripcion = $_POST['descripcion'];
        $ubicacion = $_POST['ubicacion'];
        $imagen = $_POST['imagen'];
        $categoria = $_POST['categoria'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $horaFm = date('H:i', strtotime($hora));


        $query = "INSERT INTO eventos_culturales (nombre_del_evento, descripcion, ubicacion, imagen, categoria, fecha, hora) VALUES ('$nombre_del_evento', '$descripcion', '$ubicacion', '$imagen', '$categoria', '$fecha', '$horaFm')";
        echo $query;
        $res = $conect->query($query);
        echo $res;
        if ($res === true) {
            header('Location: index.php');
        }
    } else {
        $camposIncorrectos = true;
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
    <?php if (isset($user)) : ?>
        <h1>Hola <?php echo $user ?></h1>
    <?php endif; ?>
    <div style="display: flex; justify-content:center;">
        <?php if ($camposIncorrectos) : ?>
            <div class="error_div">
                <h2 class="h2_error" style="color: red;">Faltan campos por rellenar</h2>
            </div>
        <?php endif; ?>
        <?php buildForm($newTable) ?>
    </div>
    </div>
</body>

</html>