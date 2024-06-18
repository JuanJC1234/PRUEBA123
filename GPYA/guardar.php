<?php
class Conexion {
    private $servidor;
    private $usuario;
    private $contrasena;
    private $base_datos;
    public $conexion;

    public function __construct() {
        $this->servidor = 'localhost';
        $this->usuario = 'root';
        $this->contrasena = '';
        $this->base_datos = 'gpya';
    }

    public function conectar() {
        $this->conexion = @mysqli_connect($this->servidor, $this->usuario, $this->contrasena, $this->base_datos);
        if (!$this->conexion) {
            die("No se puede conectar con el servidor");
        }
    }

    public function cerrar() {
        mysqli_close($this->conexion);
    }
}

class Conectarse {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion->conexion;
    }

    public function guardarDatos($nombre, $email, $telefono, $asunto, $mensaje) {
        // Modificamos la consulta SQL para que coincida con los nombres de las columnas de la tabla
        $sql = "INSERT INTO datos (nombre, email, numero, asunto, mensaje) VALUES ('$nombre', '$email', '$telefono', '$asunto', '$mensaje')";
        $ejecutar = mysqli_query($this->conexion, $sql);

        if (!$ejecutar) {
            return "Error al guardar los datos: " . mysqli_error($this->conexion);
        } else {
            return "Datos guardados correctamente";
        }
    }
}

// Crear una instancia de la clase Conexion y conectar
$conexion = new Conexion();
$conexion->conectar();

// Recoge los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

// Crear una instancia de la clase Conectarse y guardar los datos
$conectarse = new Conectarse($conexion);
$resultado = $conectarse->guardarDatos($nombre, $email, $telefono, $asunto, $mensaje);

// Cierra la conexión
$conexion->cerrar();

// Imprime el resultado (esto será capturado por la solicitud AJAX)
echo $resultado;
?>
