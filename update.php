<?php
include "bd/bd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 1. Recibir el ID
    $id = $_POST["id"];

    // 2. Recibir los datos del formulario
    $titulo = $_POST["titulo"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $descripcion = $_POST["descripcion"];
    $color = $_POST["color"];

    // 3. Checkboxes
    $all_day = isset($_POST["all_day"]) ? 1 : 0;
    $repeat_task = isset($_POST["repeat_task"]) ? 1 : 0;

    // 4. SQL Update
    $sql = "UPDATE tareas SET
    titulo = ?,
    fecha = ?,
    hora = ?,
    all_day = ?,
    repeat_task = ?,
    color = ?,
    descripcion = ?
    WHERE id = ?";

    // 5. Preparar 
    $stmt = $conexion->prepare($sql);

    // 6. Vincular parámetros
    $stmt->bind_param(
        "sssiiisi",
        $titulo,
        $fecha,
        $hora,
        $all_day,
        $repeat_task,
        $color,
        $descripcion,
        $id
    );

    // 7. Ejecutar
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la tarea";
    }
} else {
    echo "Acceso no permitido";
}