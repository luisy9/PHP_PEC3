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

$newTable = newOrderArray($table);
$isAcendente = false;

if (isset($_GET['action']) && $_GET['action'] === 'ascendente') {
    $isAcendente = true;
    usort($table, 'comparar');
}

function comparar($a, $b)
{
    $fechaA = new DateTime($a['fecha']);
    $fechaB = new DateTime($b['fecha']);


    return $fechaA <=> $fechaB;
}

if (isset($_GET['action']) && $_GET['action'] === 'descendente') {
    $isAcendente = false;
    descendente();
}

function descendente()
{
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index.php</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
    <table border="1">
        <thead>
            <?php foreach ($newTable[0] as $index => $element) : ?>

                <?php if ($index != 'id') : ?>
                    <?php if ($index === 'fecha') : ?>
                        <th><?php echo $index ?>
                            <?php if (isset($_POST['button_order_date'])) : ?>
                            <?php endif; ?>
                            <?php if (!$isAcendente) : ?>
                                <a href="?action=ascendente" class="btn">Ascendete</a>
                            <?php elseif ($isAcendente) : ?>
                                <a href="?action=descendente" class="btn">Descendente</a>
                            <?php endif; ?>
                        </th>
                    <?php else : ?>
                        <th><?php echo $index ?></th>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach ?>
        </thead>
        <tbody>
            <?php foreach ($newTable as $row) : ?>
                <tr>
                    <?php foreach ($row as $index => $element) : ?>
                        <?php if ($index === 'id') : ?>
                            <?php $id = $element; ?>
                        <?php endif; ?>
                        <?php if ($index != 'id') : ?>
                            <?php if ($index === 'nombre_del_evento') : ?>
                                <td>
                                    <a href="post.php?id=<?php echo $id ?>"><?php echo $element ?></a>
                                </td>
                            <?php elseif ($index === 'fecha') : ?>
                                <td>
                                    <?= date('d/m/Y', strtotime($element)) ?>
                                </td>
                            <?php else : ?>
                                <td>
                                    <?php echo $element ?>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <form>
        <button type="submit" name="submit">Next</button>
    </form>
</body>

</html>