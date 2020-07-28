<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<style type="text/css">
    body
	{
		background-color: #999;
	}
    #content{
		width:900px;
		min-height:600px;
		border: thin solid #000;
		background-color:#FFF;
		margin: 0 auto;
		
	}
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
		padding-left:200px;
	}
</style>




</head><body>

<?php
require("lib/class_document.php");
$type=$_GET['type'];
$id=$_GET['id'];
$data=takeData($id,$type);
$id=$data[0]['id'];
$list=json_decode($data[0]['in_list'], true);
if($type=='input'){
	$number=$data[0]['order_number_in'];
}else
{
	$number=$data[0]['order_number_out'];
}
$date=$data[0]['date'];
$date=date("m/d/y",strtotime($date));



?>
<div id="content">
	<div style="width:750px; margin-left:70px; margin-right:10px; margin-top:10px;"><img src="images/header.jpg" width="750px" height="116px" /></div>
	<div style="width:750px; height:250px; float:left; margin-left:60px; margin-right:10px; margin-top:30px; ">
		<div style="float:right; padding-right:3px;  margin-top:10px; margin-bottom:5px; width:150px;">Датум:  <b><?php echo $date;?></b></div>
		<?php if ($type=='output'){?>
		<div><h2>Испратница бр. <?php echo $number ?></h2></div>
		<?php }else
				{?>
		<div><h2>Приемница бр. <?php echo $number ?></h2></div>	 
				<?php   }?>	
		<table class="Printtable">
			<thead>	
				  <tr>
					<th align="center" width="50px">ред.број</th>
					<th align="center" width="300px">Шифра</th>
					<th align="center" width="300px">Koмпресорски тип</th>
					<th align="center" width="100px">Количина</th>
				  </tr>
			</thead>
			<tbody>
				<?php 
					$i=1;
					foreach($list as $value){
						$product=takeProduct($value[0]);
						$qty=$value[1];
				?>
				   <tr>
						<td align="center"><?php echo $i; ?></td>
						<td align="center"><?php echo $product[0]['product_number']; ?></td>
						<td align="center"><?php echo $product[0]['tip_kompresor']; ?></td>
						<td align="center"><?php echo $qty; ?></td>
				   </tr>
				<?php
						$i=$i+1;
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php

$type=$_GET['type'];
$id=$_GET['id'];

?>