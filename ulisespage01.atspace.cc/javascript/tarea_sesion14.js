document.addEventListener("DOMContentLoaded", () => {
	document.getElementById("link1").addEventListener("mouseover", cambia_imagen1);
	document.getElementById("link1").addEventListener("mouseout", cambia_imagen4);

	document.getElementById("link2").addEventListener("mouseover", cambia_imagen2);
	document.getElementById("link2").addEventListener("mouseout", cambia_imagen4);

	document.getElementById("link3").addEventListener("mouseover", cambia_imagen3);
	document.getElementById("link3").addEventListener("mouseout", cambia_imagen4);
});

function cambia_imagen1() {
	const img = document.getElementById("imagen1");
	img.style.display = "block";
	img.classList.add("mostrar");
}

function cambia_imagen2() {
	const img = document.getElementById("imagen2");
	img.style.display = "block";
	img.classList.add("mostrar");
}

function cambia_imagen3() {
	const img = document.getElementById("imagen3");
	img.style.display = "block";
	img.classList.add("mostrar");
}

function cambia_imagen4() {
	const imagenes = document.querySelectorAll("img");
	imagenes.forEach(img => {
		img.classList.remove("mostrar");
		img.style.display = "none";
	});
}

