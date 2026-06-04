// JavaScript Document

let esEstudiante = confirm("¿Eres estudiante de CUValles?");

if (esEstudiante) {
  let respuesta = prompt("¿Estudias Tecnologías de la Información?\nContesta con un SI o con un NO");

  if (respuesta === "SI" || respuesta === "si" || respuesta === "Si") {
    alert("Felicidades, estás en la mejor carrera");
  } 
  else if (respuesta === "NO" || respuesta === "no" || respuesta === "No") {
    alert("Uy, te recomiendo que estudies Tecnologías");
  } 
  else {
    alert("No hiciste caso de contestar con un SI o NO, LEA bien");
  }

  alert("Este juego lo programó: Ulises Sánchez C");

} else {
  alert("Usted entonces no es alumno de CUValles, buuuuu!!!!");
  alert("Este juego lo programó: Ulises Sánchez C");
}
