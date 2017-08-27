
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});

	$rec_shop = new DB_edit_rec_shop_select("SELECT", "*", "shops", "","ORDER BY id_shop ASC",
	 "", "", "");
	$rec_loc = new DB_edit_rec_loc_select("SELECT", "*", "locations", "","ORDER BY id_shop ASC,
	 (location+0) ASC", "", "", "");
	$rec_send = new DB_edit_rec_send_insert("INSERT INTO", "", "records", "", "", "",
		"time, shift, id_loc, id_status, description, solution, notice, alert", "");
	$rec_get = new DB_edit_rec_get_update("UPDATE", "", "records", "", "", "",
		"time, shift, id_loc, id_status, description, solution, notice, alert", "");

	if ((isset($_POST['submit'])) && (empty($_GET))) {
		$rec_send->Db_Start();
		header("location: edit_record.php");
	} elseif ((isset($_POST['submit'])) && (!empty($_GET))) {
		$rec_get->Db_Start();
		header(header_generate());
	}



	function show_status($id_status) {
		for($i=1; $i<=3; $i++) {
			switch ($i) {
				case 1:
				$cont = 'заявка открыта';
				break;
				case 2:
				$cont = 'заявка закрыта';
				break;
				case 3:
				$cont = 'без заявки';
				break;
			}
			$selected = ($i == $id_status) ? "selected" : "";
			echo '<option '.$selected.' value="'.$i.'">'.$cont.'</option>';
		}
	}
	function show_alert($alert) {
		for($i=0; $i<=1; $i++) {
			$cont = ($i == 0) ? "NO" : "YES";
			$checked = ($i ==  $alert) ? "checked" : "";
			echo '<label><input type="radio" name="alert" '.$checked.' value="'.$i.'">'.$cont.'</label>';
		}
	}
	function show_description() {
		if (!empty($_GET['description'])) {
			echo ($_GET['description']);
		}
	}
	function show_solution() {
		if (!empty($_GET['solution'])) {
			echo ($_GET['solution']);
		}
	}
	function show_notice() {
		if (!empty($_GET['notice'])) {
			echo ($_GET['notice']);
		}
	}

	function header_generate() {
		$header_get = 'location: edit_record.php?time='.$_POST['time'].
			'&shift='.$_POST['shift'].'&id_status='.$_POST['id_status'].
			'&description='.$_POST['description'].'&solution='.$_POST['solution'].
			'&alert='.$_POST['alert'].'&notice='.$_POST['notice'].'&id_rec='.$_GET['id_rec'].
			'&num_rec='.$_GET['num_rec'].'&id_shop='.$_POST['shop'].
			'&id_loc='.$_POST['id_loc'];
			return $header_get;
	}
	if (!empty($_GET)) {
		$time = $_GET['time'];
		$shift = $_GET['shift'];
		$id_status = $_GET['id_status'];
		$alert = $_GET['alert'];
		$id_rec = $_GET['id_rec'];
		$num_rec = $_GET['num_rec'];
		$greeting = "Редактирование записи №".$num_rec.":";
		$submit_val = "Обновить запись";
		$title_val = "Редактировать запись";
		$header_active = '';
	} else {
		$time = date('Y-m-d');
		$shift = 1;
		$id_status = 1;
		$alert = 0;
		$greeting = "Введите данные для создания новой записи:";
		$submit_val = "Создать запись";
		$title_val = "Добавить запись";
		$header_active = 'class="header_active"';
	}
?>




<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title_val; ?></title>
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
				<li <?php echo $header_active; ?> ><a href="edit_record.php">Добавить запись</a></li>
				<li><a href="shops&locs_list.php">Список локаций</a></li>
			</ul>
		</nav>
	</header>

<body id="edit_rec_body">
<main>
	<div class="container" id="records_body">
		<div class="row">
			<div class="col-lg-2 back_white"><a href="index.php"><i class="fa fa-arrow-circle-o-left fa-5x"></i></a>
			</div>
			<div class="col-lg-10 back_grey">
					<form  name="add_record" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

					<p><?php echo $greeting; ?></p>

						<fieldset>
						<label for="time">Дата:</label>
						<input type="date" name="time" id="time" value="<?php echo $time; ?>"> <br> <br>

						<label for="shift">Смена:</label>
						<input type="number" name="shift" id="shift" min="1" max="4" value="<?php echo $shift; ?>"> <br>
						</fieldset><br>

						<fieldset>
						<label for="shop">Цех:</label>
						<select name="shop" id="shop" class="er_shop">
							<?php $rec_shop->Db_start(); ?>
						</select> <br><br>

						<label for="location">Участок:</label>
						<select name="id_loc" id="location" class="er_location">
							<?php $rec_loc->Db_start(); ?>
						</select> <br>
						</fieldset><br>

						<fieldset>
						<label for="status">Статус заявки:</label>
						<select name="id_status" id="status" class="er_status">
						<?php show_status($id_status); ?>
						</select> <br>
						</fieldset><br>

						<fieldset>
						<label for="description">Описание <span class="red_star">*</span>:</label>
						<textarea required name="description" id="description" rows="2" cols="60"><?php show_description(); ?></textarea> <br> <br>

						<label for="solution">Решение <span class="red_star">*</span>:</label>
						<textarea required name="solution" id="solution" rows="2" cols="60"><?php show_solution(); ?></textarea> <br> <br>

						<label for="notice">Замечания:</label>
						<textarea name="notice" id="notice" rows="2" cols="60"><?php show_notice(); ?></textarea> <br>
						</fieldset><br>

						<fieldset>
						<label>Alert:</label>
						<?php show_alert($alert); ?>
						<br>
						</fieldset><br>

						<input type="submit" name="submit" id="submit" value="<?php echo $submit_val; ?>">
					</form>
			</div>
		</div>
	</div>
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>