document.addEventListener("DOMContentLoaded", function() {
    // 1. Manejo delegativo para las redirecciones con confirmación desde listados externos
    const botonesEditar = document.querySelectorAll('.btn-editar-prop');
    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            confirmarEdicion(id);
        });
    });

    // 2. Interceptor nativo para la validación del formulario actual
    const formulario = document.getElementById("formEditarProp");
    if (formulario) {
        formulario.addEventListener("submit", function(evento) {
            if (!validarEditarPropietario(evento)) {
                evento.preventDefault(); // Cancela la acción del envío si falla
            }
        });
    }
});

function confirmarEdicion(id) {
    if (confirm("¿Estás seguro de que deseas editar al propietario con ID #" + id + "?")) {
        window.location.href = "formulario_editar_propietario.php?id=" + id;
    }
}

function validarEditarPropietario(evento) {
    // Captura de TODOS los elementos del formulario
    const nombre = document.getElementById("nombre");
    const paterno = document.getElementById("apellido_paterno");
    const materno = document.getElementById("apellido_materno");
    const rfc = document.getElementById("rfc");
    const curp = document.getElementById("curp");
    const telefono = document.getElementById("telefono");
    const correo = document.getElementById("correo_electronico");
    const domicilio = document.getElementById("domicilio");
    const nacimiento = document.getElementById("fecha_nacimiento");

    // Limpieza previa de errores visuales en TODOS los campos
    const todosLosCampos = [nombre, paterno, materno, rfc, curp, telefono, correo, domicilio, nacimiento];
    todosLosCampos.forEach(c => {
        if (c) c.classList.remove("input-error-validar");
    });

    // 1. Validación: Nombre
    if (!nombre || nombre.value.trim() === "") {
        marcarError(nombre);
        alert("Error: El campo 'Nombre' es obligatorio.");
        nombre.focus();
        return false;
    }

    // 2. Validación: Apellido Paterno
    if (!paterno || paterno.value.trim() === "") {
        marcarError(paterno);
        alert("Error: El campo 'Apellido Paterno' es obligatorio.");
        paterno.focus();
        return false;
    }

    // 3. Validación: Apellido Materno (Añadido)
    if (!materno || materno.value.trim() === "") {
        marcarError(materno);
        alert("Error: El campo 'Apellido Materno' es obligatorio.");
        materno.focus();
        return false;
    }

    // 4. Validación: RFC
    if (!rfc || rfc.value.trim() === "") {
        marcarError(rfc);
        alert("Error: El campo 'RFC' es obligatorio.");
        rfc.focus();
        return false;
    }

    // 5. Validación: CURP (Añadido)
    if (!curp || curp.value.trim() === "") {
        marcarError(curp);
        alert("Error: El campo 'CURP' es obligatorio.");
        curp.focus();
        return false;
    }

    // 6. Validación: Teléfono (Añadido)
    if (!telefono || telefono.value.trim() === "") {
        marcarError(telefono);
        alert("Error: El campo 'Teléfono' es obligatorio.");
        telefono.focus();
        return false;
    }

    // 7. Validación: Correo Electrónico (Ahora Obligatorio)
    if (!correo || correo.value.trim() === "") {
        marcarError(correo);
        alert("Error: El campo 'Correo Electrónico' es obligatorio.");
        correo.focus();
        return false;
    } else {
        // Valida que el correo tenga una estructura correcta ya que no está vacío
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexCorreo.test(correo.value.trim())) {
            marcarError(correo);
            alert("Error: La estructura del 'Correo Electrónico' no es válida (ejemplo: usuario@dominio.com).");
            correo.focus();
            return false;
        }
    }

    // 8. Validación: Domicilio Particular (Añadido)
    if (!domicilio || domicilio.value.trim() === "") {
        marcarError(domicilio);
        alert("Error: El campo 'Domicilio Particular' es obligatorio.");
        domicilio.focus();
        return false;
    }

    // 9. Validación: Fecha de Nacimiento
    if (!nacimiento || nacimiento.value === "") {
        marcarError(nacimiento);
        alert("Error: El campo 'Fecha de Nacimiento' es obligatorio.");
        nacimiento.focus();
        return false;
    }

    return true; // Si pasa todas las condiciones, se envía el formulario
}

function marcarError(elem) {
    if (elem) { 
        elem.classList.add("input-error-validar");
    }
}