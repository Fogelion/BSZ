<title>Журнал АСУТП</title>
<a href="edit_record.php">Add a new record</a> <br>
<a href="shops&locs_list.php">List of shops and locations</a> <br>
<div class="calender">
</div>
<div class="notice">
</div>
<div class="shifts">
	<table>
		<tr>
			<td>№ смены</td>
			<td>Состав смены</td>
		</tr>
		<tr>
			<td>Смена № 1</td>
			<td></td>
		</tr>
		<tr>
			<td>Смена № 2</td>
			<td></td>
		</tr>
		<tr>
			<td>Смена № 3</td>
			<td></td>
		</tr>
		<tr>
			<td>Смена № 4</td>
			<td></td>
		</tr>
	</table>
</div>

<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});

	$index_main = new DB_index_main_select("SELECT", "*", "records", "INNER JOIN status USING (id_status) ".
		"INNER JOIN locations USING (id_loc) "."INNER JOIN shops USING (id_shop) ","ORDER BY time DESC, id_rec DESC","","","");
	$index_main->Db_start();

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>