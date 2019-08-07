<?php
/**
 *
 */
class tools
{
  function __construct()
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
    $string = password_hash($string, PASSWORD_DEFAULT);
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
class usuario
{
  public $id;
  public $usuario;
  public $pass;
  public $nombre;
  public $paterno;
  public $materno;
  public $correo;
  public $telefono;
  public $area;
  public $tipocuenta;
  function __construct()
  {
    $this->id = null;
    $this->usuario = null;
    $this->pass = null;
    $this->nombre = null;
    $this->paterno = null;
    $this->materno = null;
    $this->correo = null;
    $this->telefono = null;
    $this->area = null;
    $this->tipocuenta = null;

  }
  //metodos
  public function getId(){
      return $this->id;
  }
  public function setId($id){
      $this->id = $id;
  }
  public function getUsuario(){
      return $this->usuario;
  }
  public function setUsuario($usuario){
      $this->usuario = $usuario;
  }
  public function getPass(){
      return $this->pass;
  }
  public function setPass($pass){
      $this->pass = $pass;
  }
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

  //function crud
public function showusers($con)
{
  $sql = "SELECT * FROM usuariosini";
  $stm = mysqli_query($con, $sql) or die( print_r( mysqli_error($con), true));

  if ($stm) {

    $listausuarios =[];
    while($usuario = mysqli_fetch_array($stm)) {
     $miusuario = new usuario();
     $miusuario->setId($usuario['id']);
     $miusuario->setUsuario($usuario['usuario']);
     $miusuario->setNombre($usuario['nombre']);
     $miusuario->setPaterno($usuario['paterno']);
     $miusuario->setMaterno($usuario['materno']);
     $miusuario->setCorreo($usuario['correo']);
     $miusuario->setTelefono($usuario['telefono']);
     $miusuario->setTipocuenta($usuario['tipocuenta']);

     $listausuarios[]= $miusuario;

    }

  }
  return $listausuarios;
}

function obtenerusuario($i,$con){
  $miusuario = new usuario;
  $sql = "SELECT * FROM usuariosini WHERE id = '$i'";
  $stm = mysqli_query($con,$sql);
  $usuario = mysqli_fetch_array($stm);
  return $usuario;
}
   function deleteuser($con,$u){

     $sql ="DELETE FROM usuariosini WHERE id='$u'";
     $stm = mysqli_query($con,$sql);
     if ($stm) {
       return true;
       }
     mysqli_free_stmt($stm);
     mysqli_close($con);
   }
   function actualizausuario($con, $u){
     $id = $u->getId();
     $nombre = $u->getNombre();
     $paterno = $u->getPaterno();
     $materno = $u->getMaterno();
     $tipocuenta = $u->getTipocuenta();
     $usuario = $u->getUsuario();
     $correo = $u->getCorreo();
     $sql= "UPDATE clientes SET nombre='$nombre', paterno='$paterno', materno='$materno', correo = '$correo', estados='$estado', fecha='$fecha' WHERE USUARIOID = '$id' ";
     $stm = mysqli_query($con,$sql);
     if ($stm) {
       return true;

     }
   }
   function adduser($conexion, $u){
     $nombre = $u->getNombre();
     $paterno = $u->getPaterno();
     $materno = $u->getMaterno();
     $correo = $u->getCorreo();
     $usuario = $u->getUsuario();
     $tipocuenta = $u->getTipocuenta();
     $pass = $u->getPass();


     $sqlr ="INSERT INTO usuariosini(password,nombre,paterno,materno,correo,usuario,tipocuenta) VALUES ('$pass','$nombre','$paterno','$materno','$correo','$usuario', '$tipocuenta'); ";
           //ejecutamos query
      $sentencia = mysqli_query($conexion, $sqlr);

      if ($sentencia) {
       return true;
       }

   }

   function verifyuser($con,$id)
   {
     $sql = "SELECT usuario FROM usuariosini WHERE usuario = '$id'";
     $stm = mysqli_query($con,$sql);
     if ($stm) {
       $verify = mysqli_fetch_array($stm);

       if ($id == $verify['usuario']) {
         return true;
       }else {
         return false;
       }
     }
   }

}
 ?>
