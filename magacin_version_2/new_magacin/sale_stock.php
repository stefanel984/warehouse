<?php 
include("connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('lib/class_warehouse.php');
$products_qty=lagerList(true);
?>
<div class="menu_work">
	<div class="export_import">
		<input type="button" value="Излез" id="Output" class="button_out"/> 
	</div>
</div>	
<div class="working_stock"  id="working_stock">
	 <p>Моментално немате налог</p>

</div>
<div id="dialog-sale" title="Излез на роба">
	<table id="storeTable" class="display" cellspacing="0"  width="100%" >
		<thead>
			<tr>
				<th width="35%">Производ</th>
				<th width="30%">Компресор тип</th>
				<th width="18%">Шифра</th>
				<th width="7%">Количина</th>
				<th width="5%"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			   foreach($products_qty as $product_qty){
			 ?>
			  <tr>
				 <td><?php echo $product_qty['name']; ?></td>
				 <td><?php echo $product_qty['tip_kompresor']; ?></td>
				 <td><?php echo $product_qty['product_number']; ?></td>
				 <td align="center"><input type="number"  id="<?php echo $product_qty['id'] ?>"   name="qty" min="1"/></td>
				 <td><span class="add_icon" >+</span></td>
			  </tr>
			 <?php
				   
			   } 
			?>
		</tbody>

	</table>
</div>
<script>
 $(document).ready(function() {
    $('#storeTable').DataTable( {
		 "bPaginate":false,
		 "columnDefs": [
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
        "lengthMenu": [[ -1], ["All"]]	
    } );
} );
$(".add_icon").click(function(){
	var id=($(this).closest("tr").find("input[name='qty']").attr("id"));
	var value=($(this).closest("tr").find("input[name='qty']").val());

	if(value<1){
		alert("Внесете количина поголем од 0 парчиња, за да биде легална операцијата");
		$("#"+id).focus().addClass("big_value");
	}else{
	
		$("#"+id).removeClass("big_value");
		$.post("lib/make_output.php",
			  {
				id:id,
				value:value
			  },
			  function(data){
				if($('#working_stock > #showTable').length>0){
					content +=data;
					$("#working_stock tr:last").after(content);
			
				}else{
					$("#working_stock").html("");
					var content ="Налог број(излез):<input type='text' name='order_in' class='takeOutput' height='20px' width='300px'/>";
					content += "<br/><br/><table border='1' id='showTable'>";
					content += "<tr><th>Име</th><th>Шифра</th><th>Количина</th><th>Откажи</th></tr>";
					content +="<tbody>";
					content +=data;
					content +="</tbody>";
					content += "</table>";
					content += "<br/>";
					content += "<br/>";
					content +="<div>";
					content +="<input type='button' value='Потврди' id='output_accept' class='accept' />";
					content +="<input type='button' value='Откажи' id='output_non_accept' class='non_accept'/>";
					content +="</div>";
					
					
					$("#working_stock").append(content);
				}
			 }
			  
		);
		$(this).closest("tr").find("input[name='qty']").val("");
		$(this).closest("tr").find("input[name='price']").val("");
		
	}	
});
dialog_window= $( "#dialog-sale" )
      .dialog({
	  autoOpen: false,
      height: 600,
      width: 1000,
      modal: true,
	  buttons:{
		"Затвори": function() {
          dialog_window.dialog( "close" );
        }
      }
  });
  $("#Output").click(function() {
	dialog_window.dialog( "open" );
 
	});

  </script>