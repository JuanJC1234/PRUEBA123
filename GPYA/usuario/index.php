<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("location: ../sesion/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/estiloinicio.css">
	<link rel="icon" href="../images/logo.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio</title>
</head>
<body>
	<div class="background-image">
        <img src="https://img.freepik.com/foto-gratis/sonriente-mujer-sonadora-papeles_23-2147669360.jpg?t=st=1718386554~exp=1718390154~hmac=8cabbaa8d34bd2ca574a81c2044ce575b18f936f5d186a247f3cd925e70ede76&w=740" alt="Background Image">
    </div>
    <div class="overlay"></div>
    <div class="content">
        <div class="dropdown">
            <button class="dropbtn">≡</button>
            <div class="dropdown-content">
                <a href="index.php">Inicio</a>
                <a href="descargar.php">Descargar Reporte</a>
                <a href="cambio.php">Mi cuenta</a>
            </div>
        </div>
        <div class="text-content">
            <h2>BIENVENIDO <?php echo $_SESSION["usuario"] ?></h2>
            <hr>
            <p>Ya seas una pequeña empresa en crecimiento o una corporación
            establecida, nuestro equipo de expertos está aquí para ayudarte. Nos
            enorgullecemos de ofrecer un servicio personalizado y adaptado a tus
            necesidades específicas, asegurando que puedas concentrarte en lo que
            más importa: el éxito y crecimiento de tu negocio.</p>
            <button><a href="cerrar.php">Cerrar Sesion</a></button>
        </div>
    </div>
</body>
</html>
