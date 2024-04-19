<?php
require_once('routes/route.php');
require_once $_SESSION['CONFIG_PATH'] . '/database.php';

$database = new Database();

?>



<!-- HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!--Link Fontawesome para los iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>
    <style>
    /*Imagen de fondo*/
    body {
        background-image: url('public/assets/img/azul.avif');
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /*Estilo botones*/
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    </style>
</head>

<body>
    <!--Contenedor principal-->
    <div class="bg-white p-5 rounded-5 text-dark-emphasis shadow" style="width: 35rem">
        <!--Logo y texto-->
        <div class="d-flex justify-content-center">
            <img src="public/assets/img/logo.png" alt="login" style="height: 7rem;">
        </div>
        <div class="text-center fs-1 fw-bold mt-5">Bienvenido</div>
        <div class="text-center fs-1 fw-bold mt-3">
            <h3>¿Qué quieres hacer?</h3>
        </div>
        <!--Botones-->
        <div class="d-flex justify-content-around pt-1">
            <div class="d-flex align-items-center gap-1">
                <a href="app/views/portfolio/create.php" class="btn btn-primary text-white w-100 mt-5">
                    <i class="fas fa-plus-circle"></i> Crear Portfolio</a>
            </div>
            <div>
                <a href="app/views/portfolio/index.php" class="btn btn-primary text-white w-100 mt-5">
                    <i class="fas fa-eye"></i> Ver Portfolio</a>
            </div>
        </div>
    </div>

    <!-- Scripts de Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>