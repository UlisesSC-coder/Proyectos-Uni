document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("formVendedores");

    form.addEventListener("submit", function(e) {

        // Reiniciar bordes
        let campos = form.querySelectorAll("input");
        campos.forEach(c => {
            c.style.border = "1px solid #ccc";
            c.style.outline = "none";
        });

        // VALIDAR NOMBRE
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

        // RFC
        let rfc = document.getElementById("rfc");
        if (rfc.value.trim() === "") {
            rfc.style.border = "2px solid red";
            alert("Ingresa el RFC.");
            e.preventDefault();
            return;
        }

        // ZONA
        let zona = document.getElementById("zona");
        if (zona.value.trim() === "") {
            zona.style.border = "2px solid red";
            alert("Ingresa la zona asignada.");
            e.preventDefault();
            return;
        }

        // EXPERIENCIA
        let exp = document.getElementById("experiencia");
        if (exp.value.trim() === "" || exp.value < 0) {
            exp.style.border = "2px solid red";
            alert("Ingresa los años de experiencia.");
            e.preventDefault();
            return;
        }

        // TIPO (RADIO)
        let tipo = document.querySelector("input[name='tipo']:checked");
        if (!tipo) {
            let radios = document.querySelectorAll("input[name='tipo']");
            radios.forEach(r => r.style.outline = "2px solid red");
            alert("Selecciona el tipo de vendedor.");
            e.preventDefault();
            return;
        }

        alert("Formulario validado correctamente.");
    });

});
