<?php
// Conexión a la base de datos
include "bd/bd.php";  

// Verificar que el formulario fue enviado
if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    // Recibir los datos del formulario
    $titulo = $_POST["titulo"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $descripcion = $_POST["descripcion"];
    $color = $_POST["color"];

    // Manejo de checkboxes
    $all_day = isset($_POST["all_day"]) ? 1 : 0;
    $repeat_task = isset($_POST["repeat_task"]) ? 1 : 0;

    // Crear consulta SQL
    $sql = "INSERT INTO tareas 
    (titulo, fecha, hora, all_day, repeat_task, color, descripcion)
    VALUES
    (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("sssiiss", $titulo, $fecha, $hora, $all_day, $repeat_task, $color, $descripcion);


    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        // Redirigir si se guardó correctamente
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar la tarea: " . $conexion->error;
        }
} else {
        echo "Acceso no permitido";
    }
?>