<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <title>Document</title>
</head>

</html>

<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!--Link Fontawesome para los iconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>
</head>
<?php
require_once $_SESSION['CONTROLLERS_PATH'] . '/PortfolioController.php';

// Crear una instancia de PortfolioController
$controller = new PortfolioController();

// Lista de portfolios creados
$portfolios = $controller->index();

echo '<div class="container mt-5">';
    echo '<a href="create.php" class="btn btn-primary mb-3">Crear Portfolio</a>';
    echo '<table class="table">';
        echo '<thead>';
            echo '<tr>';
                echo '<th scope="col">Portfolios</th>';
                echo '<th scope="col">Título</th>';
                echo '<th scope="col">Autor</th>';
                echo '<th scope="col">Fecha</th>';
                echo '<th scope="col">Acciones</th>';
                echo '</tr>';
            echo '</thead>';
        echo '<tbody>';
            foreach ($portfolios as $portfolio) {
            $id = $portfolio['pk_portfolio']; // Asumimos que este es el nombre de la clave que contiene el ID.
            echo "<tr>";
                echo "<th scope='row'>" . $id . "</th>";
                echo "<td>" . $portfolio['por_titulo'] . "</td>";
                echo "<td>" . $portfolio['por_nombre'] . "</td>";
                echo "<td>" . $portfolio['por_fecha'] . "</td>";
                echo "<td>
                    <a href='show.php?id=" . $id . "' class='btn btn-success btn-sm'>Ver</a>
                    <a href='edit.php?id=" . $id . "' class='btn btn-warning btn-sm'>Editar</a>
                    <form action='../../controllers/PortfolioController.php' method='post' style='display: inline;'
                        onsubmit='return confirm(\"¿Estás seguro que deseas eliminar este portfolio?\");'>
                        <input type='hidden' name='id' value='" . $id . "' />
                        <button type='submit' name='boton' value='delete'
                            class='btn btn-danger btn-sm'>Eliminar</button>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo '</tbody>';
        echo '</table>';
    echo '</div>';