<?php
// Paso 2: Destruir o limpiar las SESIONES de este sitio web inmediatamente
session_start();
session_unset();     
session_destroy();   
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ulises Sánchez</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        form {
            border: 3px solid #f1f1f1;
            background-color: #ffffff;
            width: 100%;
            max-width: 420px;
            margin: 60px auto;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 25%;
            border-radius: 50%;
        }

        .container {
            padding: 20px;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            transition: opacity 0.2s;
        }

        button[type=submit]:hover {
            opacity: 0.9;
        }

        .container-footer {
            padding: 16px;
            background-color: #f1f1f1;
            border-top: 1px solid #e3e3e3;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }
    </style>

    <script>
        // Validación con JavaScript obligatoria para las dos cajas de texto
        function validarFormulario() {
            let txtUser = document.getElementById("user").value;
            let txtPass = document.getElementById("pass").value;

            if (txtUser.trim() === "") {
                alert("El campo USUARIO no puede estar vacío.");
                document.getElementById("user").focus();
                return false;
            }

            if (txtPass.trim() === "") {
                alert("El campo CONTRASEÑA no puede estar vacío.");
                document.getElementById("pass").focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <form action="validacion.php" method="POST" onsubmit="return validarFormulario()">
        
        <div class="imgcontainer">
            <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
            <h2 style="margin-top: 10px; color: #2c3e50;">Iniciar Sesión</h2>
        </div>

        <div class="container">
            <label for="user"><b>Usuario</b></label>
            <input type="text" id="user" name="user" placeholder="Ingresa tu usuario">

            <label for="pass"><b>Contraseña</b></label>
            <input type="password" id="pass" name="pass" placeholder="••••••••">
                
            <button type="submit">Entrar al Sistema</button>
        </div>

        <div class="container-footer">
            <span style="color: #555; font-weight: bold;">Estudiante: Ulises Sánchez</span>
            <span style="color: #7f8c8d;">Catastro Municipal</span>
        </div>
    </form>

</body>
</html>