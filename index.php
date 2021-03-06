<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Журнал АСУТП</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<header>
		<a href="index.php"><img class="logo" src="img/Begitsky_steel_plant.png"></a>
		<nav class="navigation">
			<ul>
				<li class="header_active"><a href="index.php">Главная</a></li>
				<li><a href="edit_record.php">Добавить запись</a></li>
				<li><a href="shops&locs_list.php">Список локаций</a></li>
				<li><a id="filter_button" href="#">Показать фильтр</a></li>
			</ul>
		</nav>
	</header>


<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	$index_order_time_default = "time DESC";
	$index_order_id_default = "id_rec DESC";
	$index_order_default = "ORDER BY ".$index_order_time_default.", ".$index_order_id_default;
	$index_where_default = "";

	$index_order = (!empty($_GET['index_order'])) ? $_GET['index_order'] : $index_order_default;
	$index_where = (!empty($_GET['index_where'])) ? $_GET['index_where'] : $index_where_default;

	$rec_shop = new DB_edit_rec_shop_select("SELECT", "*", "shops", "","ORDER BY id_shop ASC",
	 "", "", "");
	$rec_loc = new DB_edit_rec_loc_select("SELECT", "*", "locations", "","ORDER BY id_shop ASC,
	 (location+0) ASC", "", "", "");


	function show_filt_time($order) {
		$prepare_order = substr($order, 9);
		$arr_order = explode(", ", $prepare_order);
		if (in_array("time DESC", $arr_order)) {
			$sel0 = "";
			$sel1 = "selected";
			$sel2 = "";
		} elseif (in_array("time ASC", $arr_order)) {
			$sel0 = "";
			$sel1 = "";
			$sel2 = "selected";
		}	else {
			$sel0 = "selected";
			$sel1 = "";
			$sel2 = "";
		}
		$opt1 = '<option value="time DESC" '.$sel1.'>'.'Сперва новые'.'</option>';
		echo $opt1;
		$opt2 = '<option value="time ASC" '.$sel2.'>'.'Сперва старые'.'</option>';
		echo $opt2;
		$opt0 = '<option value="" '.$sel0.'>'.'Без времени'.'</option>';
		echo $opt0;
	};

	function show_filt_id($order) {
		$prepare_order = substr($order, 9);
		$arr_order = explode(", ", $prepare_order);
		if (in_array("id_rec DESC", $arr_order)) {
			$sel0 = "";
			$sel1 = "selected";
			$sel2 = "";
		} elseif (in_array("id_rec ASC", $arr_order)) {
			$sel0 = "";
			$sel1 = "";
			$sel2 = "selected";
		}	else {
			$sel0 = "selected";
			$sel1 = "";
			$sel2 = "";
		}
		$opt1 = '<option value="id_rec DESC" '.$sel1.'>'.'По убыванию'.'</option>';
		echo $opt1;
		$opt2 = '<option value="id_rec ASC" '.$sel2.'>'.'По возрастанию'.'</option>';
		echo $opt2;
		$opt0 = '<option value="" '.$sel0.'>'.'Без идентификатора'.'</option>';
		echo $opt0;
	};

	function show_filt_status($where) {
		$prepare_where = substr($where, 6, 11);
		$arr_where = explode(", ", $prepare_where);
		echo $prepare_where;
		print_r ($arr_where);
		if (in_array("id_status=1", $arr_where)) {
			$sel0 = "";
			$sel1 = "selected";
			$sel2 = "";
			$sel3 = "";
		} elseif (in_array("id_status=2", $arr_where)) {
			$sel0 = "";
			$sel1 = "";
			$sel2 = "selected";
			$sel3 = "";
		}	elseif (in_array("id_status=3", $arr_where)) {
			$sel0 = "";
			$sel1 = "";
			$sel2 = "";
			$sel3 = "selected";
		}	else {
			$sel0 = "selected";
			$sel1 = "";
			$sel2 = "";
			$sel3 = "";
		}
		$opt1 = '<option value="id_status=1" '.$sel1.'>'.'Заявка открыта'.'</option>';
		echo $opt1;
		$opt2 = '<option value="id_status=2" '.$sel2.'>'.'Заявка закрыта'.'</option>';
		echo $opt2;
		$opt3 = '<option value="id_status=3" '.$sel3.'>'.'Без заявки'.'</option>';
		echo $opt3;
		$opt0 = '<option value="" '.$sel0.'>'.'Без сортировкии'.'</option>';
		echo $opt0;
	};


	function show_filt_alert($where) {
		$prepare_where = substr($where, 6);
		$checked = ($prepare_where == "alert=1") ? "checked" : "";
		echo '<label><input type="checkbox" name="index_alert" '.$checked.' value="1">Показать</label>';
	}
?>

<main>
	<div class="index_filter" id="all_filter" style="display: none;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12"><span class="text_bold">Сортировка:</span></div>
			</div>

			<div class="row">
				<div class="col-lg-6 align_right">
					<label for="filt_time">по времени: </label>
					<select name="filt_time" id="filt_time" class="filter_time">
						<?php show_filt_time($index_order); ?>
					</select>
				</div>
				<div class="col-lg-6 align_left">
					<label for="filt_id">по ID: </label>
					<select name="filt_id" id="filt_id" class="filter_id">
						<?php show_filt_id($index_order); ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12"><span class="text_bold">Фильтр:</span></div>
			</div>
			<div class="row">
				<div class="col-lg-6 align_right">
					<label for="filt_status">по статусу заявки: </label>
					<select name="filt_status" id="filt_status" class="filter_status">
						<?php show_filt_status($index_where); ?>
					</select>
				</div>
				<div class="col-lg-6 align_left">
					<label>Заявки с alert:</label>
					<?php show_filt_alert($index_where); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 align_right">
					<label for="filt_shop">по цеху: </label>
					<select name="filt_shop" id="filt_shop" class="filter_shop er_shop">
						<option selected value="">Все цеха</option>
						<?php $rec_shop->Db_start(); ?>
					</select>
				</div>
				<div class="col-lg-6 align_left">
					<label for="filt_loc">по участку: </label>
					<select name="filt_loc" id="filt_loc" class="filter_loc er_location">
						<option selected value="" id="selected_empty_loc">Все участки</option>
						<?php $rec_loc->Db_start(); ?>
					</select>
				</div>
			</div>

			<div class="row index_buttons">
				<div class="col-lg-6 align_right">
					<a href="#" id="filter_href">
						<input type="button" name="send_filter" value="Применить фильтр" id="apply_filter">
					</a>
				</div>
				<div class="col-lg-6 align_left">
					<a href="index.php" id="filter_reset">
						<input type="button" name="reset_filter" value="Сбросить фильтр" id="reset_filter">
					</a>
				</div>
			</div>
		</div>
	</div>

</main>

<?php
	$index_main = new DB_index_main_select("SELECT", "*", "records", "INNER JOIN status USING (id_status) ".
		"INNER JOIN locations USING (id_loc) "."INNER JOIN shops USING (id_shop) ", $index_order, $index_where,"","");
	$index_main->Db_start();

?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/scripts.js"></script>
</body>
</html>