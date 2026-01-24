<?php 
include "bd/bd.php";

if ($_SERVER ["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM tareas";
    $result = $conexion->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dayplanner</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="body">
        <?php include "menu.php"; ?>
        <div class="main-content">
            <div class="container">
                <h1 class="header">&nbsp;Tareas</h1>
            </div>

            <!-- Botón para agregar tarea -->
            <a href="add.php">
                <button class="add_task_btn">+</button>
            </a>

            <div class="tasks-container">

                <?php while ($tarea = $result->fetch_assoc()): ?>
                    <div class="task-complete" data-id="<?= $tarea['id'] ?>">
                        <div class="title-date">
                        <?= htmlspecialchars($tarea['fecha']) ?>
                        </div>

                        <div class="task-card" data-id="<?= $tarea['id'] ?>">
                            <h3><?= htmlspecialchars($tarea['titulo']) ?></h3>
                            
                            <button class="delete-btn">
                                <img src="img/papelera.png" alt="Eliminar">
                            </button>

                            <p>
                                <?= $tarea['all_day'] ? '(Todo el día)' : $tarea['hora'] ?>
                            </p>

                            <p><?= htmlspecialchars($tarea['descripcion']) ?></p>

                            
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <script src="js/app.js"></script>
    </body>

    </html>