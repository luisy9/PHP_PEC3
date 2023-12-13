<?php
session_start();
if (isset($_SESSION['user'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        $server_name = 'localhost';
        $username = 'root';
        $password = '';
        $db = 'luis_db';

        $conect = new mysqli($server_name, $username, $password, $db);

        if ($conect->connect_error) {
            die('Conexion fallida' . $conect->connect_error);
        }

        $query = "SELECT * FROM eventos_culturales WHERE id=$id";

        $res = $conect->query($query);
        while ($row = $res->fetch_assoc()) {
            $table[] = $row;
        }

        if (isset($_POST['update_event'])) {
            echo 'ejecutadooo';
            $id = $_POST['id'];
            $nombre_del_evento = $_POST['nombre_del_evento'];
            $descripcion = $_POST['descripcion'];
            $ubicacion = $_POST['ubicacion'];
            $imagen = $_POST['imagen'];
            $categoría = $_POST['categoría'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];

            echo $id;
            echo $nombre_del_evento;
            echo $descripcion;
            echo $ubicacion;
            echo $imagen;
            echo $categoría;
            echo $fecha;
            echo $hora;

            $update = "UPDATE eventos_culturales SET nombre_del_evento='$nombre_del_evento', descripcion='$descripcion', ubicacion='$ubicacion', imagen='$imagen', categoría='$categoría', fecha='$fecha', hora='$hora' WHERE id='$id'";
            $res = $conect->query($update);

            if (!$res) {
                die('Error en la actualización: ' . $conect->error);
            }

            // Redirige después de la actualización
            header("Location: index.php?page=events");
            exit();
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
                        } else if($index != 'hora') {
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

        buildForm($table);
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

<body style="display: flex; justify-content:center;">

</body>

</html>