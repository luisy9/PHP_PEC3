<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>

    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = "pages/{$page}.php";

    if (file_exists($path)) {
        include $path;
    } else {
        echo "Página no encontrada.";
    }
    ?>
</body>