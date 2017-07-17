<!-- Обновление/редактирование уже существующего цеха -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_view_shop_edit_update extends DB {
		function Db_manipulation() {
			$id_view_shop = (isset($_POST['id_view_shop'])) ? $_POST['id_view_shop'] : $_GET['id'];
			$shop_name = $_POST['shop_name'];
			$post_data = explode(", ", $this->col_names);
			$post_data[0] = $post_data[0]."="."'".$id_view_shop."'";
			$post_data[1] = $post_data[1]."="."'".$shop_name."'";
			$this->values = implode(",", $post_data);
			if ((!empty($id_view_shop)) && (!empty($shop_name))) {
				$this->ready_to_send = true;
			}
			print_r ($this->values);
		}
	}
?>