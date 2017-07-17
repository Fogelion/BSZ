<a href="index.php">Home</a> <br> <br>
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php 
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});

	$shop_list = new DB_list_shop_select("SELECT", "*", "shops", "","ORDER BY id_shop ASC", "","","");
	$loc_list = new DB_list_loc_select("SELECT", "*", "locations", "","ORDER BY id_shop ASC, (location+0) ASC", "","","");
?>

<div class="shops&locs">
	<div class="shops_list">
		<?php $shop_list->Db_start(); ?>
	</div>
	<div class="locs_list">
		<?php $loc_list->Db_start(); ?>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>