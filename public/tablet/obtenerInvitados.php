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
 //$aux=$_REQUEST["aux"];

$ssql = "SELECT * FROM producto";     
$result= $conexion->query($ssql);

// check for empty result
if($row = $result->fetch_array()){
    // looping through all results
    // products node
    $response["producto"] = array();    

    $product = array();    
    $product["id"] = $row["prd_id"];
    $product["codigo"] = $row["prd_codigo"];
    $product["nombre"] = $row["prd_descripcion"];
    $product["lista"] = $row["prd_num_lista"];
    $product["preciou"] = $row["prd_precio_unitario"];
    $product["preciobr"] = $row["prd_precio_bruto"];
    $product["stock"] = $row["prd_stock"];
    $product["fecha"] = $row["prd_fecha_update"];
    // push single product into final response array
    array_push($response["producto"], $product);
    
    while ($row = $result->fetch_array()) {
        // temp user array
        
        $product["id"] = $row["prd_id"];
        $product["codigo"] = $row["prd_codigo"];
        $product["nombre"] = $row["prd_descripcion"];
        $product["lista"] = $row["prd_num_lista"];
        $product["preciou"] = $row["prd_precio_unitario"];
        $product["preciobr"] = $row["prd_precio_bruto"];
        $product["stock"] = $row["prd_stock"];
        $product["fecha"] = $row["prd_fecha_update"];
        // push single product into final response array
        array_push($response["producto"], $product);
    }    
    // echoing JSON response
    $response["success"] = 1;
    echo json_encode($response);
} 
else {    
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
    // echo no users JSON
    echo json_encode($response);
}

?>