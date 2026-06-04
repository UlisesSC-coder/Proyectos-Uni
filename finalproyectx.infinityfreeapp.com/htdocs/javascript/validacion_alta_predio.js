document.addEventListener("DOMContentLoaded", function() {
    const formPredio = document.getElementById("formPredio");

    if (formPredio) {
        formPredio.addEventListener("submit", function(event) {
            
            const idPropietario = document.getElementById('id_propietario').value.trim();
            const tipoPropiedad = document.getElementById('tipo_propiedad').value.trim();
            const superficieTerreno = document.getElementById('superficie_terreno').value.trim();
            const superficieConstruccion = document.getElementById('superficie_construccion').value.trim();
            const colindancias = document.getElementById('colindancias').value.trim();
            const estatus = document.getElementById('estatus').value.trim();
            const valorCastral = document.getElementById('valor_castral').value.trim();
            const ubicacionDomicilio = document.getElementById('ubicacion_domicilio').value.trim();

            // Verificar que no haya campos vacíos
            if (idPropietario === "" || tipoPropiedad === "" || superficieTerreno === "" ||
                superficieConstruccion === "" || colindancias === "" || estatus === "" ||
                valorCastral === "" || ubicacionDomicilio === "") {
                
                alert("Por favor, completa todos los campos obligatorios.");
                event.preventDefault(); // Detiene el envío del formulario
                return false;
            }

            // Validar que los campos de superficie y valor sean números válidos
            if (isNaN(superficieTerreno) || isNaN(superficieConstruccion) || isNaN(valorCastral)) {
                alert("Las superficies y el valor catastral deben ser valores numéricos válidos.");
                event.preventDefault();
                return false;
            }
        });
    }
});