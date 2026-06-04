document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("formArticulos");

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
            alert("Ingresa el nombre del artículo.");
            e.preventDefault();
            return;
        }

        // DESCRIPCIÓN
        let descripcion = document.getElementById("descripcion");
        if (descripcion.value.trim() === "") {
            descripcion.style.border = "2px solid red";
            alert("Ingresa la descripción.");
            e.preventDefault();
            return;
        }

        // CATEGORÍA
        let categoria = document.getElementById("categoria");
        if (categoria.value === "") {
            categoria.style.border = "2px solid red";
            alert("Selecciona la categoría.");
            e.preventDefault();
            return;
        }

        // PRECIO
        let precio = document.getElementById("precio");
        if (precio.value.trim() === "") {
            precio.style.border = "2px solid red";
            alert("Ingresa el precio.");
            e.preventDefault();
            return;
        }

        // STOCK
        let stock = document.getElementById("stock");
        if (stock.value.trim() === "") {
            stock.style.border = "2px solid red";
            alert("Ingresa el stock.");
            e.preventDefault();
            return;
        }

        // CÓDIGO
        let codigo = document.getElementById("codigo");
        if (codigo.value.trim() === "") {
            codigo.style.border = "2px solid red";
            alert("Ingresa el código del artículo.");
            e.preventDefault();
            return;
        }

        // PROVEEDOR
        let proveedor = document.getElementById("proveedor");
        if (proveedor.value.trim() === "") {
            proveedor.style.border = "2px solid red";
            alert("Ingresa el proveedor.");
            e.preventDefault();
            return;
        }

        // FECHA
        let fecha = document.getElementById("fecha");
        if (fecha.value === "") {
            fecha.style.border = "2px solid red";
            alert("Selecciona la fecha de ingreso.");
            e.preventDefault();
            return;
        }

        alert("Formulario validado correctamente.");
    });

});
