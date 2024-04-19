<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SESSION['MODELS_PATH'] . '/PortfolioModel.php';
require_once $_SESSION['MODELS_PATH'] . '/ProjectModel.php';
require_once $_SESSION['CONTROLLERS_PATH'] . '/Controller.php';
require_once $_SESSION['DTO_PATH'] . '/PortfolioData.php';

class PortfolioController extends Controller
{
    private $portfolioModel;

    public function __construct()
    {
        parent::__construct();
        $this->portfolioModel = new PortfolioModel();
    }

    public function index()
    {
        $portfolios = $this->portfolioModel->get_all_portfolios();
        return $portfolios;
    }

    public function create(PortfolioData $data)
    {
        $file = $_FILES['por_cv'];
        return $this->portfolioModel->introducir_nuevo_portfolio($data,$file);
    }

    public function show($id)
    {
        $portfolio = $this->portfolioModel->get_portfolio($id);
        return $portfolio;
    }


    public function edit($id, PortfolioData $data)
    {
        $file = $_FILES['por_cv'];
        return $this->portfolioModel->edit_portfolio($id, $data,$file);
    }

    public function delete($id)
    {
        return $this->portfolioModel->delete_portfolio($id);
    }

    public function max_id()
    {
        $idMax = $this->portfolioModel->get_max_id_portfolios();
        return $idMax;
    }
}

class ProjectController extends Controller
{
    private $projectModel;

    public function __construct()
    {
        parent::__construct();
        $this->projectModel = new projectModel();
    }

    public function get_project_ctrl($fk_portfolio)
    {
        $projects = $this->projectModel->get_project_model($fk_portfolio);

        return $projects;
    }

    public function insert_project_ctrl($fk_portfolio, $pro_titulo, $pro_descripcion, $pro_enlace)
    {
        return $this->projectModel->insert_project_model($fk_portfolio, $pro_titulo, $pro_descripcion, $pro_enlace);
    }

    public function update_project_ctrl($fk_portfolio, $pro_titulo, $pro_descripcion, $pro_enlace)
    {
        return $this->projectModel->update_project_model($fk_portfolio, $pro_titulo, $pro_descripcion, $pro_enlace);
    }

    public function delette_project_ctrl($fk_portfolio)
    {
        return $this->projectModel->delette_project_model($fk_portfolio);
    }

    public function get_all_projects_ctrl()
    {

        return $this->projectModel->get_all_projects_model();
    }
}


$portfolioController = new PortfolioController();
$projectController = new ProjectController();

