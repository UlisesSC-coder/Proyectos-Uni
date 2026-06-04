<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<?php
	
	//Declarar Variables
	$operador1 = 58;
	$operador2 = 42;
	
	//Realizar operaciones basicas
	$suma = $operador1 + $operador2;
	$resta = $operador1 - $operador2;
	$multiplicacion = $operador1 * $operador2;
	$division = $operador1 / $operador2; 
	
	//Mostrar resultados
	echo "<h4>" . " La suma de esos 2 número es: " . ($operador1 + $operador2) . "</h4><br /><br />"; 
	echo "<h4>" . " La resta de esos 2 número es: " . ($operador1 - $operador2) . "</h4><br /><br />";
	echo "<h4>" . " La multiplicacion de esos 2 número es: " . ($operador1 * $operador2) . "</h4><br /><br />";
	echo "<h4>" . " La division de esos 2 número es: " . ($operador1 / $operador2) . "</h4><br /><br />";
	
	//Agregar Variable de mi Nombre
	$miNombre = "Ulises";
		
	//Mostras funciones de texto
	echo "Mi nombre tiene: " . strlen($miNombre) . " caracteres";
	  echo "<br>";
	echo "Mi nombre tiene: " . str_word_count($miNombre) . " palabras";
	  echo "<br>";
	echo "Mi nombre en sentido inverso se escribe asi: " . strrev($miNombre);
	  echo "<br>";
	
	// Buscamos la "s" dentro de la variable
	$posicion = strpos($miNombre, "s");
	echo "La letra 's' está en la posición: " . $posicion;
	  echo "<br>";
	
	//Cambiar e en mi nombre
	$nuevoNombre = str_replace("e", "3", $miNombre);
	echo "Mi nombre con la letra e remplazada por el 3 queda asi: " . $nuevoNombre;
	  echo "<br>";
	 echo "<br>";
	
	echo "<h1> Fecha </h1>";
	//Texto dinamico fecha y hora
	echo "La fecha actual es: " . date("d/m/Y");
    echo "<br>"; 
	date_default_timezone_set('America/Mexico_City');
    echo "La hora actual es: " . date("H:i:s");
	
	?>
</body>
</html>