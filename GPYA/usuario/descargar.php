<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: ../sesion/index.php");
    exit();
}

// Verificar si se ha enviado el formulario antes de generar cualquier contenido HTML
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cadena = "mysql:host=127.0.0.1;dbname=gpya;charset=utf8";
    $usuario = "root";
    $clave = "";

    try {
        // Instanciar un nuevo objeto PDO
        $conexion = new PDO($cadena, $usuario, $clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM datos";
        $result = $conexion->query($sql);

        if ($result->rowCount() > 0) {
            // Nombre del archivo CSV
            $filename = "datos_exportados.csv";

            // Configurar cabeceras HTTP para descarga
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Crear archivo CSV
            $output = fopen('php://output', 'w');

            // Obtener las columnas de la consulta
            $columnas = array();
            for ($i = 0; $i < $result->columnCount(); $i++) {
                $meta = $result->getColumnMeta($i);
                $columnas[] = $meta['name'];
            }

            // Escribir la cabecera del CSV
            fputcsv($output, $columnas);

            // Escribir los datos en el CSV
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, $row);
            }

            fclose($output);
            exit(); // Terminar el script después de enviar el CSV
        } else {
            echo "No hay datos para exportar";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/estilodescargar.css">
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <title>Descargar Reporte</title>
    <link rel="stylesheet" href="style.css">
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
<div class="container">
    <div class="cuadro-azul"></div>
    <div class="box">
        <img src="../images/logologologo.png" alt="Logo">
        <h2>REPORTE DE FORMULARIO</h2>
        <p>Aquí podrá descargar el reporte de registros de los usuarios que han rellenado el formulario.</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <button type="submit">DESCARGAR</button>
        </form>
    </div>
</div>

</body>
</html>