// switch portfolio

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton'])) {
        switch ($_POST['boton']) {
            /* Create */
            case 'create':
                if (
                    isset($_POST['por_titulo']) &&
                    isset($_POST['por_nombre']) &&
                    isset($_POST['por_apellidos']) &&
                    isset($_POST['por_especialidad']) &&
                    isset($_POST['por_telefono']) &&
                    isset($_POST['por_email']) &&
                    !empty($_POST['por_titulo']) &&
                    !empty($_POST['por_nombre']) &&
                    !empty($_POST['por_apellidos']) &&
                    !empty($_POST['por_especialidad']) &&
                    !empty($_POST['por_telefono']) &&
                    !empty($_POST['por_email'])&&
                    isset ($_FILES['por_cv']) &&
                    $_FILES['por_cv']['error'] == UPLOAD_ERR_OK
                ) {
                    $por_skills_array = $_POST['por-skills'];
                    $por_skills = implode(', ', $por_skills_array);

                    $portfolioData = new PortfolioData(
                        $_POST['por_titulo'],
                        $_POST['por_nombre'],
                        $_POST['por_apellidos'],
                        $_POST['por_especialidad'],
                        $_POST['por_telefono'],
                        $_POST['por_email'],
                        $_POST['por_github'] ?? '',
                        $_POST['por_linkedin'] ?? '',
                        $_POST['por_tik_tok'] ?? '',
                        $_POST['por_instagram'] ?? '',
                        $_POST['por_twitter'] ?? '',
                        $por_skills,
                        $_POST['por_sobre_mi'] ?? ''
                    );
                    $resultadoPortfolio = $portfolioController->create($portfolioData);



                    $id = $portfolioController->max_id();
                    $maxid = $id["0"];
                    $maxidint = intval($maxid['maxId']);

                    if (
                        isset($_POST['pro-titulo']) &&
                        isset($_POST['pro-descripcion']) &&
                        isset($_POST['pro-enlace']) &&
                        !empty($_POST['pro-titulo']) &&
                        !empty($_POST['pro-descripcion']) &&
                        !empty($_POST['pro-enlace'])
                    ) {

                        for ($i = 0; $i < count($_POST['pro-titulo']); $i++) {
                            $titulo = $_POST['pro-titulo'][$i];
                            $descripcion = $_POST['pro-descripcion'][$i];
                            $enlace = $_POST['pro-enlace'][$i];
                            $resultadoProject = $projectController->insert_project_ctrl($maxidint, $titulo, $descripcion, $enlace);
                        }


                        if ($resultadoPortfolio && $resultadoProject) {
                            header('Location: ../views/portfolio/index.php');
                            exit;
                        } else {
                            echo "Hubo un error al insertar los datos.";
                        }
                    } else {
                        echo "El formulario no ha sido enviado.";
                    }
                }

                /* edit */
            case 'edit':
                if (
                    isset($_POST['por_titulo']) &&
                    isset($_POST['por_nombre']) &&
                    isset($_POST['por_apellidos']) &&
                    isset($_POST['por_especialidad']) &&
                    isset($_POST['por_telefono']) &&
                    isset($_POST['por_email']) &&
                    !empty($_POST['por_titulo']) &&
                    !empty($_POST['por_nombre']) &&
                    !empty($_POST['por_apellidos']) &&
                    !empty($_POST['por_especialidad']) &&
                    !empty($_POST['por_telefono']) &&
                    !empty($_POST['por_email'])
                ) {
                    $por_skills_array = $_POST['por-skills'];
                    $por_skills = implode(', ', $por_skills_array);

                    $portfolioData = new PortfolioData(
                        $_POST['por_titulo'],
                        $_POST['por_nombre'],
                        $_POST['por_apellidos'],
                        $_POST['por_especialidad'],
                        $_POST['por_telefono'],
                        $_POST['por_email'],
                        $_POST['por_github'] ?? '',
                        $_POST['por_linkedin'] ?? '',
                        $_POST['por_tik_tok'] ?? '',
                        $_POST['por_instagram'] ?? '',
                        $_POST['por_twitter'] ?? '',
                        $por_skills,
                        $_POST['por_sobre_mi'] ?? ''
                    );

                    $id = $_POST['pk_portfolio'];
                    $resultado = $portfolioController->edit($id, $portfolioData);

                    if (
                        isset($_POST['pro-titulo']) &&
                        isset($_POST['pro-descripcion']) &&
                        isset($_POST['pro-enlace']) &&
                        !empty($_POST['pro-titulo']) &&
                        !empty($_POST['pro-descripcion']) &&
                        !empty($_POST['pro-enlace'])
                    ) {

                        $resultado = $projectController->delette_project_ctrl($id);

                        for ($i = 0; $i < count($_POST['pro-titulo']); $i++) {
                            $titulo = $_POST['pro-titulo'][$i];
                            $descripcion = $_POST['pro-descripcion'][$i];
                            $enlace = $_POST['pro-enlace'][$i];
                            $resultadoProject = $projectController->insert_project_ctrl($id, $titulo, $descripcion, $enlace);
                        }

                        if ($resultado) {
                            header('Location: ../views/portfolio/index.php');
                            exit;
                        } else {
                            echo "Hubo un error al insertar los datos.";
                        }
                    } else {
                        echo "El formulario no ha sido enviado.";
                    }
                    break;
                }

                /* delete */
            case 'delete':
                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    $id = $_POST['id'];
                    $resultado = $portfolioController->delete($id);
                    if ($resultado) {
                        // Redirige al usuario a la lista de portfolios después de la eliminación
                        header('Location: ../views/portfolio/index.php');
                        exit;
                    } else {
                        echo "Hubo un error al eliminar el portfolio.";
                    }
                } else {
                    echo "No se ha proporcionado un ID válido para eliminar.";
                }
                break;

            default:
                break;
        }
    }
}

// switch project

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['boton'])) {

        switch ($_POST['boton']) {

            case 'index':

            case 'edit':

                if (
                    isset($_POST['pro_titulo']) &&
                    isset($_POST['pro_descripcion']) &&
                    isset($_POST['pro_enlace']) &&
                    !empty($_POST['pro_titulo']) &&
                    !empty($_POST['pro_descripcion']) &&
                    !empty($_POST['pro_enlace'])
                ) {

                    $titulo = $_POST['pro_titulo'];
                    $desripcion = $_POST['pro_descripcion'];
                    $enlace = $_POST['pro_enlace'];

                    //$resultado = $projectController->update_project_ctrl_project_ctrl($fk_portfolio, $pro_titulo, $pro_descripcion, $pro_enlace);

                    if ($resultado) {
                        echo "Datos recibidos correctamente.";
                    } else {
                        echo "Hubo un error al insertar los datos.";
                    }
                } else {
                    // El formulario no ha sido enviado
                    echo "El formulario no ha sido enviado.";
                }

                break;
            case 'delete':

                $projectController->delette_project_ctrl($pk_project);

                break;
        }
    }
}
