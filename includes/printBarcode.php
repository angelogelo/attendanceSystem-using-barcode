<?php

  include 'includes/connection.php';

  include 'DBController.php';
  $db_handle = new DBController();
  $productResult = $db_handle->runQuery("select * from time_log");

  if (isset($_POST["export"])) {
      $filename = "Export_excel.xls";
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=\"$filename\"");
      $isPrintHeader = false;
      if (! empty($productResult)) {
          foreach ($productResult as $row) {
              if (! $isPrintHeader) {
                  echo implode("\t", array_keys($row)) . "\n";
                  $isPrintHeader = true;
              }
              echo implode("\t", array_values($row)) . "\n";
          }
      }
      exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Title -->
  <title>Student Attendance</title>

  <!-- Bootstrap 4.1.3 -->
  <link href="../ui-designs/print/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome 5.1.3 -->
  <link href="../ui-designs/print/font-awesome/css/all.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="../ui-designs/print/DataTables/datatables.min.css" rel="stylesheet">

  <!-- ToastR CSS -->
  <link href="../ui-designs/print/css/toastr.min.css" rel="stylesheet">

  <!-- Pro Sidebar CSS -->
  <link href="../ui-designs/print/css/pro-sidebar.css" rel="stylesheet">

  <link rel="icon" href="#">
  
  <!-- Style -->
  <style type="text/css">
    html,
    body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Raleway', sans-serif;
    }
  </style>
</head>

<body onafterprint="closeWindow()">
  <div class="container py-3">
    <div class="form-group row">
      <div class="col-md-12 text-center">
        <img src="#" style="height: 100px;">
        <br>
        <br>
        <h3><b>List of Attendance</b></h3>
        <h3><b></b></h3>
      </div>
    </div>

    <hr class="shadow">

    <div class="form-group row">
        <div class="col-md-12 table-responsive">
          <table class="table table-hover table-striped">
            <thead class="bg-danger text-white">
              <tr>

                <th>No</th>
                <th>Student Number</th>
                <th>Full Name</th>
                <th>Course</th>
                <th>Status</th>
                <th>Time</th>

              </tr>
            </thead>
            <tbody>
              
              <?php 

                $attendance = $connection->query("SELECT * FROM time_log");


                if ($attendance->num_rows < 1) {
                  ?>
                    <tr>

                      <td>No result(s)</td>
                      <td>No result(s)</td>
                      <td>No result(s)</td>
                      <td>No result(s)</td>
                      
                    </tr>
                  <?php
                }else {
                  $number = 1;
                  while ($row = $attendance->fetch_array()) {

              
              ?>

                <tr>
                  <td><?php echo $number++; ?></td>
                  <td><?php echo $row['idnum']; ?></td>
                  <td><?php echo $row['fullname']; ?></td>
                  <td><?php echo $row['position']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td><?php echo $row['time']; ?></td>
                  
                </tr>
            </tbody>
              <?php
                }
              }
            //}
            ?>

          </table>
        </div>
      </div>


  </div>

</body>

</html>

<!-- JQuery 3.3.1 -->
<script src="../ui-designs/print/js/jquery-3.3.1.js"></script>
<!-- Bootstrap JS -->
<script src="../ui-designs/print/js/bootstrap.bundle.min.js"></script>


<script type="text/javascript">
  setTimeout(function() {
    window.print();
  }, 1000);

  function closeWindow() {
    window.close();
  }
</script>