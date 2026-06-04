<?php
// 1. Mandamos llamar a tu archivo de conexión exacto
require 'conexion_empleados.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Empleados - Ulises Sánchez Camarena</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5; display: flex; justify-content: center;
            align-items: flex-start; min-height: 100vh; margin: 0; padding: 40px 20px;
        }
        .tabla-contenedor {
            background-color: #ffffff; padding: 40px; border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 900px;
            overflow-x: auto; /* Para que no se rompa en celulares */
        }
        h2 { text-align: center; color: #1c1e21; margin-bottom: 30px; }
        
        /* Diseño de la tabla */
        table {
            width: 100%; border-collapse: collapse; margin-bottom: 30px;
            font-size: 15px; text-align: left;
        }
        th, td { padding: 12px 15px; border-bottom: 1px solid #dddfe2; }
        th { 
            background-color: #f8f9fa; color: #4b4f56; font-weight: 700; 
            text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px;
        }
        tr:hover { background-color: #f1f3f5; transition: background-color 0.2s; }
        
        /* Botón de regreso */
        .btn-volver {
            display: inline-block; padding: 12px 24px; background-color: #4b00e0; 
            background: linear-gradient(90deg, #4b00e0 0%, #1877f2 100%);
            color: white; text-decoration: none; border-radius: 8px; font-weight: bold; 
            transition: opacity 0.2s; text-align: center;
        }
        .btn-volver:hover { opacity: 0.9; }
        
        .credito { text-align: center; font-size: 12px; color: #8a8d91; margin-top: 30px; }
    </style>
</head>
<body>

    <div class="tabla-contenedor">
        <h2>Reporte General de Empleados</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Num.</th>
                    <th>Nombre Completo</th>
                    <th>Departamento</th>
                    <th>Categoría</th>
                    <th>Salario</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Consulta SQL usando JOIN para traer la descripción del departamento
                    $sql_reporte = "SELECT e.numero, e.nombre, d.descripcion AS nombre_depto, e.categoria, e.salario, e.sexo 
                                    FROM empleados e 
                                    LEFT JOIN departamentos d ON e.departamento = d.departamento
                                    ORDER BY e.numero ASC";
                    
                    $stmt = $conn->query($sql_reporte);
                    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Verificamos si hay registros
                    if(count($empleados) > 0) {
                        foreach ($empleados as $fila) {
                            echo "<tr>";
                            echo "<td>" . $fila['numero'] . "</td>";
                            echo "<td><strong>" . $fila['nombre'] . "</strong></td>";
                            echo "<td>" . $fila['nombre_depto'] . "</td>";
                            echo "<td>" . $fila['categoria'] . "</td>";
                            // Formateamos el salario para que se vea como dinero ($15,000.00)
                            echo "<td>$" . number_format($fila['salario'], 2) . "</td>";
                            echo "<td>" . $fila['sexo'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>No hay empleados registrados todavía.</td></tr>";
                    }
                } catch(PDOException $e) {
                    echo "<tr><td colspan='6' style='color:red; text-align:center;'>Error al cargar los datos: " . $e->getMessage() . "</td></tr>";
                }

                // Cerramos conexión
                $conn = null;
                ?>
            </tbody>
        </table>

        <div style="text-align: center;">
            <a href="alta_tabla_relacionada.php" class="btn-volver">← Registrar un Nuevo Empleado</a>
        </div>
        
        <div class="credito">Ulises Sánchez Camarena</div>
    </div>

</body>
</html>