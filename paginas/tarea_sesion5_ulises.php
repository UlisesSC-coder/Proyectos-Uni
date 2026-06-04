<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Practica de la sesion 5</title>
    <script type="text/javascript">
        function validarElFormulario() {
            // Buscamos por ID para la validación visual
            var validacion = document.getElementById("BoxNumbers").value;
            
            if (validacion == "") {
                alert("Debes seleccionar un numero");
                return false; // Detiene el envío
            }
            return true; // Permite el envío
        }
    </script>
</head>

<body>
    <div style="display: flex; justify-content: center;"> <form action="funciones_usuario_2026a.php" method="post" id="frm_datos" onsubmit="return validarElFormulario()">
            <fieldset>
                <legend>Captura de numero</legend>
                
                <label for="BoxNumbers">Ingresa un numero</label>
                
                <select id="BoxNumbers" name="BoxNumbers">
                    <option value="">--Selecciona un Numero--</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
                
                <input type="hidden" name="txt_tunombre" id="txt_tunombre" value="Ulises_Sanchez">
                
                <br><br>
                
                <input type="submit" value="Enviar Datos">
            </fieldset>
        </form>
    </div>
</body>
</html>