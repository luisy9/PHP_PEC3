<?php
// include 'navbar/navbar.php';

$server_name = 'localhost';
$username = 'lde_harop';
$password = 'QlX0OGOz';
$db = 'lde_harop';


$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}

$conect->set_charset("utf8mb4");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_query = "SELECT * FROM eventos_culturales WHERE id='$id'";
    $result = $conect->query($sql_query);

    while ($row = $result->fetch_assoc()) {
        $table[] = $row;
    }

   
    function tableEvents($table)
    {
        $newOr = newOrderArray($table);
        $thead = $newOr[0];

        echo "<table border='1'>";
        echo "<thead>";
        foreach ($thead as $index => $element) {
            if ($index != 'id') {
                echo "<td>$index </td>";
            }
        }
        echo "</thead>";
        echo "<tbody>";

        foreach ($newOr as $e) {
            echo "<tr>";
            foreach ($e as $index => $element) {
                if ($index === 'id') {
                    $id = $element;
                }

                if ($index != 'id') {
                    echo "<td>";
                    if ($index === 'fecha') {
                        $newDate = date("d/m/Y", strtotime($element));

                        echo $newDate;
                    } elseif ($index === 'nombre_del_evento') {
                        echo $element;
                        echo "</td>";
                    } else {
                        echo $element;
                        echo "</td>";
                    }
                }
            }
            echo "</tr>";
        }
        echo "<tbody>";
        echo "</table>";
    }
} else {
    echo 'no hay ninguna id';
}

function newOrderArray($table)
{
    $newArray = [];
    foreach ($table as $e) {
        $newArray[] = array(
            'id' => $e['id'],
            'nombre_del_evento' => $e['nombre_del_evento'],
            'fecha' => $e['fecha'],
            'ubicacion' => $e['ubicacion'],
            'categoría' => $e['categoria'],
            'descripcion' => $e['descripcion'],
            'imagen' => $e['imagen'],
        );
    }

    return $newArray;
}
tableEvents($table);