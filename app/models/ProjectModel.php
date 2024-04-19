<?php
require_once $_SESSION['MODELS_PATH'] . '/PortfolioModel.php';
//Heredar clase Model
class ProjectModel extends Model
{

    /*
     * funcion para devolver la tabla project entera
     * @return array
     */
    public function get_all_projects_model()
    {

        $resultados = array();
        $query = "SELECT * FROM project;";
        $query_result = mysqli_query($this->db, $query);

        if ($query_result) {
            $resultados = $this->db->fecth_Array_Assoc($query_result);

        } else {
            $resultados = array();
        }

        return $resultados;
    }

    /*
     * Función para obtener un project pasandole la primary key
     * @param integer
     * @return array
     */
    function get_project_model($fk_portfolio)
    {
        $resultados = array();
        $query = "SELECT * FROM project WHERE fk_portfolio = $fk_portfolio;";
        $query_result = mysqli_query($this->db, $query);
    
        if ($query_result) {
            while ($row = mysqli_fetch_assoc($query_result)) {
                $resultados[] = $row; // Agregar cada fila al array de resultados
            }
        } else {
            $resultados = array(); // Inicializar el array de resultados en caso de falla
        }
    
        return $resultados;
    }

    /*
     * función para introducir un project
     * @param string $fk_portfolio
     * @param string $pro_titulo
     * @param string $pro_descripcion
     * @param string $pro_enlace
     * @return bool
     */
    public function insert_project_model(int $fk_portfolio, string $pro_titulo, string $pro_descripcion, string $pro_enlace)
    {
        $pro_titulo = mysqli_real_escape_string($this->db, $pro_titulo);
        $pro_descripcion = mysqli_real_escape_string($this->db, $pro_descripcion);

        $query = "INSERT INTO project (fk_portfolio, pro_titulo, pro_descripcion, pro_enlace)
                VALUES ('{$fk_portfolio}','{$pro_titulo}','{$pro_descripcion}','{$pro_enlace}');";

        $result = mysqli_query($this->db, $query);

        return $result;
    }

    /*
     * función para modificar un project
     * @param int    $fk_portfolio
     * @param string $pro_titulo
     * @param string $pro_descripcion
     * @param string $pro_enlace
     * @return bool
     */
    public function update_project_model(int $pk_project, string $pro_titulo, string $pro_descripcion, string $pro_enlace)
    {
        $query = "UPDATE project where  set , pro_titulo = '$pro_titulo',
        pro_descripcion ='$pro_descripcion', pro_enlace = '$pro_enlace';";

        $result = mysqli_query($this->db, $query);

        return $result;
    }

    /**
     * función para borrar un portfolio
     *
     * @param  int $pk_project
     * @return bool
     */
    public function delette_project_model(int $fk_portfolio)
    {
        $query = "DELETE FROM project WHERE fk_portfolio = $fk_portfolio;";

        $result = mysqli_query($this->db, $query);

        return $result;
    }
}