document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.getElementById("formPropietario");

    if (formulario) {
        formulario.addEventListener("submit", function(evento) {
            
            const inputNombre = document.getElementById("nombre");
            const inputApPaterno = document.getElementById("apellido_paterno");
            const inputApMaterno = document.getElementById("apellido_materno");
            const inputFechaNac = document.getElementById("fecha_nacimiento");
            const inputRFC = document.getElementById("rfc");
            const inputCURP = document.getElementById("curp");
            const inputTelefono = document.getElementById("telefono");
            const inputCorreo = document.getElementById("correo_electronico");
            const inputDomicilio = document.getElementById("domicilio");

            // --- VALIDACIÓN DE CAMPOS EN BLANCO (TODOS OBLIGATORIOS) ---

            if (!inputNombre || inputNombre.value.trim() === "") {
                return lanzarAlert(evento, inputNombre, "ERROR: El campo 'Nombre(s)' está vacío y es estrictamente obligatorio.");
            }

            if (!inputApPaterno || inputApPaterno.value.trim() === "") {
                return lanzarAlert(evento, inputApPaterno, "ERROR: El campo 'Apellido Paterno' está vacío y es estrictamente obligatorio.");
            }

            if (!inputApMaterno || inputApMaterno.value.trim() === "") {
                return lanzarAlert(evento, inputApMaterno, "ERROR: El campo 'Apellido Materno' está vacío y es estrictamente obligatorio.");
            }

            if (!inputFechaNac || inputFechaNac.value.trim() === "") {
                return lanzarAlert(evento, inputFechaNac, "ERROR: La 'Fecha de Nacimiento' está vacía y es estrictamente obligatoria.");
            }

            if (!inputRFC || inputRFC.value.trim() === "") {
                return lanzarAlert(evento, inputRFC, "ERROR: El campo 'RFC' está vacío y es estrictamente obligatorio.");
            }

            if (!inputCURP || inputCURP.value.trim() === "") {
                return lanzarAlert(evento, inputCURP, "ERROR: El campo 'CURP' está vacío y es estrictamente obligatorio.");
            }

            if (!inputTelefono || inputTelefono.value.trim() === "") {
                return lanzarAlert(evento, inputTelefono, "ERROR: El campo 'Teléfono' está vacío y es estrictamente obligatorio.");
            }

            if (!inputCorreo || inputCorreo.value.trim() === "") {
                return lanzarAlert(evento, inputCorreo, "ERROR: El campo 'Correo Electrónico' está vacío y es estrictamente obligatorio.");
            }

            if (!inputDomicilio || inputDomicilio.value.trim() === "") {
                return lanzarAlert(evento, inputDomicilio, "ERROR: El campo 'Domicilio Particular' está vacío y es estrictamente obligatorio.");
            }


            // --- VALIDACIÓN DE FORMATOS Y ESTRUCTURAS ---

            const regexTexto = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

            if (!regexTexto.test(inputNombre.value.trim())) {
                return lanzarAlert(evento, inputNombre, "FORMATO INVÁLIDO: El campo 'Nombre(s)' sólo puede contener letras.");
            }

            if (!regexTexto.test(inputApPaterno.value.trim())) {
                return lanzarAlert(evento, inputApPaterno, "FORMATO INVÁLIDO: El campo 'Apellido Paterno' sólo puede contener letras.");
            }

            if (!regexTexto.test(inputApMaterno.value.trim())) {
                return lanzarAlert(evento, inputApMaterno, "FORMATO INVÁLIDO: El campo 'Apellido Materno' sólo puede contener letras.");
            }

            // Validar coherencia de año
            const anio = new Date(inputFechaNac.value).getFullYear();
            if (anio < 1900 || anio > 2026) {
                return lanzarAlert(evento, inputFechaNac, "FECHA INVÁLIDA: Por favor ingrese un año de nacimiento real.");
            }

            // Formatear y validar RFC
            const valorRFC = inputRFC.value.trim().toUpperCase();
            inputRFC.value = valorRFC;
            const regexRFC = /^[A-Z&Ñ]{4}[0-9]{6}[A-Z0-9]{3}$/;
            if (!regexRFC.test(valorRFC)) {
                return lanzarAlert(evento, inputRFC, "FORMATO INVÁLIDO: El RFC debe tener una estructura oficial de exactamente 13 caracteres.");
            }

            // Formatear y validar CURP
            const valorCURP = inputCURP.value.trim().toUpperCase();
            inputCURP.value = valorCURP;
            const regexCURP = /^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9]{2}$/;
            if (!regexCURP.test(valorCURP)) {
                return lanzarAlert(evento, inputCURP, "FORMATO INVÁLIDO: La CURP no cumple con la estructura oficial válida de 18 caracteres.");
            }

            // Validar Teléfono (10 números)
            const valorTelefono = inputTelefono.value.trim();
            const regexTel = /^[0-9]{10}$/;
            if (!regexTel.test(valorTelefono)) {
                return lanzarAlert(evento, inputTelefono, "FORMATO INVÁLIDO: El Teléfono debe contener exactamente 10 dígitos numéricos sin espacios.");
            }

            // Validar Email
            const valorCorreo = inputCorreo.value.trim();
            const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexCorreo.test(valorCorreo)) {
                return lanzarAlert(evento, inputCorreo, "FORMATO INVÁLIDO: Por favor escriba un correo electrónico real (Ejemplo: titular@dominio.com).");
            }

            if (inputDomicilio.value.trim().length < 8) {
                return lanzarAlert(evento, inputDomicilio, "DIRECCIÓN INCOMPLETA: Por favor especifique una dirección de domicilio más descriptiva.");
            }

            // Si pasa todo sin romperse, se procesa el envío al PHP
            return true;
        });
    }
});

function lanzarAlert(evento, elemento, mensaje) {
    evento.preventDefault(); // Mata físicamente la acción de enviar los datos al servidor
    if (elemento) {
        elemento.style.borderColor = "#e74c3c";
        elemento.style.backgroundColor = "#fdf2f2";
        elemento.focus();
    }
    alert(mensaje); // Lanza la ventana emergente nativa del navegador
    return false;
}