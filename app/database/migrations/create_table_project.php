<?php
/**
 * Función para crear la tabla portfolios
 * @param object $con
 */
function create_table_project($con)
{
    $strSQL = "CREATE TABLE IF NOT EXISTS project (
        pk_project INT AUTO_INCREMENT PRIMARY KEY,
        fk_portfolio INT NOT NULL,
        pro_titulo VARCHAR(255) NOT NULL,
        pro_descripcion VARCHAR(5000) NOT NULL,
        pro_enlace VARCHAR(255), /* Campo opcional */
        FOREIGN KEY (fk_portfolio) REFERENCES portfolio(pk_portfolio) ON DELETE CASCADE
    );";

    mysqli_query($con, $strSQL);
}