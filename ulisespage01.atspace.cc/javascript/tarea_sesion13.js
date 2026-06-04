var hora = prompt("¿Qué hora es? (Solo la hora, sin minutos, entre 0 y 24)");
hora = Number(hora);

if (!isNaN(hora)) {
    if (hora >= 0 && hora <= 24) {
        if (hora > 1 && hora < 6) {
            alert("¡Buenas Madrugadas!");
        } else if (hora > 6 && hora < 12) {
            alert("Muy buenos días");
        } else if (hora === 12) {
            alert("Ya es medio día");
        } else if (hora > 12 && hora < 19) {
            alert("Muy buenas tardes");
        } else if (hora >= 19 && hora < 24) {
            alert("Buenas Noches");
        } else {
            alert("La hora ingresada no coincide con un rango de saludo específico");
        }
    } else {
        alert("Lo que escribiste sí es un número, pero favor de escribir un número entre 0 y 24");
    }
} else {
    alert("Lo que escribiste no es un número, favor de escribir un número entre 0 y 24");
}

alert("Este ejercicio se programó con JavaScript y lo codificó: Ulises Sánchez C");
