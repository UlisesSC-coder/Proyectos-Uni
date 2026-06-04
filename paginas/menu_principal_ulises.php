<?php
// Paso 4: Agregar código de PHP para verificar que la SESION de nombre "validado" tenga asignado el valor a "true"
session_start(); 

if (!isset($_SESSION["validado"]) || $_SESSION["validado"] !== "true") {
    // Si no viene con el valor en true, redireccionar a la página de login en la raíz
    header("Location: ../login_ulises.php");
    exit; 
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de control de las tablas</title>
	<style>
        body { 
            background-color: #f0f4f8; /* Un tono gris/azul moderno y sutil */
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            padding: 40px 20px; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .contenedor { 
            width: 100%;
            max-width: 900px; 
            margin: auto; 
            background: white; 
            padding: 40px 30px; 
            border-radius: 12px; 
            border-top: 5px solid #000080; /* Línea de color institucional arriba */
            box-shadow: 0 10px 25px rgba(0,0,0,0.08); 
        }
        h1 { 
            color: #000080; /* Cambiado a azul institucional para que combine mejor */
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        p {
            color: #555;
            margin-bottom: 30px;
            font-size: 1.05rem;
        }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        th { background-color: #000080; color: white; padding: 15px; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 15px; border: 1px solid #e2e8f0; font-weight: bold; color: #2d3748; }
        tr:nth-child(even) { background-color: #f8fafc; } /* Fila cebrada para legibilidad */

        .link-manto {
            display: inline-block;
            padding: 8px 14px;
            margin: 4px;
            text-decoration: none; 
            color: #000080;
            border: 1px solid #000080;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.85em;
            font-weight: 600;
        }
        .link-manto:hover { 
            background-color: #000080; 
            color: white; 
        }

        /* Estilo para la sección de salida */
        .logout-container {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 2px solid #edf2f7;
        }
        .btn-logout {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            font-weight: bold;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: background 0.3s;
            box-shadow: 0 4px 6px rgba(231, 76, 60, 0.2);
        }
        .btn-logout:hover {
            background-color: #c0392b;
        }

        .footer {
            margin-top: 40px;
            font-size: 0.85rem;
            color: #718096;
            line-height: 1.6;
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
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
                    <th style="width: 25%;">Módulo / Tabla</th>
                    <th style="width: 75%;">Operaciones de Mantenimiento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Propietarios</td>
                    <td>
                        <a href="alta_tabla1_ulises.php" class="link-manto">➕ Agregar propietarios</a>
                        <a href="reporte_propietarios.php" class="link-manto">🔍 Consultar propietarios</a>
                        <a href="reporte_para_editar_catalogo_ulises.php" class="link-manto">📝 Actualizar propietarios</a>
                        <a href="reporte_para_borrar_catalogo_ulises.php" class="link-manto">❌ Borrar propietarios</a>
                    </td>
                </tr>

                <tr>
                    <td>Predios</td>
                    <td>
                        <a href="alta_tabla_Ulises.php" class="link-manto">➕ Agregar predios</a>
                        <a href="reporte_predios.php" class="link-manto">🔍 Consultar predios</a>
                        <a href="reporte_para_editar_relacionado_ulises.php" class="link-manto">📝 Actualizar predios</a>
                        <a href="reporte_para_borrar_ulises.php" class="link-manto">❌ Borrar predios</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="logout-container">
            <a href="../login_ulises.php" class="btn-logout">CERRAR SESION</a>
        </div>

        <div class="footer">
            Centro Universitario de los Valles (CUVALLES) <br>
            Programación Web | Lic. en Tecnologías de la Información <br>
            <b>Desarrollado por: Ulises Sánchez Camarena</b>
        </div>
    </div>
</body>
</html>