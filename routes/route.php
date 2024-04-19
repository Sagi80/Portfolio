<?php
/**
 * Inicia la sesión y define las rutas del directorio base del proyecto en variables de sesión
 */
session_start();

// Define la ruta del directorio base del proyecto
$_SESSION['BASE_PATH'] = realpath(dirname(__FILE__) . '/..');

// Define constantes para las rutas específicas dentro del proyecto
$_SESSION['CONFIG_PATH'] = $_SESSION['BASE_PATH'] . '/app/config';
$_SESSION['DTO_PATH'] = $_SESSION['BASE_PATH'] . '/app/DTO';
$_SESSION['CONTROLLERS_PATH'] = $_SESSION['BASE_PATH'] . '/app/controllers';
$_SESSION['DATABASE_PATH'] = $_SESSION['BASE_PATH'] . '/app/database';
$_SESSION['MODELS_PATH'] = $_SESSION['BASE_PATH'] . '/app/models';
$_SESSION['VIEWS_PATH'] = $_SESSION['BASE_PATH'] . '/app/views/portfolio';

/**
 * Define la hora
 */
date_default_timezone_set('UTC');

/**
 * Configuración de errores (ajusta según el entorno de desarrollo o producción)
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Autocarga de clases
 */
spl_autoload_register(function ($className) {
    $path = BASE_PATH . '/app/';
    $extension = '.php';
    $fullPath = $path . str_replace('\\', '/', $className) . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }
    include_once $fullPath;
});