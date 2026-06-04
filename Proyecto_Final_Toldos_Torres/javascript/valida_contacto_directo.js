document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("formContacto");

    form.addEventListener("submit", function(e) {

        // Reiniciar bordes normales
        let todos = form.querySelectorAll("input, select");
        todos.forEach(campo => {
            campo.style.border = "1px solid #ccc";
            campo.style.outline = "none";
        });

        // VALIDAR NOMBRE
        let nombre = document.getElementById("nombre");
        if (nombre.value.trim() === "") {
            nombre.style.border = "2px solid red";
            alert("Por favor ingresa tu nombre completo.");
            e.preventDefault();
            return;
        }

        // VALIDAR SEXO
        let sexo = document.querySelector("input[name='sexo']:checked");
        if (!sexo) {
            let radios = document.querySelectorAll("input[name='sexo']");
            radios.forEach(r => r.style.outline = "2px solid red");
            alert("Selecciona tu sexo.");
            e.preventDefault();
            return;
        }

        // VALIDAR EDAD
        let edad = document.getElementById("edad");
        if (edad.value === "") {
            edad.style.border = "2px solid red";
            alert("Selecciona tu edad.");
            e.preventDefault();
            return;
        }

        // VALIDAR PREFERENCIAS
        let preferencias = document.querySelectorAll("input[name='preferencias']:checked");
        if (preferencias.length === 0) {
            let checks = document.querySelectorAll("input[name='preferencias']");
            checks.forEach(c => c.style.outline = "2px solid red");
            alert("Selecciona al menos una preferencia.");
            e.preventDefault();
            return;
        }

        // SI TODO ESTÁ CORRECTO
        alert("Formulario validado correctamente.");
    });

});



