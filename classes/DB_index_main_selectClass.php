<!-- Отображение записей на главной странице -->
<?php
	spl_autoload_register(function($class) {
		include 'classes/'.$class.'Class.php';
	});
	class DB_index_main_select extends DB {
		function Db_manipulation() {
			$field0 = mysqli_fetch_field_direct($this->result, 0);
			$num_rows = mysqli_num_rows($this->result)
				or die ('Ошибка получения строк');
			$num_fields = mysqli_num_fields($this->result)
				or die ('Ошибка получения столбцов');
			$count = 0;
			while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH))    {
				$year = substr($row['time'], 0, 4);
				$month = substr($row['time'], 5, 2);
				$day = substr($row['time'], 8, 2);
				$time = $day.".".$month.".".$year;
				$shift = $row['shift'];
				$location = $row['shop'].", ".$row['location'];
				$id_status = $row['status'];
				$description = $row['description'];
				$solution = $row['solution'];
				$alert = $row['alert'];
				$notice = $row['notice'];
				$id_rec = $row['id_rec'];
				$num_rec = $num_rows - $count;
				$count++;
				$edit_param = '<td><a href="edit_record.php?time='.$row['time'].
				'&amp;shift='.$shift.'&amp;id_status='.$row['id_status'].
				'&amp;description='.$description.'&amp;solution='.$solution.
				'&amp;alert='.$alert.'&amp;notice='.$notice.'&amp;id_rec='.$id_rec.
				'&amp;num_rec='.$num_rec.'&amp;id_shop='.$row['id_shop'].
				'&amp;id_loc='.$row['id_loc'].'" class="edit_rec"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i></a></td>';
?>



				<section class="record">
				<h2><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Запись № <?php echo $num_rec; ?> <span class="record_edit"> <?php echo $edit_param; ?> </span></h2>
					<ul class="record_data">
						<li><span class="record_id">ID: <?php echo $id_rec; ?></span></li>
						<li><span>Дата: </span> <?php echo $time; ?></li>
						<li><span>Смена № </span> <?php echo $shift; ?></li>
						<br>
						<li><span>Локация: </span> <?php echo $location; ?></li>
						<li><span>Статус вызова: </span> <?php echo $id_status; ?></li>
					</ul>
					<ul class="description">
						<li><span>Описание: </span></li>
						<li><?php echo $description; ?></li>
					</ul>
					<ul class="solution">
						<li><span>Решение: </span></li>
						<li><?php echo $solution; ?></li>
					</ul>
					<ul class="notice">
						<li><span>Замечания: </span></li>
						<li><?php echo $notice; ?></li>
					</ul>
					<div class="alert"> Alert: <span class="alert_val"><?php echo $alert; ?></span></div>
				</section>
<?php
			}
		}
	}
?>