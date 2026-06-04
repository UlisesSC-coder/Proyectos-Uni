document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("formClientes");

    form.addEventListener("submit", function(e) {

        // Reiniciar bordes
        let campos = form.querySelectorAll("input, select");
        campos.forEach(c => {
            c.style.border = "1px solid #ccc";
            c.style.outline = "none";
        });

        // NOMBRE
        let nombre = document.getElementById("nombre");
        if (nombre.value.trim() === "") {
            nombre.style.border = "2px solid red";
            alert("Ingresa el nombre.");
            e.preventDefault();
            return;
        }

        // PATERNO
        let paterno = document.getElementById("paterno");
        if (paterno.value.trim() === "") {
            paterno.style.border = "2px solid red";
            alert("Ingresa el apellido paterno.");
            e.preventDefault();
            return;
        }

        // MATERNO
        let materno = document.getElementById("materno");
        if (materno.value.trim() === "") {
            materno.style.border = "2px solid red";
            alert("Ingresa el apellido materno.");
            e.preventDefault();
            return;
        }

        // TELÉFONO
        let telefono = document.getElementById("telefono");
        if (telefono.value.trim() === "") {
            telefono.style.border = "2px solid red";
            alert("Ingresa el teléfono.");
            e.preventDefault();
            return;
        }

        // CORREO
        let correo = document.getElementById("correo");
        if (correo.value.trim() === "") {
            correo.style.border = "2px solid red";
            alert("Ingresa el correo.");
            e.preventDefault();
            return;
        }

        // DIRECCIÓN
        let direccion = document.getElementById("direccion");
        if (direccion.value.trim() === "") {
            direccion.style.border = "2px solid red";
            alert("Ingresa la dirección.");
            e.preventDefault();
            return;
        }

        // TIPO DE CLIENTE
        let tipoCliente = document.getElementById("tipoCliente");
        if (tipoCliente.value === "") {
            tipoCliente.style.border = "2px solid red";
            alert("Selecciona el tipo de cliente.");
            e.preventDefault();
            return;
        }

        // MÉTODO DE CONTACTO
        let contacto = document.querySelector("input[name='contacto']:checked");
        if (!contacto) {
            let radios = document.querySelectorAll("input[name='contacto']");
            radios.forEach(r => r.style.outline = "2px solid red");
            alert("Selecciona el método de contacto preferido.");
            e.preventDefault();
            return;
        }

        alert("Formulario validado correctamente.");
    });

});


