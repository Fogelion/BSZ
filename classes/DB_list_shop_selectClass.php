<!-- Отображение цехов на странице списка цехов и участков(карта) -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_list_shop_select extends DB {
		function Db_manipulation() {
			$field0 = mysqli_fetch_field_direct($this->result, 0);
			while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH))    {
				$class_name = $field0->name;
				$class_num = $row['id_shop'];
				$content = $row[1];
				$href = 'view_s_l.php?id='.$row['id_shop'].'&amp;table='.$this->db_table.'&amp;id_name='.$field0->name;
?>
				<a class ="edit_sign" href="<?php echo $href; ?>"><span>edit</span></a>
				<a href="" class="<?php echo $class_name.'_'.$class_num; ?>" ><span class="list_shop"> <?php echo $content; ?> </span></a><br>
<?php
			}
		}
	}
?>