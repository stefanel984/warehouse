<?php
include("../connection.php");
require('../lib/class_warehouse.php');
$op=$_POST['op'];
$product=$_POST['product'];
$length=count($product);
if($op=='update'){
	for($i=0;$i<$length;$i++){
		if($product[$i]=='name')
			$name=$product[$i+1];
		elseif($product[$i]=='number'){
			$product_number=$product[$i+1];
			
		}
		elseif($product[$i]=='price'){
			$price=$product[$i+1];
			
		}
		elseif($product[$i]=='qty'){
			$qty=$product[$i+1];
			
		}
	}
	$res=updateProduct($product_number,$price,$name,$qty);
	echo $res;
}
elseif($op=='new'){
	for($i=0;$i<$length;$i++){
		if($product[$i]=='name')
			$name=$product[$i+1];
		elseif($product[$i]=='number'){
			$product_number=$product[$i+1];
			
		}
		elseif($product[$i]=='price'){
			$price=$product[$i+1];
			
		}
		elseif($product[$i]=='compressor'){
			$compressor=$product[$i+1];
		}
		elseif($product[$i]=='qty'){
			$qty=$product[$i+1];
		}
	}
	$exsist=takeProductByNumPart($product_number);
	if(count($exsist)>0){
			echo 2;
	}
	else{
			$res=addProduct($product_number,$price,$name,$compressor,$qty);
			echo $res;
	}
	
}
elseif($op=='comp'){
	for($i=0;$i<$length;$i++){
		if($product[$i]=='name'){
			$name=$product[$i+1];
		}
			
		
	}
	$res=addCompressor($name);
	echo $res;
}
elseif($op=='delete'){
	$res=deleteProduct($product);
	echo $res;
}	
?>