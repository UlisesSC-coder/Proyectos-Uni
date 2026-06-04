<?php
    // Recuperamos el código PHP donde *** nos conectamos *** a la base de datos 
    require_once "conexion_hosting_ulises.php";
	
    // Establecemos los valores que serán INSERTADOS en la Tabla de la Base de Datos
    $nombre = "Ulises";
    $apellido_paterno = "Sánchez";
    $apellido_materno = "Camarena";
   // $rfc = ;
   // $fecha_registro = ;
   // $curp = ;
   // $domicilio = ;
   // $telefono = ;
   // $correo_electronico = ;
   // $fecha_nacimiento = ; 

    // Escribimos la sentencia para INSERTAR LOS DATOS EN LA TABLA de Propietarios (PDO)
    // Concatenando 2 strings armamos la sentencia INSERT INTO ************************
	
    $sqlINSERT1 = "INSERT INTO Propietarios(nombre, apellido_paterno, apellido_materno, rfc, fecha_registro, curp, domicilio, telefono, correo_electronico, fecha_nacimiento) ";
    $sqlINSERT2 = $sqlINSERT1 . "VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$rfc', '$fecha_registro', '$curp', '$domicilio', '$telefono', '$correo_electronico', '$fecha_nacimiento')";
    
	// Ejecutamos la sentencia INSERT de SQL a partir de la conexión usando PDO 
	// mediante la propiedad "EXEC" de la linea de conexión ***************************
	
    $conn->exec($sqlINSERT2);
		
	$mensaje = "DEPARTAMENTO REGISTRADO SATISFACTORIAMENTE";
	
	//Cerramos la conexion a la base de datos y liberamos recursos en el server *******
	$conn = null;
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Regitro de departamentos desde PHP hacia MySQL</title>
</head>

<body>

<div id="wrapper">

     <fieldset style="width: 97%;">
         <legend><?php echo $mensaje; ?></legend>
             <div>
                <br>
                    <b>Nombre:</b> <?php echo ($nombre); ?>
                <br>
			    <br>
                    <b>Apellido Paterno:</b> <?php echo ($apellido_paterno); ?>
                <br>
				 	<b>Apellido Materno:</b> <?php echo ($apellido_materno); ?>
                <br>
			    <br>
                    <a target="_blank" href="http://localhost/phpmyadmin">Revisa este registro en MySQL</a>
				<br>
				<br>
					<?php echo "Se ejecutó la sentencia <b>SQL</b>: $sqlINSERT2"; ?>
             </div>
      </fieldset> 

</div>
</body>
</html>