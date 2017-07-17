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
				'&amp;id_loc='.$row['id_loc'].'" class="edit_rec">Редактировать</a></td>';
?>
				<section class="record">
				<h2>Запись № <?php echo $num_rec; ?>, <span>ID: <?php echo $id_rec; ?></span></h2>
					<div class="info">
						<table>
							<tr> 
								<td><span>Дата: </span> <?php echo $time; ?></td>
								<td><span>Смена № </span> <?php echo $shift; ?></td>
								<td><span>Локация: </span> <?php echo $location; ?></td>
								<td><span>Статус вызова: </span> <?php echo $id_status; ?></td>
								<?php
								echo ($edit_param);
								?>
							</tr>
						</table>
					</div>
					<div class="description">
						<table>
							<tr>
								<td><span>Описание: </span></td>
								<td><?php echo $description; ?></td>
							</tr>
							<tr>
								<td><span>Решение: </span></td>
								<td><?php echo $solution; ?></td>
							</tr>
							<tr>
								<td><span>Замечания: </span></td>
								<td><?php echo $notice; ?></td>
							</tr>
						</table>
					</div>
					<div class="alert"> Alert: <?php echo $alert; ?></div>
				</section>
<?php
			}	
		}
	}
?>