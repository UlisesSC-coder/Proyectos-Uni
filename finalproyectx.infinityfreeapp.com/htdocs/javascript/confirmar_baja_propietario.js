document.addEventListener("DOMContentLoaded", function() {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-baja');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            interceptarBajaPropietario(id);
        });
    });
});

function interceptarBajaPropietario(id) {
    if (confirm("🚨 ATENCIÓN ADMINISTRADOR\n\n¿Estás seguro de que deseas eliminar permanentemente al propietario ID #" + id + "?\nEsta acción borrará irrevocablemente su información personal de contribuyente.")) {
        window.location.href = "procesar_baja_propietario.php?id=" + id;
    }
}