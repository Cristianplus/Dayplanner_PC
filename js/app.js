/* ==========================================================
ELIMINAR TAREA (botón papelera)
- Detiene propagación del click
- Confirma eliminación
- Llama a delete.php vía fetch
- Elimina la tarea del DOM si es exitosa
   ========================================================== */
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".delete-btn").forEach(button => {

        // Evita que el click abra la edición de la tarea
        button.addEventListener("click", e => {
            e.stopPropagation();
        });

        button.addEventListener("click", function () {

            const taskComplete = this.closest(".task-complete");
            const taskId = taskComplete.dataset.id;

            if (!confirm("¿Está seguro que desea eliminar esta tarea?")) return;

            fetch("delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + taskId
            })
            .then(response => response.text())
            .then(result => {
                if (result === "ok") {
                    taskComplete.remove(); // elimina del HTML
                } else {
                    alert("Error al eliminar la tarea");
                }
            });
        });
    });
});


/* ==========================================================
EDITAR TAREA (click en la tarjeta)
- Redirige a edit.php con el ID de la tarea
   ========================================================== */
document.querySelectorAll(".task-card").forEach(card => {
    card.addEventListener("click", () => {
        const id = card.closest(".task-complete").dataset.id;
        window.location.href = "edit.php?id=" + id;
    });
});


/* ==========================================================
PERMISO PARA NOTIFICACIONES
- Solicita permiso al cargar la página
   ========================================================== */
document.addEventListener("DOMContentLoaded", () => {

    if ("Notification" in window) {
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }
    }

});


/* ==========================================================
PROGRAMAR NOTIFICACIONES DE TAREAS
- Usa las tareas enviadas desde PHP
- Calcula fecha y hora
- Dispara una notificación en el momento exacto
   ========================================================== */
document.addEventListener("DOMContentLoaded", () => {

    if (!window.tareas) return;

    window.tareas.forEach(tarea => {

        // Si no hay fecha u hora, no se agenda
        if (!tarea.fecha || !tarea.hora) return;

        const fechaHora = new Date(`${tarea.fecha}T${tarea.hora}`);
        const ahora = new Date();

        const tiempoRestante = fechaHora - ahora;

        if (tiempoRestante > 0) {
            setTimeout(() => {
                new Notification(tarea.titulo, {
                    body: (tarea.descripcion && tarea.descripcion.trim() !== "")
                        ? tarea.descripcion
                        : "Tarea programada"
                });
            }, tiempoRestante);
        }

    });

});


/* ==========================================================
DEBUG
- Muestra las tareas recibidas desde PHP
   ========================================================== */
console.log("Tareas recibidas:", window.tareas);
