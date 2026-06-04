document.addEventListener("DOMContentLoaded", function() {
    const formUsuario = document.getElementById("formUsuario");

    if (formUsuario) {
        formUsuario.addEventListener("submit", function(evento) {
            
            const inputUsuario = document.getElementById("usuario");
            const inputClave = document.getElementById("clave");
            const inputTipo = document.getElementById("tipousuario");

            // Limpiar estilos anteriores
            const campos = [inputUsuario, inputClave, inputTipo];
            campos.forEach(campo => {
                if (campo) {
                    campo.style.borderColor = "#dcdfe4";
                    campo.style.backgroundColor = "#ffffff";
                }
            });

            // Validar Nombre de Usuario
            if (!inputUsuario || inputUsuario.value.trim() === "") {
                evento.preventDefault();
                marcarError(inputUsuario);
                alert("El campo 'Nombre de Usuario (Login)' es obligatorio.");
                if (inputUsuario) inputUsuario.focus();
                return false; 
            }

            // Validar Clave de Acceso
            if (!inputClave || inputClave.value.trim() === "") {
                evento.preventDefault();
                marcarError(inputClave);
                alert("El campo 'Contraseña / Clave de Acceso' es obligatorio.");
                if (inputClave) inputClave.focus();
                return false;
            }

            // Validar Selección de Rol
            if (!inputTipo || inputTipo.value === "") {
                evento.preventDefault();
                marcarError(inputTipo);
                alert("El campo 'Tipo de Rol / Permisos' es obligatorio.");
                if (inputTipo) inputTipo.focus();
                return false;
            }

            return true;
        });
    }
});

function marcarError(inputElement) {
    if (inputElement) {
        inputElement.style.borderColor = "#e74c3c"; 
        inputElement.style.backgroundColor = "#fdf2f2"; 
    }
}