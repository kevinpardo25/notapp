<?php
session_start();
//error_reporting(0);  //para que no muestre los errores

//expiracion de sesion
$segundos = time();
$tiempo_transcurrido = $segundos;
$tiempo_maximo = $_SESSION['inicio']  + ( $_SESSION['intervalo'] * 60 ) ; // se multiplica por 60 segundos ya que se configura en minutos
if($tiempo_transcurrido > $tiempo_maximo){
header('location: index.php');
}else{
// se resetea el inicio
$_SESSION['inicio'] = time();
}
//fin de la expiracion





$varsesion = $_SESSION['usu'];
$id=$_SESSION['usu'];  //guardo el id del estudiante


   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'notappv2');
    $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Notas Matriculadas:</title>

</head>
<body>
	<h1>Notas matriculadas: <?php echo $_SESSION['usu']; ?></h1>
	<table border="1">
		<tr>
			<td>Id:</td>
			<td>NRC:</td>
			<td>Seguimiento1:</td>
			<td>Parcial1:</td>
			<td>Seguimiento2:</td>
			<td>Parcial2:</td>
			<td>Laboratorio:</td>
		</tr>
		
		<?php
		$sql="SELECT * FROM materias_matriculadas WHERE id_estudiante='$id'";
		$resultado=mysqli_query($conexion,$sql);
		while($mostrar=mysqli_fetch_array($resultado)){

		?>

		<tr>
			<td><?php echo $mostrar['id'] ?></td>
			<td><?php echo $mostrar['nrc_materias_sistemas'] ?></td>
			<td><?php echo $mostrar['nota_seguimiento_1'] ?></td>
			<td><?php echo $mostrar['nota_parcial_1'] ?></td>
			<td><?php echo $mostrar['nota_seguimiento_2'] ?></td>
			<td><?php echo $mostrar['nota_parcial_2'] ?></td>
			<td><?php echo $mostrar['nota_laboratorio'] ?></td>
		</tr>
		<?php
	}
	


		?>
	</table>
	<a href="cerrar_session.php"> cerrar sesión</a>
	
<?php   
if ($id == 332799){
    echo "<a href='faltanotas.php'> calcular </a>";
} else {
    echo "<a href='faltanotass.php'> calcular </a>";
}
?>
	

	 //holi
	</body>
</html>