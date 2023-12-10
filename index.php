<?php

$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . mysqli_connect_error());
}

$sql = "SELECT * FROM eventos_culturales ORDER BY RAND() LIMIT 5";
$res = $conect->query($sql);

if ($res !== false) {
    while ($row = $res->fetch_assoc()) {
        $table[] = $row;
    }
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
    echo "<table border=1>";
    echo "<thead>";
    foreach ($newTable[0] as $index => $element) {
        if ($index != 'id') {
            if ($index === 'fecha') {
                echo "<th>$index <a href='?action=ascendente' class='btn'>Ascendete</a></th>";
            } else {
                echo "<th>$index</th>";
            }
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
                if ($index === 'nombre_del_evento') {
                    echo "<td>";
                    echo "<a href='post.php?id=$id'>$element</a>";
                    echo "</td>";
                } else if ($index === 'fecha') {
                    echo "<td>";
                    echo  date('d/m/Y', strtotime($element));
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "$element";
                    echo "</td>";
                }
            }
        }
        echo "</tr>";
    }
    echo "</tbody>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Redirigir para evitar la reenvío del formulari
    if (isset($_POST['submit'])) {
        $sql = "SELECT * FROM eventos_culturales ORDER BY RAND() LIMIT 5";
        $res = $conect->query($sql);

        if ($res !== false) {
            while ($row = $res->fetch_assoc()) {
                $table[] = $row;
            }

            // echo 'hola';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'ascendente') {
    $isAcendente = true;
    $newTable = newOrderArray($table);
    usort($newTable, 'comparar');
}

function comparar($a, $b)
{
    $fechaA = new DateTime($a['fecha']);
    $fechaB = new DateTime($b['fecha']);


    return $fechaA <=> $fechaB;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php buildTable($table); ?>

    <form method="POST" action="index.php">
        <button type="submit" name="submit">Next</button>
    </form>
</body>

</html>


<!--Codigo a probar !-->
<?php
// session_start();

// $server_name = 'localhost';
// $username = 'root';
// $password = '';
// $db = 'luis_db';

// $conect = new mysqli($server_name, $username, $password, $db);

// if ($conect->connect_error) {
//     die('Conexion fallida' . mysqli_connect_error());
// }

// Función para ordenar el array por fecha
// function comparar($a, $b)
// {
//     $fechaA = new DateTime($a['fecha']);
//     $fechaB = new DateTime($b['fecha']);
//     return $fechaA <=> $fechaB;
// }

// Función para crear un nuevo array con un orden específico
// function newOrderArray($table)
// {
//     $newArray = [];
//     foreach ($table as $e) {
//         $newArray[] = array(
//             'id' => $e['id'],
//             'nombre_del_evento' => $e['nombre_del_evento'],
//             'fecha' => $e['fecha'],
//             'ubicacion' => $e['ubicacion'],
//             'categoría' => $e['categoría'],
//             'descripcion' => $e['descripcion'],
//             'imagen' => $e['imagen'],
//         );
//     }

//     return $newArray;
// }

// Lógica para obtener los eventos culturales al cargar la página
// if (!isset($_SESSION['table'])) {
//     $sql = "SELECT * FROM eventos_culturales ORDER BY RAND() LIMIT 5";
//     $res = $conect->query($sql);

//     if ($res !== false) {
//         while ($row = $res->fetch_assoc()) {
//             $table[] = $row;
//         }

        // Guardar la tabla en la sesión
        // $_SESSION['table'] = newOrderArray($table);
    // }
// } else {
    // Si ya existe una tabla en la sesión, usar esa
    // $table = $_SESSION['table'];

    // Verificar si se hace clic en el enlace de 'ascendente'
    // if (isset($_GET['action']) && $_GET['action'] === 'ascendente') {
        // Ordenar el array por fecha
        // usort($table, 'comparar');
    // }
// }
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body> -->
    <!-- <?php buildTable($table); ?> -->

    <!-- <form method="POST" action="index.php">
        <button type="submit" name="submit">Next</button>
    </form>
</body>

</html> -->
