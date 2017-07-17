<!-- Обновление/редактирование уже существующего цеха -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_view_shop_delete extends DB {
		function Db_manipulation() {
			$this->Db_delete();
			print_r ($this->query);
		}
	}
?>