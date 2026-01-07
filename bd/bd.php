<?php
$servidor = "localhost";
$usuario = "root";
$password = "cristian2910";
$bd = "dayplanner_pc";

$conexion = new mysqli($servidor, $usuario, $password, $bd);

// Verificar Conexión
if($conexion->connect_error) {
    die("No se pudo conectar a la base de datos");
}

$conexion->set_charset("utf8");
?>