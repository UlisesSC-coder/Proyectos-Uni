<?php
  //Recuperamos los valores de variables de página previa
  //mediante variables SUPERGLOBALES de PHP
  // Se recuperan con $_GET["  "]; si viene el valor desde 1 LINK

     $NumeroEmpleado = $_GET["idempleado"];
	 //$NombreEmpleado = $_GET["nombre"];
	
  if ($NumeroEmpleado == "") {
	    $NumeroEmpleado = "No se hizo clic en la liga del NUMERO";
	  }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Regitro de empleados desde PHP hacia MySQL</title>

<style type="text/css" media="screen">

body { background-color:#999;}

#wrapper {
	margin: auto;
	width: 960px;
	height: 410px;
	background-color: #CCC;
	}
	
#caja1 {
	width: 300px;
	height: 50px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja2 {
	width: 300px;
	height: 50px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja3 {
	width: 300px;
	height: 50px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 10px;
	background-color: #FFC;
	float: left;
}

#caja4 {
	width: 940px;
	height: 310px;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 40px;
	background-color: #333;
	clear: both;
		 
	position: relative;
	top: 10px;
	}
	
#imagen1 { position:relative; top:10px; right:-10px; }

#texto1 {
	width: 500px;
	height: 280px;
	margin-left: 5px;
	margin-right: 10px;
	margin-top: 10px;
	background-color:rgba(180,185,245,1.00);
	padding: 5px;
	float: right;
	right: -10px;
	top: 10px;
	}
	
#AddEmpleado{ 
    position: absolute;
    right: 30px;
    border:3px solid #009;
    padding: 10px;
	top: 245px;
}

</style>

</head>

<body>

<div id="wrapper">

   <div id="caja1">Licenciatura en Tecnologías de la Información</div>
   <div id="caja2">Programación web</div>
   <div id="caja3">Formulario para la PRACTICA DE GET</div>
 
   <div id="caja4">
     <div id="texto1"><br />
 
        <fieldset style="width: 95%; 
                  font-weight: bold; height:85%;">
                  
        <legend>INFORMACION RECUPERADA CON GET
        </legend>
	  <?php
	      echo "<br>";
		  echo "<br>";
          echo "Número de empleado: " . $NumeroEmpleado . "<br><br>";
		  //echo "Nombre de empleado: " . $NombreEmpleado . "<br><br>";
      ?>      
        </fieldset> 
     </div>
  </div>
</div>
</body>
</html>