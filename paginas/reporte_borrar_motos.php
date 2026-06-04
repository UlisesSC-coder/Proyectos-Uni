<?php
    require_once "conexion.php";
    // Consulta a la tabla exacta de la imagen: departamentos
    $sql = 'SELECT * FROM departamentos';
    $result = $conn->query($sql);
    $rows = $result->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Reporte de Departamentos</title>

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
    .encabezado_tabla_reporte {
        background-color:#282830; 
        color:#FFFFFF;
    }
    #eliminar { background-color:#b57cf5; border-color:#000000; }
    #eliminar:hover { background-color:pink; border-color:blue; }
    #editar { background-color:#4c89d6; color:#ffffff; border-color:#000000; }
</style>

<script>
function borrar_depto(id)
{
    if(confirm("¿Estás seguro de eliminar el departamento: " + id + "?") == true)
        { return true; } else { return false; }
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
            <legend style="font-weight: bold;">SELECCIONA UN DEPARTAMENTO PARA ELIMINAR</legend>
		    <div id="texto1"><br>
                <table border="1" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="encabezado_tabla_reporte">ID Depto</th>
                            <th class="encabezado_tabla_reporte">Descripción</th>
                            <th class="encabezado_tabla_reporte">ELIMINAR</th>
                            <th class="encabezado_tabla_reporte">EDITAR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td><?php echo $row['departamento']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td id="eliminar">
                                <a onClick="return borrar_depto('<?php echo $row['departamento']; ?>');" 
                                   href="eliminar_departamento.php?id=<?php echo $row['departamento']; ?>">
                                   eliminar
                                </a>
                            </td>
                            <td id="editar">
                                <a href="editar_departamento.php?id=<?php echo $row['departamento']; ?>">
                                     editar
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                        <tr>
                             <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                             <td colspan="4"><a href="alta_departamentos.php">Agregar otro Departamento</a></td>
                        </tr>   
                    </tbody>
                </table>
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