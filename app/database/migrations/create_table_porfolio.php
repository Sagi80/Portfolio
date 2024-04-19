<?php
/**
 * Función para crear la tabla portfolios
 * @param object $con
 */
function create_table_portfolio($con)
{
    $strSQL = "CREATE TABLE IF NOT EXISTS portfolio (
    pk_portfolio INT PRIMARY KEY AUTO_INCREMENT,
    por_titulo VARCHAR(25) UNIQUE NOT NULL,
    por_nombre VARCHAR(25) NOT NULL,
    por_apellidos VARCHAR(50),
    por_especialidad VARCHAR(255) NOT NULL,
    por_telefono VARCHAR(9) NOT NULL, /* No se deberá hacer cálculos matemáticos con los teléfonos por lo que serán tratados como strings */
    por_email VARCHAR(255) NOT NULL,
    por_github VARCHAR(255),
    por_linkedin VARCHAR(255),
    por_tik_tok VARCHAR(255),
    por_instagram VARCHAR(255),
    por_twitter VARCHAR(255),
    por_cv VARCHAR(255) NOT NULL,
    por_skills VARCHAR(5000),
    por_sobre_mi VARCHAR(500) NOT NULL,
    por_fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    mysqli_query($con, $strSQL);
}