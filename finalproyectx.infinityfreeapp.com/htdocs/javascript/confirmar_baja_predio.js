document.addEventListener("DOMContentLoaded", function() {
    const botonesEliminar = document.querySelectorAll(".btn-eliminar-baja");

    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", function(evento) {
            evento.preventDefault();

            const claveCatastral = this.getAttribute("data-clave");

            if (!claveCatastral) {
                alert("ERROR: No se pudo recuperar la Clave Catastral de este registro.");
                return;
            }

            const confirmacion = confirm("¿Está completamente seguro de que desea eliminar permanentemente el predio con Clave Catastral #" + claveCatastral + "?\n\nEsta operación no se puede deshacer.");

            if (confirmacion) {
                window.location.href = "procesar_baja_predio.php?clave=" + encodeURIComponent(claveCatastral);
            }
        });
    });
});