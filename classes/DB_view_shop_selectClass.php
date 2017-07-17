<!-- Страница редактирования параметров цеха -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_view_shop_select extends DB {
		function Db_manipulation() {
			$row = mysqli_fetch_array($this->result, MYSQLI_BOTH);
			$view_greeting = "Данные цеха:";
			$name_shop = $row['shop'];
			$id_shop = $row['id_shop'];
			$this->db_inner = "INNER JOIN locations USING (id_shop) ";
			$this->db_order = "ORDER BY id_shop ASC, (location+0) ASC ";
			$this->Db_select();
			$this->Db_result();
			$row = mysqli_fetch_array($this->result, MYSQLI_BOTH);
			$disabled = (!empty($row[0])) ? "disabled" : "";
			?>
			<form  name="view_shop_form" id="view_shop_form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<p><?php echo $view_greeting; ?></p>
				<fieldset>
					<label for="shop_name">Название цеха:</label>
					<input name="shop_name" id="shop_name" value="<?php echo $name_shop; ?>"> <br>
					<label for="id_view_shop">Идентификатор цеха:</label>
					<input name="id_view_shop" id="id_view_shop" value="<?php echo $id_shop; ?>" <?php echo $disabled; ?>> <br>
				</fieldset>

				<input type="submit" name="view_cancel" id="view_cancel" value="Отмена">
				<input type="submit" name="view_shop_update" id="view_shop_update" value="Принять изменения">
				<!-- <input type="submit" name="view_shop_delete_submit" id="view_shop_delete_submit" value="Удалить цех"
				 <?php echo $disabled; ?> >	<br> <br> -->
				<input type="button" name="view_shop_delete_button_show" id="view_shop_delete_button_show" value="Удалить цех"
				 <?php echo $disabled; ?> >

				<div class="view_shop_delete_check" hidden>
				 <p>Вы действительно хотите удалить?</p>
						<input type="submit" name="view_shop_delete_submit" id="view_shop_delete_submit" value="Да, удалить"
				 <?php echo $disabled; ?> >
				 		<input type="button" name="view_shop_delete_button_hide" id="view_shop_delete_button_hide" value="Не удалять"
				 <?php echo $disabled; ?> >
				</div>
				<?php 
				?><p>Состав цеха:</p>
				<fieldset>
					<?php
					$this->Db_result();
					$field2 = mysqli_fetch_field_direct($this->result, 2);
					while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH)) {
						$href = 'view_s_l.php?id='.$row['id_loc'].'&amp;table=locations'.'&amp;id_name='.$field2->name;
						?> 
						<a href="<?php echo $href; ?>"><span><?php echo $row['location'] ?></span></a> <br><br>
						<?php
					}
					?>
				</fieldset>
				</form>
				<?php
		}
	}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>



				