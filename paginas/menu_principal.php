<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Panel de control de las tablas</title>
	<style>
        body { 
            background-color: #fdfae7; 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            padding: 40px; 
            text-align: center; 
        }
        .contenedor { 
            max-width: 900px; 
            margin: auto; 
            background: white; 
            padding: 30px; 
            border-radius: 12px; 
            border: 2px solid #000080; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }
        h1 { color: #ff0000; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        
       
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #000080; color: white; padding: 15px; }
        td { padding: 15px; border: 1px solid #ddd; font-weight: bold; }

        
        .link-manto {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            text-decoration: none; 
            color: #000080;
            border: 1px solid #000080;
            border-radius: 4px;
            transition: 0.3s;
            font-size: 0.9em;
        }
        .link-manto:hover { 
            background-color: #000080; 
            color: white; 
        }
    </style>
	
	
</head>

<body>
	<div class="contenedor">
    <h1>MANTENIMIENTO DE BASE DE DATOS</h1>
    <p>Seleccione la operación que desea realizar en el sistema de Catastro:</p>

    <table>
        <thead>
            <tr>
                <th>Módulo / Tabla</th>
                <th>Operaciones de Mantenimiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Departamentos <br></td>
                <td>
                    <a href="actualizar_departamento.php" class="link-manto">➕ Agregar departamento</a>
                    <a href="reporte_propietarios.php" class="link-manto">🔍 Consultar departamentos</a>
                    <a href="reporte_para_editar_propietario.php" class="link-manto">📝 Actualizar departamentos</a>
                    <a href="reporte_bajas_propietario.php" class="link-manto">❌ Borrar departamentos</a>
                </td>
            </tr>

            <tr>
                <td>Empleados<br></td>
                <td>
                    <a href="alta_departamentos.php" class="link-manto">➕ Agregar Empleado</a>
                    <a href="ajax_catalogo_ulises.php" class="link-manto">🔍 Consultar Empleados</a>
                    <a href="reporte_para_editar_relacionado_ulises.php" class="link-manto">📝 Actualizar Empleado</a>
                    <a href="reporte_bajas_predio.php" class="link-manto">❌ Borrar Empleado</a>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Centro Universitario de los Valles (CUVALLES) <br>
        Programación Web | Lic. en Tecnologías de la Información <br>
        <b>Desarrollado por: Ulises Sánchez Camarena</b>
    </div>
</div>
</body>
</html>