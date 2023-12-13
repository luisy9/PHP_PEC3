<?php
session_start();

if (isset($_SESSION['user'])) {
    $nombre = $_SESSION['user'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Document</title>
</head>

<header>
    <div class="navbar">
        <div class="">
            <ul>
                <li><a href="index.php?page=home" class="link">Home</a></li>
                <li><a href="index.php?page=activity_2" class="link">Act_2</a></li>
                <li><a href="" class="link">Eventos</a></li>
                <li><a href="index.php?page=api/events" class="link">API</a></li>
                <?php if (isset($nombre)) : ?>
                    <li><a href="index.php?page=logount" class="link">Logout</a></li>
                <?php else : ?>
                    <li><a href="index.php?page=login" class="link">Login</a></li>
                <?php endif; ?>
                <li><a href="crearUser.php" class="link">Crear Evento</a></li>
            </ul>
        </div>
    </div>
</header>

</html>