<!-- Страница редактирования параметров участка -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_view_loc_select extends DB {
		function Db_manipulation() {
			$row = mysqli_fetch_array($this->result, MYSQLI_BOTH);
			$view_greeting = "Данные участка:";
			$name_loc = $row['location'];
			$id_loc = $row['id_loc'];
			$name_shop = $row['shop'];
			$field0 = mysqli_fetch_field_direct($this->result, 0);
			$href = 'view_s_l.php?id='.$row['id_shop'].'&amp;table=shops'.'&amp;id_name='.$field0->name;

			$this->db_inner = "INNER JOIN records USING (id_loc) ";
			$this->db_order = "";
			$this->Db_select();
			$this->Db_result();
			$row = mysqli_fetch_array($this->result, MYSQLI_BOTH);
			$disabled = (!empty($row[0])) ? "disabled" : "";
			?>
			<p><?php echo $view_greeting; ?></p>
			<fieldset>
				<label for="shop_name">Название участка:</label>
				<input name="shop_name" id="shop_name" value="<?php echo $name_loc; ?>"> <br>
				<label for="id_view_shop">Идентификатор участка:</label>
				<input name="id_view_shop" id="id_view_shop" value="<?php echo $id_loc; ?>" <?php echo $disabled; ?>> <br>
			</fieldset>
			<p>Входит в состав цеха:</p>
			<fieldset>
					<a href="<?php echo $href; ?>"><span><?php echo $name_shop; ?></span></a> <br><br>
			</fieldset>
			<?php
		}
	}
?>

