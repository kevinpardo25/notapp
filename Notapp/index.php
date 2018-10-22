<?php
session_start();
$_SESSION['intervalo']  = 1; // en minutos
$_SESSION['inicio'] = time();
?>

<HTML>

<HEAD>

<TITLE>Acceso a Usuario</TITLE>

<link rel="stylesheet" type="text/css" href="css/estilos.css" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" http-equiv="Content-Type" content="text/html; charset=utf-8">

</HEAD>
<div class="contenedor">

<BODY BGCOLOR="FFFFFF">

<IMG   SRC="images/sigaa.PNG" style="max-width:100%;width:auto;height:auto";> 

<p></p>
<br>
<br>
<br>
<br>
<br>





Ingresar su Número de Identificación de Usuario (ID) y su Número de Identificación Personal (NIP). Al terminar, seleccionar Acceso.

<P> Nota: ID acepta mayúsculas y minúsculas
<p> Para proteger su privacidad, por favor usar Salir y cerrar su navegador cuando haya terminado.

<form action="reg.php" method="post">
	<div>
<B><label for="Idusuario">ID Usuario: &emsp; </label> </B><input type="text" name="cajaUsuario" size="11" maxlength="9">
</div>
<div>

<B><label for="NIP">NIP: &emsp; &emsp; &emsp; &nbsp;  </label></B> <input type="password" name="cajaNIP" size="16" maxlength="15">
</div>
<div class="button">
	<p><button type="submit" name="acceso" onclick="">Acceso</button>  <button type="submit" name="olvido">¿Olvidó NIP?</button>  
</div>
</form>


	<P> <B>VERSIÓN 8.5</B>



</BODY>

</HTML>