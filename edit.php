<?php
include "bd/bd.php";

if (!isset($_GET['id'])) {
    die("ID de tarea no proporcionado");
}

$id = $_GET['id'];

$sql = "SELECT * FROM tareas WHERE id = $id";
$result = $conexion->query($sql);

if ($result->num_rows !== 1) {
    die("Tarea no encontrada");
}

$tarea = $result->fetch_assoc();
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
    <?php include "menu.php"; ?>
    <div class="main-content">
        <div class="container">
            <h1 class="header">&nbsp;Editar tarea</h1>
        </div>

        <!-- Formulario para agregar o editar tarea -->
        <div class="form-add-edit">
            <form class="add_task" method="POST" action="update.php">

                <!-- Título de la tarea -->
                <input
                    type="text"
                    name="titulo"
                    class="title_task"
                    required
                    value="<?= htmlspecialchars($tarea['titulo']) ?>">

                <!-- Boton de fecha y hora -->
                <div class="botones_hora_fecha">
                    <div class="select_date">
                        <label for="btn_date" id="lbl_date">Fecha:</label>
                        <!-- Boton de fecha -->
                        <input
                            id="btn_date"
                            name="fecha"
                            type="date"
                            required
                            value="<?= $tarea['fecha'] ?>">
                    </div>
                    <div class="select_date">
                        <label for="btn_hour" id="lbl_date">Hora:</label>
                        <!-- Boton de hora -->
                        <input
                            id="btn_hour"
                            name="hora"
                            type="time"
                            required
                            value="<?= $tarea['hora'] ?>">
                    </div>
                </div>

                <!-- Checkboxes -->
                <div class="checkboxes">
                    <!-- Checkbox para todo el día -->
                    <div class="check_task">
                        <input
                            type="checkbox"
                            name="all_day"
                            id="all_day"
                            <?= $tarea['all_day'] ? 'checked' : '' ?>>
                        <label for="all_day">Todo el día</label>
                    </div>

                    <!-- Checkbox para repetir tarea -->
                    <div class="check_task">
                        <input
                            type="checkbox"
                            name="repeat_task"
                            id="repeat_task"
                            <?= $tarea['repeat_task'] ? 'checked' : '' ?>>
                        <label for="repeat_task">Repetir tarea</label>
                    </div>
                </div>

                <!-- Selector de color de importancia -->
                <label for="color" id="color_label">Importancia:</label>
                <select name="color" id="color">
                    <option value="">Seleccionar...</option>
                    <option value="🔴 Muy importante" <?= $tarea['color'] == "🔴 Muy importante" ? 'selected' : '' ?>>
                        🔴 Muy importante
                    </option>
                    <option value="🟢 Importante" <?= $tarea['color'] == "🟢 Importante" ? 'selected' : '' ?>>
                        🟢 Importante
                    </option>
                    <option value="🔵 No tan importante" <?= $tarea['color'] == "🔵 No tan importante" ? 'selected' : '' ?>>
                        🔵 No tan importante
                    </option>
                </select>

                <!-- Descripción de la tarea -->
                <textarea name="descripcion" id="descripcion"><?= htmlspecialchars($tarea['descripcion']) ?></textarea>

                <!-- Botón para agregar tarea -->
                <button type="submit" class="add_btn">Guardar cambios</button>

            </form>

        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>