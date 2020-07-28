<?php
include("../connection.php");
require('class_warehouse.php');
$in_order=$_POST['in_order'];
session_start();


$n=count($in_order);
$i=2;
$res=0;
$order_number=$in_order[1];
$input_order_array=array();
while($i<$n){
	$id=$in_order[$i];
	$qty_in_stock=takeQtyOfProduct($id);
	$id_product=$qty_in_stock[0]['id_product'];
	$qty=$in_order[$i+1];
	$qty=$qty_in_stock[0]['qty']-$qty;
	if($qty<0){
		$qty=$qty_in_stock[0]['qty'];
		$qty=(int)$qty;
		$input_order_array[]=array($in_order[$i],$qty);
		$qty=0;
	}else
	{
		$input_order_array[]=array($in_order[$i],$in_order[$i+1]);
	}
	$res=upDateWareHouse($id_product, $qty);
	if($res==0){
		echo 0;
	}
	
	
	$i=$i+2;
}	
$date=date("Y-m-d H:i:s"); 

$input_array=json_encode($input_order_array,JSON_UNESCAPED_UNICODE);
$res=outWareHouse($order_number,$input_array,$date);
if($res==0){
	echo 0;
}else
{
	echo 1;
}


?>