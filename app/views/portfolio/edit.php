<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SESSION['CONTROLLERS_PATH'] . '/PortfolioController.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $_SESSION['id_portfolio_actual'] = $id;
    $controller = new PortfolioController();
    $proyectos = new ProjectController();
    $portfolio = $controller->show($id);
    $projects =  $proyectos->get_project_ctrl($id);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/assets/css/style.css">
    <script src="../../../public/assets/js/script.js" defer></script>
    <title>Editar Portfolio</title>
</head>

<body>
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                    src="../../../public/assets/img/mar.jpg" alt="No se encuentra!">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="#!">
                                                            <img class="img-fluid"
                                                                src="../../../public/assets/img/logo.png" alt="Logo"
                                                                width="330">
                                                        </a>
                                                    </div>
                                                    <h2 class="h4 text-center text-secondary">Editar portfolio</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Formulario -->
                                        <?php if (isset($portfolio) && $portfolio) : ?>
                                        <form action="../../controllers/PortfolioController.php" method="post"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="pk_portfolio"
                                                value="<?php echo $portfolio['pk_portfolio']; ?>">
                                            <!-- Resto de campos -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_titulo"
                                                    id="por_titulo" placeholder="Título"
                                                    value="<?php echo $portfolio['por_titulo']; ?>" required>
                                                <label for="por_titulo">Título</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_nombre"
                                                    id="por_nombre" placeholder="Nombre"
                                                    value="<?php echo $portfolio['por_nombre']; ?>" required>
                                                <label for="por_nombre">Nombre</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_apellidos"
                                                    id="por_apellidos" placeholder="Apellidos"
                                                    value="<?php echo $portfolio['por_apellidos']; ?>" required>
                                                <label for="por_apellidos" class="form-label">Apellido</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_especialidad"
                                                    id="por_especialidad" placeholder="Especialidad"
                                                    value="<?php echo $portfolio['por_especialidad']; ?>" required>
                                                <label for="por_especialidad" class="form-label">Especialidad</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_telefono"
                                                    id="por_telefono" placeholder="Telefono"
                                                    value="<?php echo $portfolio['por_telefono']; ?>" required>
                                                <label for="por_telefono" class="form-label">Teléfono</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" name="por_email" id="por_email"
                                                    placeholder="email@gmail.com"
                                                    value="<?php echo $portfolio['por_email']; ?>" required>
                                                <label for="por_email" class="form-label">Email</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_github"
                                                    id="por_github" placeholder="Github"
                                                    value="<?php echo $portfolio['por_github']; ?>">
                                                <label for="por_github" class="form-label">Github</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_linkedin"
                                                    id="por_linkedin" placeholder="Linkedin"
                                                    value="<?php echo $portfolio['por_linkedin']; ?>">
                                                <label for="por_linkedin" class="form-label">LinkedIn</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_tik_tok"
                                                    id="por_tik_tok" placeholder="Tiktok"
                                                    value="<?php echo $portfolio['por_tik_tok']; ?>">
                                                <label for="por_tik_tok" class="form-label">TikTok</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_instagram"
                                                    id="por_instagram" placeholder="Instagram"
                                                    value="<?php echo $portfolio['por_instagram']; ?>">
                                                <label for="por_instagram" class="form-label">Instagram</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="por_twitter"
                                                    id="por_twitter" placeholder="Twitter"
                                                    value="<?php echo $portfolio['por_twitter']; ?>">
                                                <label for="por_twitter" class="form-label">Twitter</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="file" class="form-control" name="por_cv" accept=".pdf"
                                                    id="por_cv" placeholder="Curriculum"
                                                    value="<?php echo $portfolio['por_cv']; ?>" required>
                                                <label for="por_cv" class="form-label">Curriculum</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <textarea type="text" class="form-control" name="por_sobre_mi"
                                                    id="por_sobre_mi" placeholder="Sobre mi"
                                                    value="<?= $portfolio['por_sobre_mi']; ?>"><?= $portfolio['por_sobre_mi']; ?></textarea>
                                                <label for="por_sobre_mi" class="form-label">Sobre mi</label>
                                            </div>

                                            <!---------------------------------------------------------------- Skills  ------------------------------------------------------------------------->
                                            <?php
                                                $arraySkills = explode(',', $portfolio['por_skills']);
                                                for ($i = 0; $i < sizeof($arraySkills); $i++) {
                                                    if ($i == 0) {

                                                        echo '<div class="col-12 input-group-btn form-floating mb-3" id="skillset">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" name="por-skills[]" value="' . $arraySkills[$i] . '" placeholder="skills" required>
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-primary" type="button" onclick="agregarSkills()">
                                                                                    +<span class="fa fa-eye-slash icon"></span>
                                                                                </button>
                                                                            </span>
                                                                    </div>';
                                                    } else {

                                                        echo '<div class="input-group">
                                                                    <input type="text" class="form-control claseskill" name="por-skills[]" value="' . $arraySkills[$i] . '" placeholder="skills" required>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-primary claseskill" type="button" onclick="agregarSkills()">
                                                                                +<span class="fa fa-eye-slash icon"></span>
                                                                            </button>
                                                                            <button class="btn btn-danger claseskill botonEliminarSkill" type="button">
                                                                                -<span class="fa fa-eye-slash icon"></span>
                                                                            </button>
                                                                    </span>
                                                            </div>';
                                                    }
                                                }
                                                echo "</div>";
                                                ?>
                                            <!---------------------------------------------------------------- Proyectos  ----------------------------------------------------------------------->
                                            <?php for ($i = 0; $i < sizeof($projects); $i++) {
                                                    if ($i == 0) {
                                                        echo '<div class="col-12 input-group-btn form-floating mb-3 projectset" id="projectSet">
                                                                <div class="DivEliminarProyecto">
                                                                      <fieldset class="border p-2 mr-auto ml-2">
                                                                      <legend class="fs-5">Proyecto</legend>
                                                                <div class="input-group claseskill">
                                                                        <input type="text" class="form-control"
                                                                        name="pro-titulo[]" value="' . $projects[$i]['pro_titulo'] . '"placeholder="titulo" required>
                                                             </div>

                                                                <div class="input-group claseskill">
                                                                        <input type="text" class="form-control"
                                                                            name="pro-descripcion[]" value="' . $projects[$i]['pro_descripcion'] . '"placeholder="descripcion"
                                                                            required>
                                                                </div>

                                                                <div class="input-group claseskill">
                                                                        <input type="text" class="form-control"
                                                                            name="pro-enlace[]" value="' . $projects[$i]['pro_enlace'] . '"placeholder="enlace" required>
                                                                </div>

                                                                          <span class="input-group-btn">
                                                                              <button
                                                                                 class="btn btn-primary float-end botonCrearProyecto"
                                                                                 type="button" onclick="agregarProyecto()">
                                                                                 +<span class="fa fa-eye-slash icon"></span>
                                                                               </button>
                                                                           </span>
                                                                     </fieldset>
                                                                 </div>';
                                                    } else {
                                                        echo '<div class="DivEliminarProyecto"><fieldset class="border p-2 mr-auto ml-2"><legend class="fs-5">Proyecto</legend>
                                                                        <div class="input-group claseskill">
                                                                        <input type="text" class="form-control"
                                                                        name="pro-titulo[]" value="' . $projects[$i]['pro_titulo'] . '"placeholder="titulo" required>
                                                                        </div>
                                                                        <div class="input-group claseskill">
                                                                        <input type="text" class="form-control"
                                                                        name="pro-descripcion[]" value="' . $projects[$i]['pro_descripcion'] . '"placeholder="descripcion"
                                                                        required>
                                                                        </div>
                                                                        <div class="input-group claseskill">
                                                                        <input type="text" class="form-control"
                                                                        name="pro-enlace[]" value="' . $projects[$i]['pro_enlace'] . '"placeholder="enlace" required>
                                                                        </div>
                                                                        <span class="input-group-btn">
                                                                        <button class="btn btn-primary float-end botonCrearProyecto" type="button" onclick="agregarProyecto()">
                                                                            +<span class="fa fa-eye-slash icon"></span>
                                                                        </button> 
                                                                        <button class="btn btn-danger float-end botonEliminarProyecto" type="button">
                                                                            -<span class="fa fa-eye-slash icon"></span>
                                                                        </button>  
                                                                        </span>
                                                                     </fieldset>
                                                                </div>';
                                                    }
                                                }
                                                echo "</div>";
                                                ?>

                                            <!---------------------------------------------------------------------------------------------------------------------------------------------------------->
                                            <div class="d-grid mt-2">
                                                <button class="btn btn-dark btn-lg" type="submit" name="boton"
                                                    value="edit">Actualizar
                                                    portfolio</button>
                                            </div>
                                        </form>
                                        <?php else : ?>
                                        <p>Portfolio no encontrado.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>