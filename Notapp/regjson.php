<?php

   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'notappv2');
   $json=array();


   const HASH = PASSWORD_DEFAULT; //siempre va a estar lo más actualizado
   const COST = 14; // se define la cantidad de veces que es hasheado el password



   if(isset($_GET["usuario"])&& isset($_GET["nip"])){
      $usuario=$_GET["usuario"];
      $nip=$_GET["nip"];
      $passwordencriptado= password_hash($nip,  HASH, ['cost' => COST]);

      $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //conexion bd antes llamado bd

      $consulta="SELECT * FROM acceso_estudiantes WHERE id_estudiante='$usuario'";
      $resultado=mysqli_query($conexion,$consulta);

      if($registro=mysqli_fetch_array($resultado)){
        
         $password_hash= $registro['contrasena'];
         if(password_verify($nip,$password_hash)) {
       $json['usuario'][]=$registro;   //el array del json se llama usuario
        }
        echo json_encode($json);

      }else{
         $resulta["usuario"]='no existe usuario';
         $resulta["nip"]='no existe esta clave o clave incorrecta';
         $json['usuario'][]=$resulta;
         echo json_encode($json);
      }


   }else{
         $resulta["usuario"]='No retorna';
         $resulta["nip"]='No retorna';
         $json['usuario'][]=$resulta;
         echo json_encode($json);
      }



?>