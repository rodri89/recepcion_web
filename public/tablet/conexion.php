
<?php 
/*
$db_host="localhost"; 
$db_usuario="juan06_admin"; 
$db_password="admin"; 
$db_nombre="sistema_bd"; 
$conexion = @mysql_connect($db_host, $db_usuario, $db_password) or die(mysql_error()); 
$db = @mysql_select_db($db_nombre, $conexion) or die(mysql_error());
*/

function conectarse (){
$db_host="mysql.hostinger.es"; 
$db_usuario="u845042619_root"; 
$db_password="rodri89"; 
$db_nombre="u845042619_cima"; 

	$url = new mysqli($db_host,$db_usuario,$db_password,$db_nombre);
	return($url);	
}

$conexion = conectarse();




?> 