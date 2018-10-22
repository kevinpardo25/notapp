<?php
session_start();
//expirar sesion despues de x tiempo:
$segundos = time();
$tiempo_transcurrido = $segundos;
$tiempo_maximo = $_SESSION['inicio']  + ( $_SESSION['intervalo'] * 60 ) ; // se multiplica por 60 segundos ya que se configura en minutos
if($tiempo_transcurrido > $tiempo_maximo){
header('location: index.php');
}else{
// se resetea el inicio
$_SESSION['inicio'] = time();
}
//fin de expiracion de tiempo


//error_reporting(0);  //para que no muestre los errores
$varsesion = $_SESSION['usu'];
$id=$_SESSION['usu'];  //guardo el id del estudiante

if ($varsesion == null || $varsesion=''){
	echo 'no tiene autorizcion a esta pagina';   //si intentan abrir el archivo no les cargará la pagina
	die();
}

   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'notappv2');
    $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Menú principal</title>

</head>
<body>
	<h1>Bienvenido! <?php echo $_SESSION['usu']; ?></h1>
	<table border="1">
		<tr>
			<td>Id:</td>
			<td>Nombre:</td>
			<td>dentificación:</td>
			<td>Carrera:</td>
			<td>Nivel:</td>
			<td>Estado:</td>
		</tr>
		
		<?php
		$sql="SELECT * FROM estudiantes WHERE id='$id'";
		$resultado=mysqli_query($conexion,$sql);
		while($mostrar=mysqli_fetch_array($resultado)){

		?>

		<tr>
			<td><?php echo $mostrar['id'] ?></td>
			<td><?php echo $mostrar['nombre'] ?></td>
			<td><?php echo $mostrar['identificacion'] ?></td>
			<td><?php echo $mostrar['carrera'] ?></td>
			<td><?php echo $mostrar['estado'] ?></td>
			<td><?php echo $mostrar['nivel'] ?></td>
		</tr>
		<?php
	}
	


		?>
	</table>
	<a href="cerrar_session.php"> cerrar sesión</a> 
	<a href="notas.php"> ver notas</a>
	


</body>
</html>