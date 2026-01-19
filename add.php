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

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dayplanner/Editar</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="body">
        <div class="container">
            <h1 class="header">&nbsp;Agregar tarea</h1>
        </div>

        <!-- Formulario para agregar o editar tarea -->
        <div class="form-add-edit">
            <form class="add_task" method="POST" action="add.php">

                <!-- Título de la tarea -->
                <input type="text" name="titulo" placeholder="Agregar un título a tu tarea" class="title_task" required>

                <!-- Boton de fecha y hora -->
                <div class="botones_hora_fecha">
                    <div class="select_date">
                    <label for="btn_date" id="lbl_date">Fecha:</label>
                    <!-- Boton de fecha -->
                    <input id="btn_date" name="fecha" type="date" required></input>
                    </div>
                    <div class="select_date">
                    <label for="btn_hour" id="lbl_date">Hora:</label>
                    <!-- Boton de hora -->
                    <input id="btn_hour" name="hora" type="time" required></input>
                    </div>
                </div>

                <!-- Checkboxes -->
                <div class="checkboxes">
                    <!-- Checkbox para todo el día -->
                    <div class="check_task">
                    <input type="checkbox" name="all_day" id="all_day">
                    <label for="all_day">Todo el día</label>
                    </div>

                    <!-- Checkbox para repetir tarea -->
                    <div class="check_task">
                    <input type="checkbox" name="repeat_task" id="repeat_task">
                    <label for="repeat_task">Repetir tarea</label>
                    </div>
                </div>

                <!-- Selector de color de importancia -->
                <label for="color" id="color_label">Importancia:</label>
                <select name="color" id="color">
                <option>Seleccionar...</option>
                <option>🔴 Muy importante</option>
                <option>🟢 Importante</option>
                <option>🔵 No tan importante</option>
                </select>

                <!-- Descripción de la tarea -->
                <textarea name="descripcion" id="descripcion" placeholder="Descripción"></textarea>


                <!-- Botón para agregar tarea -->
                <button type="submit" class="add_btn">Agregar tarea</button>

            </form>
            
        </div>
        
        <script src="js/app.js"></script>
    </body>

    </html>