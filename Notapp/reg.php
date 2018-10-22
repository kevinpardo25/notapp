

<?php
session_start();
const HASH = PASSWORD_DEFAULT; //siempre va a estar lo más actualizado
const COST = 14; // se define la cantidad de veces que es hasheado el password



   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'notappv2');
   $json=array();
   $usuario=$_POST['cajaUsuario'];
   $clave=$_POST['cajaNIP'];
   $getusu=$_GET['cajaUsuario'];
   $getpwd=$_GET['cajaNIP'];
   $_SESSION['usu']=$usuario;
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //conexion bd

   if(is_null($db)){
   	echo "conexion fallida";
   }else{
   	echo "conexion exitosa";

   }


$passwordencriptado= password_hash($clave,  HASH, ['cost' => COST]);
   


//const HASH = PASSWORD_DEFAULT; //siempre va a estar lo más actualizado
//const COST = 14;
//$passwordencriptado= password_hash($clave,  HASH, ['cost' => COST]);

   $consulta="SELECT * FROM acceso_estudiantes WHERE id_estudiante='$usuario'";
   $resultado=mysqli_query($db,$consulta);
   $filas=mysqli_num_rows($resultado);

   
   if($filas>0){
      $row =mysqli_fetch_array($resultado);
      $password_hash= $row['contrasena'];
         
      if(password_verify($clave,$password_hash)) {
      header("location:menu_principal.php");
   }else{
      echo "error en la autenticacion de password";
   }
   }else{
      echo "error en la autenticacion usuario no encontrado";
   }
   mysqli_free_result($resultado);
   mysqli_close($db);

/*   $sql = "INSERT INTO acceso_usuarios (id_estudiante, Contrasena)
VALUES ( '456789', '456789')";
if($db->query($sql)===TRUE){
	echo "exito";
}else{
	echo "pailas" .$db->error;
}
$db->close();
*/

?>

