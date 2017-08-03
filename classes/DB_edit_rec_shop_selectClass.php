<!-- Вывод списка цехов на странице создания/обновления записей -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_edit_rec_shop_select extends DB {
		function Db_manipulation() {
			while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH))    {
				$id = (!empty($_GET['id_shop'])) ? $_GET['id_shop'] : "";

				//Присвоение $id данных из фильтра
				if (!empty($_GET['index_where'])) {
					$id_loc_filt = $_GET['index_where'];
					$id_loc_pos = strripos($id_loc_filt, "id_loc");
					$id_loc_prepare = substr($id_loc_filt, $id_loc_pos);
					$id_shop_prepare = substr($id_loc_prepare, 7,2);
					$id = $id_shop_prepare;
				}

				$selected = ($row['id_shop'] == $id) ? "selected" : "";
				?>
				<option <?php echo $selected; ?> value="<?php echo $row['id_shop']; ?>"
				 class="<?php echo 'id_shop_'.$row['id_shop']; ?>">
				<?php echo $row['shop']; ?></option>
				<?php
			}
		}
	}
?>