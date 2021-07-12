<?php

	include '../includes/connection.php';


	if (isset($_POST["export_excel"])) {
		

		$export = $_POST['export'];
		$output = '';

		$export = $connection->query("SELECT * FROM time_log WHERE date(`date`) = '$export' ORDER BY id");

		if ($export->num_rows > 0) {
			
			$output .='

				<table class="table" bordered="1">
					<tr>
						<th>ID Number</th>
						<th>Student Name</th>
						<th>Course</th>
						<th>Time</th>
						<th>Status</th>
					</tr>

			';
			while ($row = $export->fetch_array()) {
				$output .='

					<tr>
						<td>'.$row['id_number'].'</td>
						<td>'.$row['fullname'].'</td>
						<td>'.$row["course"].'</td>
						<td>'.$row["time"].'</td>
						<td>'.$row["status"].'</td>
					</tr>
				';
			}
			$output .= '</table>';
			header("Content-Type: application/xls");
			header("Content-Disposition: attachment; filename=attendance.xls");

			echo $output;
		}
	}

?>