

<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});

	$shop_list = new DB_list_shop_select("SELECT", "*", "shops", "","ORDER BY id_shop ASC", "","","");
	$loc_list = new DB_list_loc_select("SELECT", "*", "locations", "","ORDER BY id_shop ASC, (location+0) ASC", "","","");
?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Список локаций</title>
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
				<li class="header_active"><a href="shops&locs_list.php">Список локаций</a></li>
			</ul>
		</nav>
	</header>
<a href="index.php">Home</a> <br> <br>

<main>
<div class="shops&locs">
	<div class="shops_list">
		<?php $shop_list->Db_start(); ?>
	</div>
	<div class="locs_list">
		<?php $loc_list->Db_start(); ?>
	</div>
</div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>