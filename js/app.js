document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".delete-btn").forEach(button => {
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


document.querySelectorAll(".task-card").forEach(card => {
    card.addEventListener("click", () => {
        const id = card.closest(".task-complete").dataset.id;
        window.location.href = "edit.php?id=" + id;
    });
});

