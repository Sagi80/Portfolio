<?php

/**
 * Función para insertar datos de ejemplo en la tabla portfolios.
 * @param object $con
 */
function seed_table_portfolio($con)
{
    $portfolios = [
        [
            'por_titulo' => 'Desarrollador Web',
            'por_nombre' => 'Juan',
            'por_apellidos' => 'Pérez López',
            'por_especialidad' => 'Desarrollo Backend',
            'por_telefono' => '123456789',
            'por_email' => 'juan.perez@example.com',
            'por_github' => 'https://github.com/juanperez',
            'por_linkedin' => 'https://linkedin.com/in/juanperez',
            'por_tik_tok' => '',
            'por_instagram' => '',
            'por_twitter' => '@juanperez',
            'por_cv' => '',
            'por_skills' => 'PHP, MySQL, Laravel, JavaScript, Node.js',
            'por_sobre_mi' => 'Desarrollador web con más de 5 años de experiencia...'
        ]
    ];

    foreach ($portfolios as $portfolio) {
        $strSQL = "INSERT IGNORE INTO portfolio (por_titulo, por_nombre, por_apellidos, por_especialidad, por_telefono, por_email, por_github, por_linkedin, por_tik_tok, por_instagram, por_twitter, por_cv, por_skills, por_sobre_mi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($con, $strSQL)) {
            mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $portfolio['por_titulo'], $portfolio['por_nombre'], $portfolio['por_apellidos'], $portfolio['por_especialidad'], $portfolio['por_telefono'], $portfolio['por_email'], $portfolio['por_github'], $portfolio['por_linkedin'], $portfolio['por_tik_tok'], $portfolio['por_instagram'], $portfolio['por_twitter'], $portfolio['por_cv'], $portfolio['por_skills'], $portfolio['por_sobre_mi']);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}