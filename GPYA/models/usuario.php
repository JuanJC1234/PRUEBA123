<?php
require_once("conexion.php"); //Ruta Relativa
class Usuario

{
  //Propiedades
  public $id;
  public $nombre;
  public $apellido;
  public $email;
  public $usuario;
  public $clave;
  public $repitaClave;
  public function verificar($usuario, $clave)

  {
    $conexion = Conexion::getConectarMySQL();
    $sentencia = $conexion->prepare("SELECT usuario FROM cliente WHERE usuario = :usuario AND clave = :clave");
    $sentencia->bindValue(':usuario', $usuario);
    $sentencia->bindValue(':clave', $clave);
    $sentencia->execute();

    return $sentencia->fetch(PDO::FETCH_ASSOC);

  }
  public function editarContraseña($objUsuario){
    $conexion =  Conexion::getConectarMySQL();


    $sentencia = $conexion->prepare("UPDATE cliente set clave=:clave where usuario=:usuario;");

    $sentencia->bindValue(":clave", $objUsuario->clave);
    $sentencia->bindValue(":usuario", $objUsuario->usuario);
    
    $sentencia->execute();
}

public function verificarUsuario($objUsuario){
  $conexion = Conexion::getConectarMySQL();
  $sentencia = $conexion->prepare("SELECT usuario FROM cliente WHERE usuario = :usuario;");
  $sentencia->bindValue(':usuario', $objUsuario->usuario);
  $sentencia->execute();

  return $sentencia->fetch(PDO::FETCH_ASSOC);
}

  public function registar($objUsuario){

    $conexion = Conexion::getConectarMySQL();
    $sentencia = $conexion->prepare("insert into cliente (nombre,apellido,email,usuario,clave) values (:nombre,:apellido,:email,:usuario,:clave) ;");

    $sentencia->bindValue(":nombre", $objUsuario->nombre);
    $sentencia->bindValue(":apellido", $objUsuario->apellido);
    $sentencia->bindValue(":email", $objUsuario->email);
    $sentencia->bindValue(":usuario", $objUsuario->usuario);
    $sentencia->bindValue(":clave", $objUsuario->clave);

    //Ejecutar la sentencia
    $sentencia->execute();
  }

}

?>