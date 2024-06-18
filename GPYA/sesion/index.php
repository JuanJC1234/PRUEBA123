<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: ../usuario/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/estiloindex.css">
    <title>Inicio de sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="left-side">
                <img src="../images/logologologo.png" alt="Logo">
        </div>
        <div class="right-side">
            <div class="login-box">
                <h1>Bienvenido</h1>
                <p>Esta página ha sido creada para el uso único de administradores.</p>

                <?php
                // Valores iniciales
                $username = "";

                if (isset($_POST['txtUsuario']) && isset($_POST['txtClave'])) {
                    // Recoger los valores
                    $username = $_POST['txtUsuario'];
                    $clave = $_POST['txtClave'];
                    $password= $clave;

                    // Conectar a la base de datos
                    require_once("../models/conexion.php");

                    // Preparar la consulta
                    $sentencia = $conexion->prepare("SELECT usuario,clave FROM cliente WHERE usuario = :usuario and clave= :clave;");
                    $sentencia->bindParam(':usuario', $username);
                    $sentencia->bindParam(':clave', $password);
                    $sentencia->execute();

                    // Obtener el resultado
                    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                    
                    // Verificar si se encontró el usuario y la contraseña es correcta
                    if ($resultado) {
                        // Almacenar el usuario en la sesión
                        $_SESSION['usuario'] = $resultado['usuario'];
                        header("Location: ../usuario/index.php");
                        exit();
                    } else {
                        // Mostrar mensaje de error
                        echo "<p style='color: red;'>Nombre de usuario o contraseña incorrectos.</p>";
                        // Mantener el nombre de usuario en el campo
                    }
                }
                ?>

                <form method="post">
                    <div class="input-group">
                        <img src="../images/usuario.png" alt="Usuario Icon" class="icon">
                        <input type="text" name="txtUsuario" value="<?php echo htmlspecialchars($username); ?>" placeholder="Usuario" required class="input-field">
                    </div>
                    <div class="input-group">
                        <img src="../images/clave.png" alt="Clave Icon" class="icon">
                        <input type="password" name="txtClave" placeholder="Clave" required class="input-field">
                    </div>
                    <button type="submit">Ingresar</button>
                    <a href="../">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
