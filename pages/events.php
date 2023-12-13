<?php

// session_start();

$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}


$sql_select = "SELECT * FROM eventos_culturales";
$res = $conect->query($sql_select);

if ($res !== false) {

    while ($row = $res->fetch_assoc()) {
        $table[] = $row;
    }
}
// Función para crear un nuevo array con un orden específico
function newOrderArray($table)
{
    $newArray = array();
    foreach ($table as $e) {
        $newArray[] = array(
            'id' => $e['id'],
            'nombre_del_evento' => $e['nombre_del_evento'],
            'fecha' => $e['fecha'],
            'ubicacion' => $e['ubicacion'],
            'categoría' => $e['categoría'],
            'descripcion' => $e['descripcion'],
            'imagen' => $e['imagen'],
        );
    }

    return $newArray;
}

function buildTable($table)
{

    $newTable = newOrderArray($table);
    $paginaNum = isset($_SESSION['counter']) ? $_SESSION['counter'] : 1;

    echo "<table border=1>";
    echo "<thead>";
    foreach ($newTable[0] as $index => $element) {
        if ($index != 'id') {
            echo "<th>$index</th>";
        }
    }
    echo "</thead>";
    echo "<tbody>";
    foreach ($newTable as $row) {
        echo "<tr>";
        foreach ($row as $index => $element) {
            if ($index === 'id') {
                $id = $element;
            }

            if ($index != 'id') {
                if (basename($_SERVER['PHP_SELF']) == '/index.php') {
                    echo $element;
                } else {
                    if ($index === 'nombre_del_evento') {
                        echo "<td>";
                        if (isset($_SESSION['user'])) {
                            $user = $_SESSION['user'];
                            echo "<a href='index.php?page=editEvent.php&id=$id'>{$element}</a>";
                        } else {
                            echo $element;
                        }
                        echo "</td>";
                    } else if ($index === 'fecha') {
                        echo "<td>";
                        echo  date('d/m/Y', strtotime($element));
                        echo "</td>";
                    } else if ($index === 'imagen') {
                        echo "<td>";
                        echo "<img src='img/$element' alt='Imagen de la bd' style=width:200px>";
                        echo "</td>";
                    } else {
                        echo "<td>$element</td>";
                    }
                }
            }
        }
        // echo "<td><a href='index.php?page=editEvent.php&id=$id'>Editar</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// include 'navbar/navbar.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" />
    <title>eventos</title>
</head>

<body>
    <?php if (isset($user)) : ?>
        <h1>Hola <?php echo $user ?></h1>
    <?php endif; ?>
    <?php buildTable($table); ?>
</body>

</html>