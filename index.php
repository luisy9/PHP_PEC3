<body>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    if ($page === 'post.php' || $page === 'editEvent.php') {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!is_numeric($id) || $id <= 0) {
            // ID no válido, manejar el error apropiadamente
            echo "ID no válido";
            exit;
        }

        // Incluye post.php y pasa el ID
        include "pages/{$page}";
    } else {
        $path = "pages/{$page}.php";
        $isApiEventsPage = strpos($path, 'api/events/index.php') !== false;

        if (!$isApiEventsPage) {
            include 'includes/navbar.php';
        }

        if (file_exists($path)) {
            include $path;
        } else {
            echo "Página no encontrada.";
        }
    }
    ?>
</body>