<?php
/*
$aux=$_REQUEST["aux"];
$con =mysql_connect("sql109.eshost.com.ar","eshos_20158321","Rodriban89") or die ("Sin Conexion");
mysql_select_db("eshos_20158321_facturacion");

$ssql = "SELECT * FROM producto";     
$rs= mysql_query($ssql,$con);
$datos=array();
while ($row=mysql_fetch_object($rs)){
$datos[]= $row;
}
echo json_encode($datos);*/

include("../conexion.php");
$clienteId=$_REQUEST["aux"];

$ssql = "SELECT i.*,e.id as eventoId FROM invitados i join mesas m on m.id=i.inv_mesa join eventos e on e.id=m.mesa_evento where e.eve_cliente_id=$clienteId";     
$result= $conexion->query($ssql);

// check for empty result
if($row = $result->fetch_array()){
    // looping through all results
    // products node
    $response["invitados"] = array();    

    $invitado = array();    
    $invitado["id"] = $row["id"];
    $invitado["nombre"] = $row["inv_nombre"];
    $invitado["apellido"] = $row["inv_apellido"];
    $invitado["sexo"] = $row["inv_sexo"];
    $invitado["tipo"] = $row["inv_tipo"];
    $invitado["mesa"] = $row["inv_mesa"];
    $invitado["asistencia"] = $row["inv_asistencia"];
    $invitado["activo"] = $row["inv_activo"];
    $invitado["eventoId"] = $row["eventoId"];
    // push single product into final response array
    array_push($response["invitados"], $invitado);
    
    while ($row = $result->fetch_array()) {
        // temp user array
        
    $invitado["id"] = $row["id"];
    $invitado["nombre"] = $row["inv_nombre"];
    $invitado["apellido"] = $row["inv_apellido"];
    $invitado["sexo"] = $row["inv_sexo"];
    $invitado["tipo"] = $row["inv_tipo"];
    $invitado["mesa"] = $row["inv_mesa"];
    $invitado["asistencia"] = $row["inv_asistencia"];
    $invitado["activo"] = $row["inv_activo"];
    $invitado["eventoId"] = $row["eventoId"];
    // push single product into final response array
    array_push($response["invitados"], $invitado);
    }    
    // echoing JSON response
    $response["success"] = 1;
    echo json_encode($response);
} 
else {    
    // no products found
    $response["success"] = 0;
    $response["message"] = "No invitados found";
    // echo no users JSON
    echo json_encode($response);
}

?>