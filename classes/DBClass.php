<!-- Универсальный запрос к БД, родительский класс для остальных запросов -->
<?php 
	class DB {
		public $db_query_type;
		var $db_selection;
		var $db_table;
		var $db_inner;
		var $db_order;
		var $db_where;
		var $col_names;
		var $values;
		var $dbc;
		var $query;
		var $result;
		var $ready_to_send = false;
		function __construct($db1, $db2, $db3, $db4, $db5, $db6, $db7, $db8) {
			$this->db_query_type = $db1;
			$this->db_selection = $db2;
			$this->db_table = $db3;
			$this->db_inner = $db4;
			$this->db_order = $db5;
			$this->db_where = $db6;
			$this->col_names = $db7;
			$this->values = $db8;
		}
		function Db_start() {
			$this->Db_connect();
			switch ($this->db_query_type) {
				case "SELECT":
					$this->Db_select();
					$this->Db_result();
					$this->Db_manipulation();
					break;
				case "INSERT INTO":
					$this->Db_manipulation();
					if ($this->ready_to_send) {
						$this->Db_insert();	
					}
					$this->Db_result();
					break;
				case "UPDATE":
					$this->Db_manipulation();
					if ($this->ready_to_send) {
						$this->Db_update();
					}
					$this->Db_result();
					break;
				case "DELETE":
					$this->Db_manipulation();
					$this->Db_delete();
					$this->Db_result();
					break;
				default:
					echo 'Уточните тип запроса';
			}
			$this->Db_close();
		}
		function Db_connect() {
			$this->dbc = mysqli_connect('s1.localhost', 'root', 'root', 'asutp')
				or die ('Ошибка соединения с MySQL-server');
		}
		function Db_select() {
			$this->query = $this->db_query_type." ".$this->db_selection." FROM ".$this->db_table." ".
			$this->db_inner." ".$this->db_where." ".$this->db_order." ";
		}
		function Db_insert() {
			$this->query = $this->db_query_type." ".$this->db_table." (".$this->col_names.") VALUES (".$this->values.") ";
		}
		function Db_update() {
			$this->query = $this->db_query_type." ".$this->db_table." SET ".$this->values." ".$this->db_where." ";
		}
		function Db_delete() {
			$this->query = $this->db_query_type." ".$this->db_selection." FROM ".$this->db_table." ".$this->db_where." ";
		}
		function Db_result() {
			$this->result = mysqli_query($this->dbc, $this->query)
				or die ("Ошибка выполнения запроса к базе данных\n<br>Query:".$this->query.
					"<br>Error: (".mysqli_errno($this->dbc).") ".mysqli_error($this->dbc));
		}
		function Db_manipulation() {
			}
		function Db_close() {
			mysqli_close($this->dbc);
		}
	}
?>