<!-- Добавление новой записи в БД -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_edit_rec_send_insert extends DB {
		function Db_manipulation() {
			$post_data = explode(", ", $this->col_names);
			foreach ($post_data as &$val) {
				/*Присвоение переменным, имя которых содержится в ячейке массива, данных из ПОСТ по метке с тем же названием, что и переменная*/
				${$val} = $_POST[$val];
				/*Присвоение ячейке массива значения переменной, название которой берется в этой же ячейке, а так же форматирование полученного результата ковычками для формирования запроса в базу*/
				$val = "'".${$val}."'";
			}
			unset($val);
			$this->values = implode(",", $post_data);
			if ((!empty($description)) && (!empty($solution))) {
				$this->ready_to_send = true;
			}
		}
	}
?>