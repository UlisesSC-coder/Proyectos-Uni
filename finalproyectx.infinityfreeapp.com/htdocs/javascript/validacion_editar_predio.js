document.addEventListener("DOMContentLoaded", function() {
    const botonesEditar = document.querySelectorAll('.btn-editar-predio');
    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function() {
            const clave = this.getAttribute('data-clave');
            confirmarEdicionPredio(clave);
        });
    });

    const formulario = document.getElementById("formEditarPredio");
    if (formulario) {
        formulario.addEventListener("submit", function(evento) {
            if (!validarEditarPredio(evento)) {
                evento.preventDefault();
            }
        });
    }
});

function confirmarEdicionPredio(clave) {
    if (confirm("¿Estás seguro de que deseas editar la Ficha Catastral con la Clave #" + clave + "?")) {
        window.location.href = "formulario_editar_predio.php?clave=" + clave;
    }
}

function validarEditarPredio(evento) {
    const idProp = document.getElementById("id_propietario") || document.querySelector("[name='id_propietario']");
    const tipo = document.getElementById("tipo_propiedad") || document.querySelector("[name='tipo_propiedad']");
    const estatus = document.getElementById("estatus") || document.querySelector("[name='estatus']");
    const terreno = document.getElementById("superficie_terreno") || document.querySelector("[name='superficie_terreno']");
    const construccion = document.getElementById("superficie_construccion") || document.querySelector("[name='superficie_construccion']");
    const valor = document.getElementById("valor_castral") || document.querySelector("[name='valor_castral']");
    const colindancias = document.getElementById("colindancias") || document.querySelector("[name='colindancias']");
    const ubicacion = document.getElementById("ubicacion_domicilio") || document.querySelector("[name='ubicacion_domicilio']");

    const todosLosCampos = [idProp, tipo, estatus, terreno, construccion, valor, colindancias, ubicacion];
    todosLosCampos.forEach(c => {
        if (c) { 
            c.classList.remove("input-error-validar");
        }
    });

    if (!idProp || idProp.value === "" || parseInt(idProp.value) <= 0) {
        evento.preventDefault(); marcarError(idProp); alert("Error: Debe seleccionar un ID de Propietario válido."); idProp.focus(); return false;
    }

    if (!tipo || tipo.value.trim() === "") {
        evento.preventDefault(); marcarError(tipo); alert("Error: El campo 'Tipo de Propiedad' es obligatorio."); tipo.focus(); return false;
    }

    if (!estatus || estatus.value.trim() === "") {
        evento.preventDefault(); marcarError(estatus); alert("Error: El campo 'Estatus' es obligatorio."); estatus.focus(); return false;
    }

    if (!terreno || terreno.value.toString().trim() === "") {
        evento.preventDefault(); marcarError(terreno); alert("Error: La Superficie del Terreno es obligatoria."); terreno.focus(); return false;
    }
    if (isNaN(terreno.value) || parseFloat(terreno.value) <= 0) {
        evento.preventDefault(); marcarError(terreno); alert("Error: La Superficie del Terreno debe ser un número positivo mayor a 0."); terreno.focus(); return false;
    }

    if (!construccion || construccion.value === null || construccion.value.toString().trim() === "") {
        evento.preventDefault(); marcarError(construccion); alert("Error: El campo 'Superficie Construcción' es totalmente obligatorio.\nSi el lote es baldío o no tiene metros construidos, debes escribir el número 0."); 
        construccion.focus(); return false;
    }
    if (isNaN(construccion.value) || parseFloat(construccion.value) < 0) {
        evento.preventDefault(); marcarError(construccion); alert("Error: La Superficie de Construcción no puede ser un número negativo."); 
        construccion.focus(); return false;
    }

    if (!valor || valor.value.toString().trim() === "") {
        evento.preventDefault(); marcarError(valor); alert("Error: El Valor Catastral es obligatorio."); valor.focus(); return false;
    }
    if (isNaN(valor.value) || parseFloat(valor.value) <= 0) {
        evento.preventDefault(); marcarError(valor); alert("Error: El Valor Catastral debe ser una cifra numérica mayor a 0."); valor.focus(); return false;
    }

    if (!colindancias || colindancias.value === null || colindancias.value.toString().trim() === "") {
        evento.preventDefault(); marcarError(colindancias); alert("Error: El campo 'Colindancias' es obligatorio.\nPor favor detalla las medidas perimetrales antes de guardar."); 
        colindancias.focus(); return false;
    }
    if (colindancias.value.toString().trim().length < 3) {
        evento.preventDefault(); marcarError(colindancias); alert("Error: El campo Colindancias es demasiado corto (mínimo 3 caracteres)."); 
        colindancias.focus(); return false;
    }

    if (!ubicacion || ubicacion.value.trim() === "") {
        evento.preventDefault(); marcarError(ubicacion); alert("Error: El campo 'Ubicación / Domicilio del Predio' es obligatorio."); ubicacion.focus(); return false;
    }

    return true;
}

function marcarError(elem) {
    if (elem) { 
        elem.classList.add("input-error-validar");
    }
}