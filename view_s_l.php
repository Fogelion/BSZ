<a href="index.php">Home</a> <br> <br>
<a href="shops&locs_list.php">Back</a> <br> <br>
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});

	$view_table = $_GET['table'];
	$view_where = " WHERE ".$_GET['id_name']."=".$_GET['id'];
	$view_shop = new DB_view_shop_select("SELECT", "*", $view_table, 
		"","ORDER BY id_shop ASC", $view_where,"","");
	$view_loc = new DB_view_loc_select("SELECT", "*", $view_table, 
		"INNER JOIN shops USING (id_shop) ","", $view_where,"","");
	$view_update_shop = new DB_view_shop_edit_update("UPDATE", "", "shops", "", "", "$view_where", 
		"id_shop, shop", "");
	$view_delete_shop = new DB_view_shop_delete("DELETE", "", $view_table, 
		"","", $view_where,"","");
	if ($_GET['table'] == "shops") {
		$view_title = "Параметры цеха";
		$view_shop->Db_start();
	} elseif ($_GET['table'] == "locations") {
		$view_title = "Параметры участка";
		$view_loc->Db_start();
	}
	if (isset($_POST['view_cancel'])) {
		echo ("Cancel!");
		header("location: shops&locs_list.php");
	} elseif (isset($_POST['view_shop_update'])) {
		echo ("Apply this!!");
		$view_update_shop->Db_start();
		header('location: shops&locs_list.php');
	} elseif ((isset($_POST['view_shop_delete_submit']))) {
		echo ("Destroy all of this!!!!");
		$view_delete_shop->Db_start();
		header('location: shops&locs_list.php');
	} else {
		echo ("Hmm..It's doesn't work?");
	}
	?>
	<title><?php echo $view_title; ?></title>
	<?php
?>





<!-- 	if (isset($_POST['submit']) && ($_POST['submit'] == "Отмена")) {
		echo ("Cancel!");
		header("location: shops&locs_list.php");
	} elseif (isset($_POST['submit']) && ($_POST['submit'] == "Принять изменения")) {
		echo ("Apply this!!");
		$view_update_shop->Db_start();
		header('location: shops&locs_list.php');
	} elseif ((isset($_POST['submit']))&& ($_POST['submit'] == "Удалить цех")) {
		echo ("Destroy all of this!!!!");
		$view_delete_shop->Db_start();
		/*header('location: shops&locs_list.php');*/
	} else {
		echo ("Hmm..It's doesn't work?");
	} -->