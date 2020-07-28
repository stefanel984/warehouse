<?php
include(dirname(__DIR__)."/config_file.php");

function backSQLresult($result){
	$conn=dbConnect();
	$results=mysqli_query($conn,$result);
	$result_set=array();
	while(($row = mysqli_fetch_array($results, MYSQL_ASSOC))){
		$result_set[]=$row;
	}
	return $result_set;
}
function takeInputDocument($year){
	$conn=dbConnect();
	$year_before=$year."-01-01";
	$year=$year+1;
	$year_after=$year."-01-01";	
	$sql="SELECT * FROM warehouse_input WHERE date>='$year_before' AND date<='$year_after' ORDER BY date ";
	$result=backSQLresult($sql);
	return $result;	
}
function takeOutputDocument($year){
	$conn=dbConnect();
	$year_before=$year."-01-01";
	$year=$year+1;
	$year_after=$year."-01-01";	
	$sql="SELECT * FROM warehouse_output WHERE date>='$year_before' AND date<='$year_after' ORDER BY date ";
	$result=backSQLresult($sql);
	return $result;	
}
function takeData($id,$type){
	$conn=dbConnect();
	if($type=='input'){
		$sql="SELECT * FROM warehouse_input ";
	}else{
		$sql="SELECT * FROM warehouse_output ";
	}
	$sql.= "WHERE id=".$id;
	$result=backSQLresult($sql);
	return $result;	
}
function takeProduct($id_product){
	    $conn=dbConnect();
		$sql="SELECT product.*, compressor.tip_kompresor
		      FROM product
			  INNER JOIN compressor ON
			  product.id_compressor=compressor.id
			  WHERE product.product_number='".$id_product."'";
			  
		$result=backSQLresult($sql);
		return $result;	
}
?>