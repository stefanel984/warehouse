<?php 
include("connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('lib/class_document.php');

?>
<script>
$(document).ready(function() {
    $('#buyTable').DataTable( {
		 "columnDefs": [
            {
                "targets": [ 2 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			{
                "targets": [ 3 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			{
                "targets": [ 4 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			
		],
        "lengthMenu": [[15], [15]]	
    } );
} );
$(document).ready(function() {
    $('#saleTable').DataTable( {
		 "columnDefs": [
            {
                "targets": [ 2 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			{
                "targets": [ 3 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			{
                "targets": [ 4 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			
		],
        "lengthMenu": [[15], [15]]	
    } );
} );
</script>
<div id="document">	
<div class="menu_work" id="menu_work">
	<div class="export_import">
	    <input type="button" value="Влез" id="Input" class="button_in"/> 
		<input type="button" value="Излез" id="Output" class="button_out"/> 
	</div>
</div>	
   
		<div class="input_document">
			<div id="select_year">
			   Избери година:<select id="sort">
				   <?php
					$currYear=date('Y');
					$Year=$currYear;
					if(isset($_POST['year'])){
						$Year=$_POST['year'];	
					}
					$firstYear=2016; 
					while($firstYear<=$currYear){
						if($firstYear!=$Year){
				   ?>
					<option value="<?php echo $firstYear; ?>"><?php echo $firstYear; ?></option>
					<?php
						}else
						{
					?>
					<option value="<?php echo $firstYear; ?>" selected><?php echo $firstYear; ?></option>
					<?php
						 }
					   $firstYear++;			   
					} ?>
			   </select>
			</div>
			<br/>
		<?php
		$currYear=date('Y');
		$Year=$currYear;
        if(isset($_POST['year'])){
			$Year=$_POST['year'];	
		}
		$html="";
		$oneYearDocument=takeInputDocument($Year);
		if(count($oneYearDocument)>0){
			$html.="<div id='year'>".$Year."</div>";
			$html.="<table id='buyTable' class='display' cellspacing='0'  width='100%'>";
			$html.="<thead>";
			$html.="<tr>
							  <td align='center' width='150px'>Датум</td>
							  <td align='center' width='150px'>Приемница бр.</td>
							  <td align='center' width='150px'></td>
							  <td align='center' width='150px'></td>
							  <td align='center' width='150px'></td>
						   </tr></thead><tbody>";
			foreach($oneYearDocument as $document){
				$html.="<tr>
						  <td align='center'>".$document['date']."</td>
						  <td align='center'>".$document['order_number_in']."</td>
						  <td align='center'><a href='print.php?id=".$document['id']."&type=input' target='_blank'><img src='images/printer.png'/></a></td>
						  <td align='center'><a href='pdf_report.php?id=".$document['id']."&type=input' target='_blank'><img src='images/pdf.png'/></a></td>
						  <td align='center'><a href='preview.php?id=".$document['id']."&type=input' target='_blank'><img src='images/doc.png'/></a></td>
						</tr>";
			}
			$html.="</tbody></table><br/><br/>";
		}	
		echo $html;	
		
		
		?>
		
		</div>
		<div class="output_document">
		
			<?php
			$currYear=date('Y');
			$Year=$currYear;
			if(isset($_POST['year'])){
				$Year=$_POST['year'];	
			}
			$html="";
			$oneYearDocument=takeOutputDocument($Year);
			if(count($oneYearDocument)>0){
				$html.="<div id='year'>".$Year."</div>";
				$html.="<table id='saleTable' class='display' cellspacing='0'  width='100%'>";
				$html.="<thead>";
				$html.="<tr>
							  <td align='center' width='150px'>Датум</td>
							  <td align='center' width='150px'>Приемница бр.</td>
							  <td align='center' width='150px'></td>
							  <td align='center' width='150px'></td>
							  <td align='center' width='150px'></td>
						   </tr></thead><tbody>";
				foreach($oneYearDocument as $document){
					$html.="<tr>
							  <td align='center'>".$document['date']."</td>
							  <td align='center'>".$document['order_number_out']."</td>
							  <td align='center'><a href='print.php?id=".$document['id']."&type=output' target='_blank'><img src='images/printer.png'/></a></td>
							  <td align='center'><a href='pdf_report.php?id=".$document['id']."&type=output' target='_blank'><img src='images/pdf.png'/></a></td>
							  <td align='center'><a href='preview.php?id=".$document['id']."&type=output' target='_blank'><img src='images/doc.png'/></a></td>
							</tr>";
				}
				$html.="</tbody></table><br/><br/>";
			}	
			echo $html;	
			
			
			?>
			
			
		</div>
</div>
<style>
.input_document{
	display:block;
	margin-left:10px;
	margin-right:10px;
	margin-top:30px;
}
.output_document{
	display:none;
	margin-left:10px;
	margin-right:10px;
	margin-top:30px;
}
select{
	width:150px;
	font-size:20px;
	
}
#select_year{
	font-size:18px;
	
}
#year{
	font-size:25px;
	font-color:#A9A9A9;
	margin-left:500px;
}
</style>
<script>
$("#Input").click(function(){
	$(".input_document").css('display', 'block');
	$(".output_document").css('display', 'none');
	$("#saleTable_length").hide();
});
$("#Output").click(function(){
	$(".input_document").css('display', 'none');
	$(".output_document").css('display', 'block');
	$("#saleTable_length").hide();
});
$("#sort").change(function(){
	id=$(this).val();
	$("#document").load("document_stock.php",{"year":id});
});
$( document ).ready(function() {
    $("#buyTable_length").hide();
	$("#saleTable_length").hide();
});
 
</script>