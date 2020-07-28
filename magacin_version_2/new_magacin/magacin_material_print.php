<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<style type="text/css">
	.Printtable{
		width:100%; 
		border-collapse:collapse; 
	}
	.Printtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	.Printtable th{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/*  Define the background color for all the ODD background rows  */
	.Printtable tbody tr:nth-child(odd){ 
		background: #b8d1f3;
	}
	/*  Define the background color for all the EVEN background rows  */
	.Printtable tbody tr:nth-child(even){
		background: #dae5f4;
	}
	h2{
		font-size:22;
		padding-left:250px;
	}
</style>




</head><body>

<?php
require('lib/class_warehouse.php');


$date=date("m/d/y");

$products_qty=lagerList();

?>
<div style="width:750px;  margin-left:20px; margin-right:10px; margin-bottom:80px;"><img src="images/header.jpg" width="750px" height="116px" /></div>
<div style="width:750px; height:250px; float:left; margin-left:20px; margin-right:10px;  ">
	<div style="float:right; padding-right:3px;  margin-top:10px; margin-bottom:5px; width:150px;">Датум:  <b><?php echo $date;?></b></div>
		<div><h2>Лагер листа</h2></div>
	<table class="Printtable">
		<thead>	
		      <tr>
				<th width="200px">Производ</th>
				<th width="200px">Компресор тип</th>
				<th width="175px">Шифра</th>
				<th width="75px">Количина</th>
			  </tr>
		</thead>
		<tbody>
		    <?php
			   $suma=0;
			   foreach($products_qty as $product_qty){
				   $suma=$suma+($product_qty['price']*$product_qty['qty']);
			 ?>
			  <tr>
				 <td><?php echo $product_qty['name']; ?></td>
				 <td><?php echo $product_qty['tip_kompresor']; ?></td>
				 <td><?php echo $product_qty['product_number']; ?></td>
				 <td align="center"><?php echo $product_qty['qty']; ?></td>
			  </tr>
			 <?php
				   
			   } 
			?>
		</tbody>
	</table>

</div>

<script type='application/javascript'>window.onload=function(){window.print()}</script></body></html>
