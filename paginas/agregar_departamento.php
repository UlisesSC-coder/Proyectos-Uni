<?php
// Incluimos el archivo de conexión que ya definimos
require_once 'conexion_empleados.php';

// Inicializamos una variable para mostrar mensajes de éxito o error
$mensaje = "";

// Validamos si el formulario fue enviado mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Almacenamos y limpiamos los valores recibidos
    $departamento = trim($_POST['departamento']);
    $descripcion  = trim($_POST['descripcion']);

    // Validación básica: que los campos no estén vacíos
    if (!empty($departamento) && !empty($descripcion)) {
        try {
            // Preparamos la consulta SQL para evitar inyecciones SQL
            $sql = "INSERT INTO departamentos (departamento, descripcion) VALUES (:departamento, :descripcion)";
            $stmt = $pdo->prepare($sql);
            
            // Ejecutamos pasando los parámetros
            $stmt->execute([
                ':departamento' => $departamento,
                ':descripcion'  => $descripcion
            ]);

            $mensaje = "<div class='alerta exito'>¡Departamento agregado con éxito!</div>";
        } catch (\PDOException $e) {
            // Manejo de errores (por ejemplo, si la clave del departamento ya existe)
            if ($e->getCode() == 23000) {
                $mensaje = "<div class='alerta error'>Error: El código de departamento '$departamento' ya existe.</div>";
            } else {
                $mensaje = "<div class='alerta error'>Error al guardar: " . $e->getMessage() . "</div>";
            }
        }
    } else {
        $mensaje = "<div class='alerta error'>Por favor, completa todos los campos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Departamento - Catastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .contenedor {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            border-top: 5px solid #000080; /* Azul institucional */
        }
        h2 {
            color: #000080;
            margin-top: 0;
            text-align: center;
        }
        .grupo-formulario {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .btn-guardar {
            background-color: #000080;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-guardar:hover {
            background-color: #000066;
        }
        .btn-regresar {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-regresar:hover {
            text-decoration: underline;
        }
        /* Estilos para las alertas */
        .alerta {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
        }
        .exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <div class="contenedor">
        <h2>Registar Nuevo Departamento</h2>
        
        <?php echo $mensaje; ?>

        <form action="agregar_departamento.php" method="POST">
            <div class="grupo-formulario">
                <label for="departamento">Código / Número de Departamento:</label>
                <input type="text" id="departamento" name="departamento" placeholder="Ej: 05" required maxlength="10">
            </div>

            <div class="grupo-formulario">
                <label for="descripcion">Nombre del Departamento:</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Ej: Recursos Humanos" required>
            </div>

            <button type="submit" class="btn-guardar">➕ Guardar Departamento</button>
        </form>

        <a href="index.php" class="btn-regresar">← Volver al Panel Principal</a>
    </div>

</body>
</html>