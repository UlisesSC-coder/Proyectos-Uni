document.addEventListener("DOMContentLoaded", function() {
    // 1. Manejo delegativo para las redirecciones con confirmación desde listados externos
    const botonesEditar = document.querySelectorAll('.btn-editar-usuario');
    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            confirmarEdicionUsuario(id);
        });
    });

    // 2. Interceptor estructurado del evento 'submit' en el formulario actual
    const formulario = document.getElementById("formEditarUsuario");
    if (formulario) {
        formulario.addEventListener("submit", function(evento) {
            if (!validarEditarUsuario()) {
                evento.preventDefault(); // Detiene el POST si falla la validación
            }
        });
    }
});

function confirmarEdicionUsuario(id) {
    if (confirm("¿Estás seguro de que deseas editar las credenciales del Usuario #" + id + "?")) {
        window.location.href = "formulario_editar_usuario.php?id=" + id;
    }
}

function validarEditarUsuario() {
    const usuario = document.getElementById("usuario");
    const tipousuario = document.getElementById("tipousuario");
    const clave = document.getElementById("clave");

    // Limpieza de estilos de error previos
    if (usuario) usuario.classList.remove("input-error-validar");
    if (tipousuario) tipousuario.classList.remove("input-error-validar");
    if (clave) clave.classList.remove("input-error-validar");

    // Validación: Nombre de Usuario (Login)
    if (!usuario || usuario.value.trim() === "") {
        marcarError(usuario);
        alert("¡Atención!\n\ El campo 'Nombre de Usuario' es obligatorio y no puede quedar vacío.");
        if (usuario) usuario.focus();
        return false;
    }

    // Validación: Rol de Privilegios
    if (!tipousuario || tipousuario.value.trim() === "") {
        marcarError(tipousuario);
        alert("¡Atención!\n\nEl campo 'Rol de Privilegios' es obligatorio.");
        if (tipousuario) tipousuario.focus();
        return false;
    }

    // Validación: Contraseña / Clave de Acceso
    if (!clave || clave.value.trim() === "") {
        marcarError(clave);
        alert("¡Atención!\n\nEl campo 'Contraseña de Acceso' es obligatorio y no puede quedar vacío.");
        if (clave) clave.focus();
        return false;
    }

    return true;
}

function marcarError(elem) {
    if (elem) {
        elem.classList.add("input-error-validar");
    }
}