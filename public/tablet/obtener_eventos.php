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

$ssql = "SELECT e.* FROM eventos e where e.eve_cliente_id=$clienteId";     
$result= $conexion->query($ssql);

// check for empty result
if($row = $result->fetch_array()){
    // looping through all results
    // products node
    $response["eventos"] = array();    

    $evento = array();    
    $evento["id"] = $row["id"];
    $evento["descripcion"] = $row["eve_descripcion"];
    $evento["fecha"] = $row["eve_fecha"];
    $evento["lugar"] = $row["eve_lugar"];
    $evento["mesas"] = $row["eve_mesas"];
    $evento["clienteId"] = $row["eve_cliente_id"];
    $evento["empresaId"] = $row["eve_empresa_id"];
    $evento["activo"] = $row["eve_activo"];
    // push single product into final response array
    array_push($response["eventos"], $evento);
    
    while ($row = $result->fetch_array()) {
        // temp user array
        
    $evento = array();    
    $evento["id"] = $row["id"];
    $evento["descripcion"] = $row["eve_descripcion"];
    $evento["fecha"] = $row["eve_fecha"];
    $evento["lugar"] = $row["eve_lugar"];
    $evento["mesas"] = $row["eve_mesas"];
    $evento["clienteId"] = $row["eve_cliente_id"];
    $evento["empresaId"] = $row["eve_empresas_id"];
    $evento["activo"] = $row["eve_activo"];
    // push single product into final response array
    array_push($response["eventos"], $evento);
    }    
    // echoing JSON response
    $response["success"] = 1;
    echo json_encode($response);
} 
else {    
    // no products found
    $response["success"] = 0;
    $response["message"] = "No eventos found";
    // echo no users JSON
    echo json_encode($response);
}

?>