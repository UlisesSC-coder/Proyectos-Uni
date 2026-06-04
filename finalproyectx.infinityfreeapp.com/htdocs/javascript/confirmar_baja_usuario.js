document.addEventListener("DOMContentLoaded", function() {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-baja');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function() {
            const idUsuario = this.getAttribute('data-id');
            interceptarBajaUsuario(idUsuario);
        });
    });
});

function interceptarBajaUsuario(idUsuario) {
    // Caja de confirmación nativa del navegador
    var respuesta = confirm("🚨 ¿ESTÁS ABSOLUTAMENTE SEGURO?\n\nVas a eliminar permanentemente la cuenta de acceso del Usuario #" + idUsuario + ".\nEsta acción no se puede deshacer de ninguna manera.");
    
    // Si da clic en Aceptar
    if (respuesta) {
        // Redirige al mismo archivo pasando el ID por GET y la bandera de acción
        window.location.href = "baja_usuario.php?accion=eliminar&id=" + idUsuario;
    }
}