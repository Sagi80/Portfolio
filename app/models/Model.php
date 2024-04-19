<?php
require_once $_SESSION['CONFIG_PATH'] . '/database.php';

/**
 * Clase Model
 */
class Model
{
    protected $db;

    /**
     * Función constructora
     */
    public function __construct()
    {
        $this->db = $this->connectToDatabase();
    }

    /**
     * Función para conectar a la base de datos
     * @return object
     */
    protected function connectToDatabase()
    {
        $db = new Database();
        return $db->getConnection();
    }

    /**
     * Función que devuelve el número de filas que contienen datos
     * @param mysqli_result $resultado
     * @return integer
     */
    protected function obtener_num_filas(mysqli_result $resultado)
    {
        return mysqli_num_rows($resultado);
    }

    /**
     * Función que mediante un resultset devuelve un array normal con los datos que contiene
     * @param mysqli_result $resultado
     * @return array
     */
    public function fetch_Array(mysqli_result $resultado)
    {
        return mysqli_fetch_array($resultado);
    }

    /**
     * Función que mediante un resultset devuelve un array associativo con los datos que contiene
     *
     * @param mysqli_result $resultado
     * @return array
     */
    public function fetch_Array_Assoc(mysqli_result $resultado)
    {
        $resultados = array();

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $resultados[] = $fila;
        }
        return $resultados;
    }
}