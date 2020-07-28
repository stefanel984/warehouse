<?php
include("../connection.php");
require('class_warehouse.php');
$in_order=$_POST['in_order'];
session_start();


$n=count($in_order);
$i=2;
$res=0;
$order_number=$in_order[1];
while($i<$n){
	$id=$in_order[$i];
	$qty_in_stock=takeQtyOfProduct($id);
	$id_product=$qty_in_stock[0]['id_product'];
	$new_qty=$in_order[$i+1];
	$qty=$qty_in_stock[0]['qty']+$new_qty;
	

	$res=upDateWareHouse($id_product, $qty);
	if($res==0){
		echo 0;
	}
	$price=$in_order[$i+3];
	$product=takeProductByNumPart($id_product);
	$old_price=$product[0]['price'];
	if($old_price!=0){
	    $new_price=($price+$old_price)/2;	
	}else
	{
		$new_price=$price;
	}
	$res=updatePrice($new_price,$id_product);
	if($res==0){
		echo 0;
	}
	
	$i=$i+4;
}	
$date=date("Y-m-d H:i:s");
$i=2;
$input_order_array=array();
while($i<$n){
	$input_order_array[]=array($in_order[$i],$in_order[$i+1]);
	$i=$i+4;
}
$input_array=json_encode($input_order_array,JSON_UNESCAPED_UNICODE);
$res=insertWareHouse($order_number,$input_array,$date);
if($res==0){
	echo 0;
}else
{
	echo 1;
}


?>