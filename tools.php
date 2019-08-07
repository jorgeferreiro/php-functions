<?php
/**
 *
 */
class tools
{

  function __construct(argument)
  {
    // code...
  }
  //sanea string
  public function sanearstring($string){
    $string = trim($string);
    $string = filter_var($string,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);
    $string = filter_var($string,FILTER_SANITIZE_SPECIAL_CHARS);
    return $string;
  }
  //sanea y hashea contraseña
  public function sanearpass($string)
  {
    $string = trim($string);
    $string = filter_var($string,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);
    $string = filter_var($string,FILTER_SANITIZE_SPECIAL_CHARS);
    $string = password_hash($string, PASSWORD_DEFAULT)
    return $string;
  }
  //compara contraseñas hashseadas para inicio de sesion
  public function validateinicio($pass,$hash)
  {
    if (password_verify($pass, $hash)) {
      return true;
  } else {
      return false;
  }
  }

public function mysqlicon($host,$usuario,$pass,$bd)
{
  $enlace = mysqli_connect("$host", "$usuario", "$pass", "$bd");
  if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
  }
  return $enlace;
}



}

/**
 *
 */
class crudusuarios
{
  public $nombre;
  public $paterno;
  public $materno;
  public $correo;
  public $telefono;
  public $area;
  public $tipocuenta;

  function __construct(argument)
  {
    // code...
  }

  //metodos
  public function getNombre(){
      return $this->nombre;
  }

  public function setNombre($nombre){
      $this->nombre = $nombre;
  }
  public function getPaterno(){
      return $this->paterno;
  }

  public function setPaterno($paterno){
      $this->paterno = $paterno;
  }
  public function getMaterno(){
      return $this->materno;
  }

  public function setMaterno($materno){
      $this->materno = $materno;
  }
  public function getCorreo(){
      return $this->correo;
  }

  public function setCorreo($correo){
      $this->correo = $correo;
  }
  public function getTelefono(){
      return $this->telefono;
  }

  public function setTelefono($telefono){
      $this->telefono = $telefono;
  }
  public function getArea(){
      return $this->area;
  }

  public function setArea($area){
      $this->area = $area;
  }
  public function getTipocuenta(){
      return $this->tipocuenta;
  }

  public function setTipocuenta($tipocuenta){
      $this->tipocuenta = $tipocuenta;
  }

}

 ?>
