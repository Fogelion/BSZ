

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
	} elseif ($_GET['table'] == "locations") {
		$view_title = "Параметры участка";
	}

?>






<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo $view_title; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	<body>
		<header>
			<a href="index.php"><img class="logo" src="img/Begitsky_steel_plant.png"></a>
			<nav class="navigation">
				<ul>
					<li><a href="index.php">Главная</a></li>
					<li><a href="edit_record.php">Добавить запись</a></li>
					<li><a href="shops&locs_list.php">Список локаций</a></li>
				</ul>
			</nav>
		</header>

		<main>
			<div class="container" id="view_body">
				<div class="row">
					<div class="col-lg-2 back_white"><a href="shops&locs_list.php"><i class="fa fa-arrow-circle-o-left fa-5x"></i></a>
					</div>
					<div class="col-lg-10 back_grey">
						<?php
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
							} /*else {
								echo ("Hmm..It's doesn't work?");
							}*/
						?>
					</div>
				</div>
			</div>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>