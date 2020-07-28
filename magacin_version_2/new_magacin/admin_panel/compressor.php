<?php
include("../connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('../lib/class_warehouse.php');

?>
<style>
.choice{
	width:330px;
}
.choice option{
	width:330px;
}
</style>
<div style="margin-top:20px; margin-left:30px;">
	<table>
		<tr><td>Компресорски тип:</td><td> <input type='text' name='name' size='30' value='' class='compressor'></td></tr>
	</table>
	<br/>
	<br/>
	<div>
		<input type='button' id='compBtn' value='Зачувај' />
		<input type='button' id='closeBtn' value='Затвори' />
	</div>	
</div>