document.addEventListener("DOMContentLoaded", function() {
    const inputBuscar = document.getElementById("input_buscar");
    const contenedor = document.getElementById("resultado_busqueda");

    if (inputBuscar) {
        inputBuscar.addEventListener("keyup", function() {
            const valor = this.value;

            if (valor.trim() === "") {
                contenedor.innerHTML = '<tr><td colspan="9" class="td-empty">Escribe en la barra para buscar un predio...</td></tr>';
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("GET", "procesar_buscar_predio.php?q=" + encodeURIComponent(valor), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    contenedor.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    }
});