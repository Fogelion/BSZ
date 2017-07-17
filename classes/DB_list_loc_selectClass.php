<!-- Отображение участков на странице списка цехов и участков(карта) -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_list_loc_select extends DB {
		function Db_manipulation() {
			$field0 = mysqli_fetch_field_direct($this->result, 0);
			$field1 = mysqli_fetch_field_direct($this->result, 1);
			while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH))    {
				$class_name = $field1->name;
				$class_num = $row['id_shop'];
				$content = $row[2];
				$href = 'view_s_l.php?id='.$row['id_loc'].'&amp;table='.$this->db_table.'&amp;id_name='.$field0->name;
?>
				<li class="<?php echo $class_name.'_'.$class_num; ?>"><span class="list_loc"> <?php echo $content; ?> </span></li>
				<a class ="<?php echo $class_name.'_'.$class_num; ?>" href="<?php echo $href; ?>"><span class ="edit_sign">edit</span></a>
<?php
			}
		}
	}
?>