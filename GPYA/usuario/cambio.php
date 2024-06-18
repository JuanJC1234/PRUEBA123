<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location: ../sesion/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/estilocambio.css">
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <title>Acesso</title>
</head>
<body>
    <div class="dropdown">
        <button class="dropbtn">≡</button>
        <div class="dropdown-content">
            <a href="index.php">Inicio</a>
            <a href="descargar.php">Descargar Reporte</a>
            <a href="cambio.php">Mi cuenta</a>
        </div>
    </div>
    <div class="background-image"></div>
    <div class="overlay"></div>
    <div class="form-container">
        <h1>CAMBIO DE CONTRASEÑA</h1>

    	<?php
        // Variables iniciales
        $clave = "";
        $claveRepetida = "";
        $mensajeError="";

        if (isset($_POST['clave']) && isset($_POST['claveRepetida'])) {
            $username = $_SESSION['usuario'];
            $clave = $_POST['clave'];
            $claveRepetida = $_POST['claveRepetida'];

            if ($clave !== $claveRepetida) {
                $mensajeError = "Error: Las contraseñas no coinciden.";
            } else {
                // Conectar a la base de datos
                require_once("../models/conexion.php");

                // Preparar la consulta para obtener el ID
                $sentencia = $conexion->prepare("SELECT id FROM cliente WHERE usuario = :usuario");
                $sentencia->bindValue(":usuario", $username);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                
                if ($resultado) {
                    $id = $resultado['id'];

                    // Preparar la consulta de actualización
                    $sentencia = $conexion->prepare("UPDATE cliente SET clave = :clave WHERE id = :id");
                    $sentencia->bindValue(":clave", $claveRepetida);
                    $sentencia->bindValue(":id", $id);
                    $sentencia->execute();

                    echo "<p style='color: green;'>Contraseña actualizada correctamente.</p>";
                    $claveRepetida = "";
                }else {
                        $mensajeError = "Error: Usuario no encontrado.";
                    }
                }
            } else {
                $mensajeError = "Error: Todos los campos son obligatorios.";
            }
        
        if ($mensajeError) {
            echo "<p style='color: red;'>$mensajeError</p>";
        }
        ?>
        <form method="post">
                <table>
                    <tr>
                        <td>Usuario</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="usuario" value="<?php echo $_SESSION["usuario"]?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Nueva Clave</td>
                    </tr>
                    <tr>
                        <td><input type="password" name="clave" value="<?php echo $clave;?>" required></td>
                    </tr>
                    <tr>
                        <td>Repetir Clave</td>
                    </tr>
                    <tr>
                        <td><input type="password" name="claveRepetida" value="<?php echo $claveRepetida;?>" required></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="button-group">
                                <a href="index.php" class="button button-cancel">Cancelar</a>
                                <button type="submit" class="button button-submit">Guardar</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</body>
</html>