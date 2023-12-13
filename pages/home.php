<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// include 'navbar/navbar.php';

$server_name = 'localhost';
$username = 'root';
$password = '';
$db = 'luis_db';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

// $server_name = 'eimtcms2.uoclabs.uoc.es/bbdd/';
// $username = 'lde_harop';
// $password = 'QlX0OGOz';
// $db = 'lde_harop';
// $port = 3306;

$conect = new mysqli($server_name, $username, $password, $db);

if ($conect->connect_error) {
    die('Conexion fallida' . $conect->connect_error);
}

$cambio = false;

// Función para ordenar el array por fecha ascendete
function compararAsceFecha($a, $b)
{
    foreach ($a as $index => $element) {
        if ($index === 'fecha') {
            $fechaA = date('d/m/Y', strtotime($element));
        }
    }

    foreach ($b as $index => $element) {
        if ($index === 'fecha') {
            $fechaB = date('d/m/Y', strtotime($element));
        }
    }

    if ($fechaA == $fechaB) {
        return 0;
    }

    return ($fechaA > $fechaB) ? -1 : 1;
}

//Fucncion para ordenar la fecha de manera descendete
function compararDesceFecha($a, $b)
{
    foreach ($a as $index => $element) {
        if ($index === 'fecha') {
            $fechaA = date('d/m/Y', strtotime($element));
        }
    }

    foreach ($b as $index => $element) {
        if ($index === 'fecha') {
            $fechaB = date('d/m/Y', strtotime($element));
        }
    }

    if ($fechaA == $fechaB) {
        return 0;
    }

    return ($fechaA < $fechaB) ? -1 : 1;
}

function ascendenteNombre($a, $b)
{
    foreach ($a as $index => $element) {
        if ($index === 'nombre_del_evento') {
            $palabra1 = $element;
        }
    }

    foreach ($b as $index => $element) {
        if ($index === 'nombre_del_evento') {
            $palabra2 = $element;
        }
    }

    if ($palabra1 === $palabra2) {
        return 0;
    }

    return ($palabra1 > $palabra2) ? -1 : 1;
}

function descendenteNombre($a, $b)
{
    foreach ($a as $index => $element) {
        if ($index === 'nombre_del_evento') {
            $palabra1 = $element;
        }
    }

    foreach ($b as $index => $element) {
        if ($index === 'nombre_del_evento') {
            $palabra2 = $element;
        }
    }

    if ($palabra1 === $palabra2) {
        return 0;
    }

    return ($palabra1 < $palabra2) ? -1 : 1;
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

function buildTable($table, $isHomePage = false)
{

    $newTable = newOrderArray($table);
    $paginaNum = isset($_SESSION['counter']) ? $_SESSION['counter'] : 1;

    echo "<table border=1>";
    echo "<thead>";
    foreach ($newTable[0] as $index => $element) {
        if ($index != 'id') {
            if ($index === 'fecha') {
                $ascendenteLink = "?action=ascendente";
                $descendenteLink = "?action=descendente";
                if (isset($_GET['action']) && $_GET['action'] === 'ascendente') {
                    echo "<th>$index <a href='$descendenteLink' class='btn'>Descendete</a></th>";
                } else if (isset($_GET['action']) && $_GET['action'] === 'descendete') {
                    echo "<th>$index <a href='$ascendenteLink' class='btn'>ascendente</a></th>";
                } else {
                    echo "<th>$index <a href='$ascendenteLink' class='btn'>Ascendete</a></th>";
                }
            } else if ($index === 'nombre_del_evento') {
                $ascendenteLink = "?action=ascendenteNombre";
                $descendenteLink = "?action=descendenteNombre";
                if (isset($_GET['action']) && $_GET['action'] === 'ascendenteNombre') {
                    echo "<th>$index <a href='$descendenteLink' class='btn'>Descendete</a></th>";
                } else if (isset($_GET['action']) && $_GET['action'] === 'descendenteNombre') {
                    echo "<th>$index <a href='$ascendenteLink' class='btn'>ascendente</a></th>";
                } else {
                    echo "<th>$index <a href='$ascendenteLink' class='btn'>Ascendete</a></th>";
                }
            } else {
                echo "<th>$index</th>";
            }
        }
    }
    echo "</thead>";
    echo "<h2>Pagina $paginaNum:<a href='?action=pasarPagina'>Siguiente</a></h2>";
    echo "<tbody>";
    foreach ($newTable as $row) {
        echo "<tr>";
        foreach ($row as $index => $element) {
            if ($index === 'id') {
                $id = $element;
            }

            if ($index != 'id') {
                if ($_SERVER['PHP_SELF'] == '/index.php') {
                    echo $element;
                } else {
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
        }
        echo "</tr>";
    }
    // echo "<button>Next</button>";
    echo "</tbody>";
    echo "</table>";
}

// Lógica para obtener los eventos culturales al cargar la página
if (!isset($_SESSION['table'])) {
    $sql = "SELECT * FROM eventos_culturales ORDER BY RAND() LIMIT 5";
    $res = $conect->query($sql);

    if ($res !== false) {
        while ($row = $res->fetch_assoc()) {
            $table[] = $row;
        }

        // Guardar la tabla en la sesión
        $_SESSION['table'] = newOrderArray($table, 1);
    }
} else {
    // Si ya existe una tabla en la sesión, usar esa
    $table = $_SESSION['table'];

    if (isset($_GET['action']) && $_GET['action'] === 'pasarPagina') {

        //Se resetea el valor de la session con un array vacio
        $_SESSION['table'] = array();

        $sql = "SELECT * FROM eventos_culturales ORDER BY RAND() LIMIT 5";
        $res = $conect->query($sql);

        if ($res !== false) {

            //Si $_SESSION es nulo o no esta definido entonces sera un array vacio, pero si contiene algo entonces sera lo del contenido
            $table = isset($_SESSION['table']) ? $_SESSION['table'] : array();
            while ($row = $res->fetch_assoc()) {
                $table[] = $row;
            }


            if (!isset($_SESSION['counter'])) {
                $_SESSION['counter'] = 1;
            } else {
                $_SESSION['counter']++;
            }

            // Guardar la tabla en la sesión
            $_SESSION['table'] = newOrderArray($table);
        }
    }

    // Verificar si se hace clic en el enlace de 'ascendente'
    if (isset($_GET['action']) && $_GET['action'] === 'descendente') {
        // Ordenar el de forma descendente array por fecha
        usort($table, 'compararDesceFecha');
    } else if (isset($_GET['action']) && $_GET['action'] === 'ascendente') {
        // Ordenar el array de forma ascendente las fechas
        usort($table, 'compararAsceFecha');
    } else {
        if (isset($_GET['action']) && $_GET['action'] === 'descendenteNombre') {
            // Ordenar el de forma descendente array por fecha
            usort($table, 'descendenteNombre');
        } else if (isset($_GET['action']) && $_GET['action'] === 'ascendenteNombre') {
            // Ordenar el de forma descendente array por fecha
            usort($table, 'ascendenteNombre');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <?php if (isset($user)) : ?>
        <h1>Hola <?php echo $user ?></h1>
    <?php endif; ?>
    <?php buildTable($table, true); ?>
</body>

</html>