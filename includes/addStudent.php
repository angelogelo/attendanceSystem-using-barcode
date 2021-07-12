<?php  
	
	include'connection.php';

	$picture_tmp = $_FILES['picture']['tmp_name'];
	$picture_name = $_FILES['picture']['name'];
	$picture = time()."_".$picture_name;

	$id_number = mysqli_real_escape_string($connection, $_POST['id_number']);
	$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
	$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
	$middle_name = mysqli_real_escape_string($connection, $_POST['middle_name']);
	$gender = mysqli_real_escape_string($connection, $_POST['gender']);
	$contact_no = mysqli_real_escape_string($connection, $_POST['contact_no']);
	$address = mysqli_real_escape_string($connection, $_POST['address']);
	$course = mysqli_real_escape_string($connection, $_POST['course']);
	$address = mysqli_real_escape_string($connection, $_POST['address']);

	$fullname = $first_name . ' ' . $last_name;


	$select = $connection->query("SELECT * FROM students_info WHERE id_number='$id_number'");

	if ($select->num_rows < 1) {
		
		$select_contact_no = $connection->query("SELECT * FROM students_info WHERE contact_no='$contact_no'");

		if ($select_contact_no->num_rows < 1) {
			
			if (move_uploaded_file($picture_tmp, '../includes/images/'.$picture)) {
				
				$insert = $connection->query("INSERT INTO students_info (picture, id_number, last_name, first_name, middle_name, gender, contact_no, address, course) VALUES ('$picture', '$id_number', '$last_name', '$first_name', '$middle_name', '$gender', '$contact_no', '$address', '$course')");

				if ($insert === TRUE) {
					
					$insert_logs = $connection->query("INSERT INTO students_logs (id_number, fullname, course) VALUES ('$id_number', '$fullname', '$course')");

					echo "Added";

				}else{
					echo "Failed";
				}
			}else{
				echo "Failed";
			}
		}else{
			echo "Contact Taken";
		}
		
	}else{

		echo "Taken";

	}

?>