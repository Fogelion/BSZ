<!-- Вывод списка участков на странице создания/обновления записей -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_edit_rec_loc_select extends DB {
		function Db_manipulation() {
			while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH))    {
				$id = (!empty($_GET['id_loc'])) ? $_GET['id_loc'] : "";
				$selected = ($row['id_loc'] == $id) ? "selected" : "";
				?>
				<option hidden <?php echo $selected; ?> value="<?php echo $row['id_loc']; ?>" 
				class="<?php echo 'id_shop_'.$row['id_shop']; ?>">
				<?php echo $row['location']; ?></option>
				<?php
			}
		}
	}
?>