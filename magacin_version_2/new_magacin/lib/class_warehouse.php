<?php
require(dirname(__DIR__)."/config_file.php");

function backSQLresult($result){
	$conn=dbConnect();
	$results=mysqli_query($conn,$result);
	$result_set=array();
	while(($row = mysqli_fetch_array($results, MYSQL_ASSOC))){
		$result_set[]=$row;
	}
	return $result_set;
}
function lagerList($full=false){
	$conn=dbConnect();
	$sql="SELECT product.*, warehouse.qty, compressor.tip_kompresor FROM product
         INNER JOIN warehouse ON
         product.product_number=warehouse.id_product
		 INNER JOIN compressor ON
		 product.id_compressor=compressor.id ";
		 $sql.=" WHERE product.delete_flag = 0 ";
		 if($full===true){
			 $sql.=" AND warehouse.qty > 0";
		 }
    $result=backSQLresult($sql);	
    return $result;	
		 
}
function takeProduct($id){
	    $conn=dbConnect();
		$sql="SELECT *
		      FROM product
			  WHERE id='".$id."'";
		$result=backSQLresult($sql);
		return $result;	
}
function takeProductByNumPart($id_part){
	    $conn=dbConnect();
		$sql="SELECT *
		      FROM product
			  WHERE product_number='".$id_part."'";
		$result=backSQLresult($sql);
		return $result;	
}
function takeQtyOfProduct($id){
	      $conn=dbConnect();
		  $sql="SELECT *
		        FROM warehouse
				WHERE id_product='$id'";
		  $result=backSQLresult($sql);
		  return $result;
}		  
function upDateWareHouse($id_product, $qty_in_stock){
	     $conn=dbConnect();
		 $sql="UPDATE warehouse SET qty=".$qty_in_stock." WHERE  id_product='".$id_product."'";
		 $update=mysqli_query($conn,$sql);
		 if(!$update){
			 return 0;
			 
		 }else
		{
			return 1;	 
	    }
	
}	
function insertWareHouse($order_number,$input_array,$date){
	   $conn=dbConnect();
	   $sql="INSERT INTO warehouse_input(order_number_in, in_list , date) VALUES ('$order_number', '$input_array', '$date') ";
	   $result=mysqli_query($conn,$sql);
	   if(!$result){
			 return 0;
			 
		 }else
		{
			return 1;	 
	    }
	
}
function outWareHouse($order_number,$input_array,$date){
	   $conn=dbConnect();
	   $sql="INSERT INTO warehouse_output(order_number_out, in_list , date) VALUES ('$order_number', '$input_array', '$date') ";
	   $result=mysqli_query($conn,$sql);
	   if(!$result){
			 return 0;
			 
		 }else
		{
			return 1;	 
	    }
	
}	  
function updatePrice($price,$id_product){
	$conn=dbConnect();
	$sql="UPDATE product SET price=".$price." WHERE  product_number='".$id_product."'";
	$update=mysqli_query($conn,$sql);
	if(!$update){
		 return 0;
		 
	}else
	{
		return 1;	 
	}
}	
function lastInput(){
	$conn=dbConnect();
	$sql="SELECT *
	      FROM warehouse_input
          ORDER BY id DESC LIMIT 1 ";
	$result=backSQLresult($sql);
	return $result;
}	
function lastOutput(){
	$conn=dbConnect();
	$sql="SELECT *
	      FROM warehouse_output
          ORDER BY id DESC LIMIT 1 ";
	$result=backSQLresult($sql);
	return $result;
}
function selectCompressor($id){
	$conn=dbConnect();
	$sql="SELECT *
	      FROM compressor
		  WHERE id=".$id;
    $result=backSQLresult($sql);
	return $result;		  
}
function updateProduct($product_number,$price,$name,$qty){
	$conn=dbConnect();
	$sql="UPDATE product SET price=".$price.", name='".$name."' WHERE  product_number='".$product_number."'";
	$update=mysqli_query($conn,$sql);
	if(!$update){
		 return 0;
		 
	}else
	{
		$sql="UPDATE warehouse SET qty=".$qty." WHERE  id_product='".$product_number."'";
		$update=mysqli_query($conn,$sql);
		if(!$update){
			return 0;
		 }else{
			return 1; 
		 }
				 
	}
}
function allTypeCompressor(){
	$conn=dbConnect();
	$sql="SELECT *
	      FROM compressor";
    $result=backSQLresult($sql);
	return $result;	
	
}
function addProduct($product_number,$price='',$name,$compressor='', $qty=''){
	$conn=dbConnect();
	if($price==''){
		$price=0;
		
	}
	if($qty==''){
		$qty=0;
		
	}
	if($compressor==''){
		$compressor=0;
		
	}
	$sql="INSERT INTO product(name, product_number, price, id_compressor, delete_flag) VALUES ('$name', '$product_number', '$price', '$compressor', '0') ";
    $result=mysqli_query($conn,$sql);
	 if(!$result){
		 return 0;
		 
	 }	
	$sql="INSERT INTO warehouse(id_product, qty) VALUES ('$product_number','$qty') ";
    $result=mysqli_query($conn,$sql);
    if(!$result){
		 return 0;
		 
	 }else
	 {
		return 1;	 
	}
}
function addCompressor($name){
	$conn=dbConnect();
	$sql="INSERT INTO compressor(tip_kompresor) VALUES ('$name') ";
    $result=mysqli_query($conn,$sql);
    if(!$result){
		 return 0;
		 
	 }else
	 {
		return 1;	 
	}
}
function deleteProduct($product_number)  {
	$conn=dbConnect();
	$flag=1;
	$sql="UPDATE product SET delete_flag=".$flag."  WHERE  product_number='".$product_number."'";
	$update=mysqli_query($conn,$sql);
	if(!$update){
		return 0;
	 }else{
		return 1; 
	 }
} 	

?>