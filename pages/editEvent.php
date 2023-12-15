<?php
include 'includes/navbar.php';
// session_start();
if (isset($_SESSION['user'])) {
    if (isset($_GET['id'])) {
        $user = $_SESSION['user'];
        $id = $_GET['id'];


        $server_name = 'localhost';
        $username = 'lde_harop';
        $password = 'QlX0OGOz';
        $db = 'lde_harop';

        $conect = new mysqli($server_name, $username, $password, $db);

        if ($conect->connect_error) {
            die('Conexion fallida' . mysqli_connect_error());
        }

        $conect->set_charset("utf8mb4");

        $query = "SELECT * FROM eventos_culturales WHERE id=$id";

        $res = $conect->query($query);
        while ($row = $res->fetch_assoc()) {
            $table[] = $row;
        }

        if (isset($_POST['update_event'])) {
            $id = $_POST['id'];
            $nombre_del_evento = $_POST['nombre_del_evento'];
            $descripcion = $_POST['descripcion'];
            $ubicacion = $_POST['ubicacion'];
            $imagen = $_POST['imagen'];
            $categoria = $_POST['categoria'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];

            $update = "UPDATE eventos_culturales SET nombre_del_evento='$nombre_del_evento', descripcion='$descripcion', ubicacion='$ubicacion', imagen='$imagen', categoria='$categoria', fecha='$fecha', hora='$hora' WHERE id='$id'";
            $res = $conect->query($update);
            // Redirige después de la actualización
            header("Location: index.php");
            exit;
        }


        function buildForm($table)
        {
            echo "<div>";
            echo "<form method='POST'>";
            echo "<h2>Update Event</h2>";
            foreach ($table as $row) {
                foreach ($row as $index => $element) {
                    echo "<input type='hidden' name='$index' id='$index' value='$element' />";
                    if ($index != 'id') {
                        if ($index === 'imagen') {
                            echo "<div class='div_control_input'>";
                            echo "<label for='$index'>$index:</label>";
                            echo "<input type='file' class='' name='$index' id='$index' value='$element' />";
                            echo "</div>";
                        } else if ($index === 'fecha') {
                            $date = date('Y-m-d', strtotime($element));
                            echo "<div class='div_control_input'>";
                            echo "<label for='$index'>$index:</label>";
                            echo "<input type='date' class='' name='$index' id='$index' value='$date' />";
                            echo "</div>";
                        } else if ($index != 'hora') {
                            echo "<div class='div_control_input'>";
                            echo "<label for='$index'>$index:</label>";
                            echo "<input type='text' class='' name='$index' id='$index' value='$element' />";
                            echo "</div>";
                        }
                    }
                }
            }
            echo  "<div class='div_control_button'>
            <input type='submit' value='Update' name='update_event' class='button' />
        </div>";
            echo "</form>";
            echo "</div>";
        }
    }
} else {
    echo "no estas loget";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="index.css" rel="stylesheet" />
</head>

<body>
    <?php if (isset($user)) : ?>
        <h1>Hola <?php echo $user ?></h1>
    <?php endif; ?>
    <div style="display: flex; justify-content:center;">
        <?php buildForm($table) ?>
    </div>
</body>

</html>