<?php

require_once __DIR__ . '/vendor/autoload.php';


use App\Controllers\OperacionesController;

$resultados = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador = new OperacionesController();
    $resultados = $controlador->procesarFormulario($_POST);
}
require_once __DIR__ . '/views/home.php';
?>

