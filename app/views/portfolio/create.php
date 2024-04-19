<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
    <title>Document</title>
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
                                                    <h2 class="h4 text-center text-secondary">Crear portfolio</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <!----------------------------------------------------------------------------- Form action ---------------------------------------------------------------------->
                                        <form action="../../controllers/PortfolioController.php" method="post"
                                            enctype="multipart/form-data">
                                            <div class="row gy-2 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_titulo"
                                                            id="por_titulo" placeholder="titulo" required>
                                                        <label for="por_titulo" class="form-label">título</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_nombre"
                                                            id="por_nombre" placeholder="Nombre" required>
                                                        <label for="por_nombre" class="form-label">Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_apellidos"
                                                            id="por_apellidos" placeholder="Apellidos" required>
                                                        <label for="por_apellido" class="form-label">Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_especialidad"
                                                            id="por_especialidad" placeholder="Especialidad" required>
                                                        <label for="por_especialidad"
                                                            class="form-label">Especialidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_telefono"
                                                            id="por_telefono" placeholder="Telefono" required>
                                                        <label for="por_telefono" class="form-label">telefono</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="por_email"
                                                            id="por_email" placeholder="email@gmail.com" required>
                                                        <label for="email" class="form-label">email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_github"
                                                            id="por_github" placeholder="Github">
                                                        <label for="por_github" class="form-label">Github</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_linkedin"
                                                            id="por_linkedin" placeholder="Linkedin">
                                                        <label for="por_linkedin" class="form-label">Linkdin</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_tik_tok"
                                                            id="por_tik_tok" placeholder="Tiktok">
                                                        <label for="por_tiktok" class="form-label">Tik tok</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_instagram"
                                                            id="por_instagram" placeholder="Instagram">
                                                        <label for="por_instagram" class="form-label">Instagram</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="por_twitter"
                                                            id="por_twitter" placeholder="Twitter">
                                                        <label for="por_twitter" class="form-label">Twitter</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" class="form-control" name="por_cv"
                                                            id="por_cv" accept=".pdf" placeholder="cv" required>
                                                        <label for="por_cv" class="form-label">Curriculum</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 input-group-btn form-floating mb-3" id="skillset">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="por-skills[]"
                                                            placeholder="skills" required>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary" type="button"
                                                                onclick="agregarSkills()">
                                                                +<span class="fa fa-eye-slash icon"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 input-group-btn form-floating mb-3 projectset"
                                                    id="projectSet">
                                                    <div class="DivEliminarProyecto">
                                                        <fieldset class="border p-2 mr-auto ml-2">
                                                            <legend class="fs-5">Proyecto</legend>
                                                            <div class="input-group claseskill">
                                                                <input type="text" class="form-control"
                                                                    name="pro-titulo[]" placeholder="titulo" required>
                                                            </div>
                                                            <div class="input-group claseskill">
                                                                <input type="text" class="form-control"
                                                                    name="pro-descripcion[]" placeholder="descripcion"
                                                                    required>
                                                            </div>
                                                            <div class="input-group claseskill">
                                                                <input type="text" class="form-control"
                                                                    name="pro-enlace[]" placeholder="enlace" required>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button
                                                                    class="btn btn-primary float-end botonCrearProyecto"
                                                                    type="button" onclick="agregarProyecto()">
                                                                    +<span class="fa fa-eye-slash icon"></span>
                                                                </button>
                                                            </span>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                                                    <textarea class="form-control" id="por_sobre_mi" name="por_sobre_mi"
                                                        rows="10">Sobre mi</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-dark btn-lg" type="submit" name="boton"
                                                        value="create">Crear portfolio</button> <br>
                                                    <a href="./index.php" class="btn btn-dark btn-lg">Volver a mis
                                                        portfolios</a>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
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