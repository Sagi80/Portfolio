<?php
require_once $_SESSION['MODELS_PATH'] . '/Model.php';

/**
 * Hereda de la clase model
 */

class PortfolioModel extends Model
{

    /**
     * Constructor
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * funcion para devolver la tabla portfolio entera
     * @return array
     */
    public function get_all_portfolios()
    {
        $resultados = array();
        $query = "SELECT * FROM portfolio;";
        $query_result = mysqli_query($this->db, $query);

        if ($query_result) {
            $resultados = $this->fetch_Array_Assoc($query_result);
        } else {
            $resultados = array();
        }
        return $resultados;
    }

    public function get_max_id_portfolios()
    {
        $resultados = array();
        $query = "select max(pk_portfolio) as maxId from portfolio;";
        $query_result = mysqli_query($this->db, $query);

        if ($query_result) {
            $resultados = $this->fetch_Array_Assoc($query_result);
        } else {
            $resultados = array();
        }
        return $resultados;
    }


    /**
     * Función para obtener un portfolio pasandole la primary key
     * @param integer
     * @return array
     */

    function get_portfolio($pk_portfolio)
    {
        $resultados = array();
        $stmt = mysqli_prepare($this->db, "SELECT * FROM portfolio WHERE pk_portfolio = ?");
        mysqli_stmt_bind_param($stmt, 'i', $pk_portfolio);
        mysqli_stmt_execute($stmt);
        $query_result = mysqli_stmt_get_result($stmt);

        if ($query_result) {
            $resultados = mysqli_fetch_assoc($query_result);
            mysqli_free_result($query_result);
        }

        mysqli_stmt_close($stmt);
        return $resultados;
    }


    /**
     * Introduce un nuevo portfolio en la base de datos.
     * @param PortfolioData
     * @return bool
     */
    public function introducir_nuevo_portfolio(PortfolioData $data, $file)
    {
        $por_titulo = mysqli_real_escape_string($this->db, $data->por_titulo);
        $por_nombre = mysqli_real_escape_string($this->db, $data->por_nombre);
        $por_apellidos = mysqli_real_escape_string($this->db, $data->por_apellidos);
        $por_especialidad = mysqli_real_escape_string($this->db, $data->por_especialidad);
        $por_telefono = mysqli_real_escape_string($this->db, $data->por_telefono);
        $por_email = mysqli_real_escape_string($this->db, $data->por_email);
        $por_github = mysqli_real_escape_string($this->db, $data->por_github);
        $por_linkedin = mysqli_real_escape_string($this->db, $data->por_linkedin);
        $por_tik_tok = mysqli_real_escape_string($this->db, $data->por_tik_tok);
        $por_instagram = mysqli_real_escape_string($this->db, $data->por_instagram);
        $por_twitter = mysqli_real_escape_string($this->db, $data->por_twitter);
        $por_skills = mysqli_real_escape_string($this->db, $data->por_skills);
        $por_sobre_mi = mysqli_real_escape_string($this->db, $data->por_sobre_mi);

        $uploadDir = '../../public/assets/pdf/';

        $filename = time() . '_' . basename($file['name']);
        $uploadFile = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $por_cv_path = mysqli_real_escape_string($this->db, $uploadFile);

            // Query
            $query = "INSERT INTO portfolio (por_titulo, por_nombre, por_apellidos, por_especialidad, por_telefono, por_email, por_github,
                      por_linkedin, por_tik_tok, por_instagram, por_twitter, por_cv, por_skills, por_sobre_mi)
                  VALUES ('{$por_titulo}','{$por_nombre}','{$por_apellidos}','{$por_especialidad}','{$por_telefono}','{$por_email}',
                        '{$por_github}','{$por_linkedin}','{$por_tik_tok}','{$por_instagram}','{$por_twitter}',
                        '{$por_cv_path}','{$por_skills}','{$por_sobre_mi}');";

            $result = mysqli_query($this->db, $query);
            return (bool) $result;
        } else {
            return false;
        }
    }


    /**
     * @param int
     * @param PortfolioData
     * @return bool
     */

    function edit_portfolio(int $pk_portfolio, PortfolioData $data, $file)
    {

        $uploadDir = '../../public/assets/pdf/';

        $filename = time() . '_' . basename($file['name']);
        $uploadFile = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $por_cv_path = mysqli_real_escape_string($this->db, $uploadFile);
            $por_cv_path ?? '';
        }

        $query = "UPDATE portfolio SET 
                    por_titulo = ?, 
                    por_nombre = ?, 
                    por_apellidos = ?, 
                    por_especialidad = ?, 
                    por_telefono = ?, 
                    por_email = ?, 
                    por_github = ?, 
                    por_linkedin = ?, 
                    por_tik_tok = ?, 
                    por_instagram = ?, 
                    por_twitter = ?, 
                    por_cv = ?,
                    por_skills = ?, 
                    por_sobre_mi = ? 
                  WHERE pk_portfolio = ?";

        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param(
                $stmt,
                'ssssssssssssssi',
                $data->por_titulo,
                $data->por_nombre,
                $data->por_apellidos,
                $data->por_especialidad,
                $data->por_telefono,
                $data->por_email,
                $data->por_github,
                $data->por_linkedin,
                $data->por_tik_tok,
                $data->por_instagram,
                $data->por_twitter,
                $por_cv_path,
                $data->por_skills,
                $data->por_sobre_mi,
                $pk_portfolio
            );

            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        return $result;
    }


    /**
     * función para borrar un portfolio
     *
     * @param  int
     * @return bool
     */
    function delete_portfolio(int $pk_portfolio)
    {
        $query = "DELETE FROM portfolio WHERE pk_portfolio = $pk_portfolio;";

        $result = mysqli_query($this->db, $query);

        return $result;
    }
}
