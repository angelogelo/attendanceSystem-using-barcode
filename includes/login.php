<?php  

  include'connection.php';

  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  $select = $connection->query("SELECT * FROM users WHERE username='$username'");
  if ($select->num_rows < 1) {
    echo "No Account";
  }else {
    $selectRow = $select->fetch_array();
    $passwordCheck = $selectRow['password'];

    $type = $selectRow['type'];

    if (password_verify($password, $passwordCheck)) {
      if ($type == "student") {
        $_SESSION['student'] = $username;

        $student = $connection->query("SELECT * FROM students WHERE id_number='$username'");
        $studentRow = $student->fetch_array();

        if ($studentRow['status'] == "pending" OR $studentRow['status'] == "deactivated") {
          echo "Pending";
          exit();
        }

      }else if ($type == "staff") {
        $_SESSION['staff'] = $username;

        $staff = $connection->query("SELECT * FROM accounts WHERE users_id='$username'");
        $staffRow = $staff->fetch_array();

        if ($staffRow['status'] == "pending") {
          echo "Pending";
          exit();
        }

        if ($staffRow['status'] == "deactivated") {
          echo "Deactivated";
          exit();
        }

      }else {
        $_SESSION['admin'] = $username;
      }

      echo $type;

    }else {
      echo "No Account";
    }
  }

?>