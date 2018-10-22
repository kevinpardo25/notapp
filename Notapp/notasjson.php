<?php

   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'notappv2');
   $json=array();


         $id=$_GET["id"];

      $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //conexion bd antes llamado bd

      $consulta="SELECT * FROM materias_matriculadas WHERE id_estudiante='$id'";
      $resultado=mysqli_query($conexion,$consulta);

      while($registro=mysqli_fetch_array($resultado)){
       $json['id'][]=$registro;   //el array del json se llama usuario
       echo json_encode($json);

      }
   



?>