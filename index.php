<?php
include "bd/bd.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $sql = "SELECT * FROM tareas";
    $result = $conexion->query($sql);
    $tareas = $result->fetch_all(MYSQLI_ASSOC);
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

            <?php foreach ($tareas as $tarea): ?>

                <?php
                $meses = [
                    "January" => "enero",
                    "February" => "febrero",
                    "March" => "marzo",
                    "April" => "abril",
                    "May" => "mayo",
                    "June" => "junio",
                    "July" => "julio",
                    "August" => "agosto",
                    "September" => "septiembre",
                    "October" => "octubre",
                    "November" => "noviembre",
                    "December" => "diciembre"
                ];

                $fecha = date("j \\d\\e F \\d\\e\\l Y", strtotime($tarea['fecha']));
                $fechaFormateada = str_replace(
                    array_keys($meses),
                    array_values($meses),
                    $fecha
                );
                ?>

                <div class="task-complete" data-id="<?= $tarea['id'] ?>">
                    <div class="title-date">
                        <?= $fechaFormateada ?>
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
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        window.tareas = <?= json_encode($tareas); ?>;
    </script>

    <script src="js/app.js"></script>
</body>

</html>