<?php

   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'notappv2');
   $json=array();


   if(isset($_GET["id"])){
      $id=$_GET["id"];

      $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //conexion bd antes llamado bd

      $consulta="SELECT * FROM estudiantes WHERE id='$id'";
      $resultado=mysqli_query($conexion,$consulta);

      if($registro=mysqli_fetch_array($resultado)){
       $json['id'][]=$registro;   //el array del json se llama usuario
       echo json_encode($json);

      }else{
         $resulta["id"]='no existe id';//id,nombre,identificacion,carrera,estado,nivel
         $resulta["nombre"]='no existe nombre';
         $resulta["identificacion"]='no existe identificacion';
         $resulta["carrera"]='no existe carrera';
         $resulta["estado"]='no existe estado';
         $resulta["nivel"]='no existe nivel';
         $json['id'][]=$resulta;
         echo json_encode($json);
      }


   }else{
                 $resulta["id"]='no retorna';//id,nombre,identificacion,carrera,estado,nivel
         $resulta["nombre"]='no retorna';
         $resulta["identificacion"]='no retorna';
         $resulta["carrera"]='no retorna';
         $resulta["estado"]='no retorna';
         $resulta["nivel"]='no retorna';
         $json['id'][]=$resulta;
         echo json_encode($json);
      }



?>