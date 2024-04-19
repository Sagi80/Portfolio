<?php
require_once $_SESSION['DATABASE_PATH'] . '/migrations/create_table_porfolio.php';
require_once $_SESSION['DATABASE_PATH'] . '/migrations/create_table_project.php';
require_once $_SESSION['DATABASE_PATH'] . '/seeders/PortfolioSeeder.php';

class Database
{

    // Variables de conexión
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "proyecto";
    private $con;

    /**
     * Función contructora
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Función para conectar a la base de datos y usar la database
     */
    private function connect()
    {
        $this->con = mysqli_connect($this->host, $this->username, $this->password) or die("Error al conectar con la base de datos: " . mysqli_error($this->con));
        $this->createDatabase();
        mysqli_select_db($this->con, $this->dbname);
    }

    public function getConnection()
    {
        return $this->con;
    }

    /**
     * función para crear la database
     */
    private function createDatabase()
    {
        $strSQL = "CREATE DATABASE IF NOT EXISTS {$this->dbname};";
        mysqli_query($this->con, $strSQL) or die("Error al crear la base de datos: " . mysqli_error($this->con));
        mysqli_select_db($this->con, $this->dbname) or die("Error al seleccionar la base de datos: " . mysqli_error($this->con));
        $this->createTablePortfolio();
        $this->createTableProject();
        $this->seedTablePortfolio();
    }
    
    /**
     * Función para crear la tabla portfolio
     */
    private function createTablePortfolio()
    {
        create_table_portfolio($this->con);
    }

    /**
     * Función para crear la tabla Project
     */
    private function createTableProject()
    {
        create_table_project($this->con);
    }
    

    /**
     * Función para crear la tabla Project
     */
    private function seedTablePortfolio()
    {
        seed_table_portfolio($this->con);
    }

    /**
     * Funcion para cerrar la conexión
     */
    public function closeConnection()
    {
        mysqli_close($this->con);
    }
}