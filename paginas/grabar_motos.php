<?php
    require_once "conexion.php";

    //Recupero los valores del formulario en variables:
    $propietario = $_POST["txt_propietario"];
    $cb_motocicletas = $_POST["cb_motocicletas"];
    $cb_modelo = $_POST["cb_modelo"];

    $sql1 = "INSERT INTO motos (propietario, tipo_moto, modelo) ";
    $sql2 = $sql1 . "VALUES ('$propietario', '$cb_motocicletas', '$cb_modelo')";

	//echo $sql2;
	//die();

    $conn->exec($sql2);
    $mensaje = "MOTO REGISTRADA SATISFACTORIAMENTE";
?>





<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Motor registrada en el sistema</title>
</head>

<body>
	
	<?php
	echo($mensaje);
	echo "<br>";
	echo "Propietario" . $propietario . "<br>";
	if ($cb_motocicletas == 'Pis') {
		$cb_motocicletas2 = "Modelo de pista";
	}
	
	echo "Tipo de moto: $cb_motocicletas2" . "<br>";	
	echo "Modelo de moto: $cb_modelo" . "<br>";	
	
	
	?>
	
</body>
</html>