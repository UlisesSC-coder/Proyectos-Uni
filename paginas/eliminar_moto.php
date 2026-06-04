<?php
    // Insertamos el código PHP donde nos conectamos a la base de datos 
    require_once "conexion.php";
	
	// Recuperamos el valor del departamento desde la URL
	$idDepto = $_GET["id"];
	$idDepto = trim($idDepto);
	
	if($idDepto == "" || is_null($idDepto))
	{
		header("Location: reporte_borrar_departamentos.php");
		exit;
	}

    // Consultamos para mostrar qué se va a eliminar
    $sql3 = "SELECT * FROM departamentos WHERE departamento='$idDepto'";
    $result = $conn->query($sql3);
    $rows = $result->fetchAll();
	
	if(empty($rows))
	{
		header("Location: reporte_borrar_departamentos.php");
		exit;
	} else {
		foreach ($rows as $row) 
		{
			 $codigo_depto = $row['departamento'];
			 $descripcion = $row['descripcion'];
		}
		// Ejecutamos la eliminación definitiva
	    $sqlBorrar = "DELETE FROM departamentos WHERE departamento='$idDepto'";
		$conn->exec($sqlBorrar);
	}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Baja de Departamentos</title>

<style>
	body {
		background-color: slategray;
	}
	#contenedor {
		margin:auto;
		width: 960px;
		height: 100%;
	}
	#banner {
		margin:auto;
		margin-top: 10px;
		border-radius: 5px;
		background-color:burlywood;
		width: 960px;
		height: 50px;
	}
	#barra_nav {
		border-radius: 5px;
		margin-top: 5px;
		margin-left: 5px;
		margin-bottom: 10px;
		background-color:darkorange;
		width: 960px;
		position:relative;
		left:10px;
	}
	.links_nav {
		margin:auto;
		padding-left:10px;
		border-color:#000000;
		border-style: solid;
		border-width: 2px;
		border-radius: 5px;
		background-color:midnightblue;
		width: 140px;
		height: 40px;
		float:left;
		text-decoration:none;
		color:white;
	}
	.links_nav:hover {
		margin:auto;
		padding-left:10px;
		border-color:#000000;
		border-style: solid;
		border-width: 2px;
		border-radius: 5px;
		background-color:#5B2FF3;
		width: 130px;
		height: 40px;
		float:left;
		text-decoration:underline;
		color:aliceblue;
		border-right-style: solid;
		border-right-color: darkorange;
		border-right-width: 10px;
	}
	#botones_izquierda {
		border-radius: 5px;
		padding-left: 5px;
		padding-top: 2px;
		margin-top: 10px;
		background-color:cornsilk;
		width: 245px;
		height: 350px;
		float: left;
		left:5px;
		top:45px;
	}
	.links_aside {
		padding-left:10px;
		border-color:#000000;
		border-radius: 3px;
		background-color:#CFCFCF;
		width: 230px;
		height: 50px;
		float:left;
		text-decoration:none;
		border-color:#000000;
		border-style: solid;
		border-width: 1px;
	}
	.links_aside:hover {
		padding-left:10px;
		border-color:#000000;
		border-radius: 3px;
		background-color:#5B2FF3;
		width: 220px;
		height: 50px;
		float:left;
		text-decoration:underline;
		color:aliceblue;
		border-left-style: solid;
		border-left-color: navy;
		border-left-width: 10px;
	}
	#main {
		margin-top: 10px;
		border-radius: 5px;
		padding-left: 5px;
		padding-top: 2px;
		background-color:cornsilk;
		width: 690px;
		height: auto;
		float: right;
		left: 250px;
		top: 300px;
	}
	#pie_pagina {
		margin-top: 10px;
		padding-top: 10px;
		padding-left: 10px;
		padding-bottom: 20px;
		border-radius: 5px;
		background-color:#A48EED;
		font-size: 14px;
		width: 950px;
		float: right;
		left:260px;
		top:200px;
	}
    #texto1 {
        width: 95%;
        margin-left: 5px;
        margin-right: 10px;
        margin-top: 10px;
        background-color: #dbd9d3;
        padding: 5px;
        float: right;
    }
    #AddDepartamento { position: relative; right: -5px; border:3px solid #009; padding: 8px; }
    #ReporteDepartamentos { position: relative; left: 160px; border:3px solid #009; padding: 8px; }
</style>

<script>
	 function redirecciona_captura_departamentos() {
		 document.location.href = "alta_departamentos.php";
	 }
	 function redirecciona_reporte_departamentos() {
		 document.location.href = "reporte_borrar_departamentos.php";
	 }
</script>
</head>

<body>
<div id="contenedor">
	<header id="banner"> <h2>PROGRAMACIÓN WEB</h2></header>
	<nav id="barra_nav">
        <a href="index.html" class="links_nav">Inicio</a>
        <a href="#" class="links_nav">Altas</a>
        <a href="#" class="links_nav">Consultas</a>
        <a href="#" class="links_nav">Actualizaciones</a>
        <a href="#" class="links_nav">Bajas</a>
        <a href="#" class="links_nav">Salir</a>
	</nav>
	
	<aside id="botones_izquierda">
        <a href="index.html" class="links_aside">Inicio</a>
        <a href="#" class="links_aside">Altas</a>
        <a href="#" class="links_aside">Consultas</a>
        <a href="#" class="links_aside">Actualizaciones</a>
        <a href="#" class="links_aside">Bajas</a>
        <a href="http://www.google.com" class="links_aside">Salir</a>
	</aside>
	
	<section id="main">
		<br>
		<fieldset style="width: 95%;">
            <legend style="font-weight: bold;">DEPARTAMENTO ELIMINADO CORRECTAMENTE</legend>
		    <div id="texto1"><br>
                <form action="#" method="post" id="formulario1">
                    <div>
                        <br />
                        Número de Depto: 
                        <input type="text" name="txt_id" size="10" disabled value="<?php echo $codigo_depto; ?>" />
                        <br /><br />
                        Descripción: 
                        <input type="text" size="40" disabled value="<?php echo $descripcion; ?>" />
                        <br /><br />
                        <input type="button" name="AddDepartamento" id="AddDepartamento" value=" Registrar otro " onClick="redirecciona_captura_departamentos();" />
                        <input type="button" name="ReporteDepartamentos" id="ReporteDepartamentos" value=" Ver Reporte " onClick="redirecciona_reporte_departamentos();" />
                        <br />
                    </div>
                </form>
	            <br />
	        </div> 
		</fieldset>
	    <br><br>
	</section>
	
	<footer id="pie_pagina">
	    Centro Universitario de los Valles<br>
        Lic. en Tecnologías de la Información<br>
		Programación Web<br>
        ABRAHAM VEGA TAPIA<br>
	</footer>
	<?php $conn = null; ?>
</div>
</body>
</html>