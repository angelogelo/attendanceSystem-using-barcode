<?php 

	include 'includes/header.php'; 
	include 'includes/connection.php';

	date_default_timezone_set('Asia/Manila');

	if (isset($_POST['submit'])) {

    $time = date("h:i:s A");
    $idnum = $_POST['barcode'];

    $select = $connection->query("SELECT * FROM students_info WHERE id_number='$idnum'");
    $pictureRow = $select->fetch_array();

    if ($select->num_rows > 0) {

      $check = $connection->query("SELECT * FROM students_logs WHERE id_number='$idnum' AND status = 0");
      $studentRow = $check->fetch_array();

      if ($check->num_rows > 0) {
        
        $update = $connection->query("UPDATE students_logs SET status = 1 WHERE id_number='$idnum'");

        if ($update === TRUE) {
          
          $fullname = $studentRow['fullname'];
          $course = $studentRow['course'];

          $insertLogin = mysqli_query($connection,"INSERT INTO time_log (fullname, id_number, course, status, `time`) VALUES ('$fullname', '$idnum', '$course', 'time-in','$time')");

          $_SESSION['success'] = 'Student now Log-in!';
          
        }
        
      }else{

        $checking = $connection->query("SELECT * FROM students_logs WHERE id_number='$idnum' AND status = 1");
        $studentRows = $checking->fetch_array();

        if ($checking->num_rows > 0) {

          $updating = $connection->query("UPDATE students_logs SET status = 0 WHERE id_number='$idnum'");

          if ($updating === TRUE) {

             $fullname = $studentRows['fullname'];
             $course = $studentRows['course'];

             $insertLogout = mysqli_query($connection,"INSERT INTO time_log (fullname, id_number, course, status, `time`) VALUES ('$fullname', '$idnum', '$course', 'time-out','$time')");

             
          $_SESSION['error'] = 'Student have log-out!';
          }
        }
        
      }

      }else{

        $_SESSION['not_found'] = 'Student not Found!';

      }
            
    } 
?>



<body style="background: #00416A;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #E4E5E6, #00416A);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #E4E5E6, #00416A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">


<div class="container-fluid"><hr>

	<?php
	    if(isset($_SESSION['error'])){
	      ?>
	    <div class="row vertical-offset-100">
	      <div class="col-md-6 col-md-offset-3">
	        <div style="z-index: 1000; course: relative;">
	          <div class="panel panel-danger">
	            <div class="panel-heading" style="color: black;" >             
	                <center>
	                  <h3 class="panel-title" style="color: red;"><b>Student have Log-out!</b></h3>
	                </center>
	            </div>

	            <div class=" panel-body">
	              <div class="col-lg-4">
	                <img src="includes/images/<?php echo $pictureRow['picture']; ?>" style="height: 100px; width: 100px;">
	              </div>
	              <div class="col-lg-8">
	                <h4>Name : <?php echo $fullname; ?></h4>
	                <h4>Course : <?php echo $course; ?></h4>
	                <h4>Time : <?php echo $time; ?></h4>
	              </div>
	            </div>

	          </div>
	        </div>
	      </div>
	    </div>
	    <?php
	      unset($_SESSION['error']);
	    }


	    if(isset($_SESSION['success'])){
	      ?>
	      <div class="row vertical-offset-100">
	        <div class="col-md-6 col-md-offset-3">
	          <div style="z-index: 1000; position: relative;">
	            <div class="panel panel-success">
	              <div class="panel-heading" style="color: black;">             
	                  <center>
	                    <h3 class="panel-title" style="color: green;"><b>Student now Log-in!</b></h3>
	                  </center>
	              </div>

	              <div class=" panel-body">
	                <div class="col-lg-4">
	                  <img src="includes/images/<?php echo $pictureRow['picture']; ?>" style="height: 100px; width: 100px;">
	                </div>
	                <div class="col-lg-8">
	                  <h4>Name : <?php echo $fullname; ?></h4>
	                  <h4>Course : <?php echo $course; ?></h4>
	                  <h4>Time : <?php echo $time; ?></h4>
	                </div>
	              </div>

	            </div>
	          </div>
	        </div>
	      </div>
	    <?php
	        unset($_SESSION['success']);
	      }

	    if (isset($_SESSION['not_found'])) {

	      ?>
	        <div class="row vertical-offset-100">
	          <div class="col-md-6 col-md-offset-3">
	            <div style="z-index: 1000; position: relative;">
	              <div class="panel panel-info">
	                <div class="panel-heading" style="color: black;" >             
	                    <center>
	                      <h3 class="panel-title" style="color: red;"><b>Student not found. </b></h3>
	                    </center>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      <?php

	      unset($_SESSION['not_found']);
	      
	    }
    ?>
	<!-- Main content -->
	<section class="content">
	  <div class="row">
	  	<div class="col-lg-6">
	  		<center>
		  		<h2 class="line anim-typewriter" style="color: black;"><b>SMHS ATTENDANCE SYSTEM USING BARCODE</b></h2>
		  	</center>
	      <div class="box" style="border: 4px solid black;">
	        <form method="POST" action="attendance.php" id="inventForm">
	          <div class="box-header with-border">  
	            <div class="input-group">
                  <input type="text" name="barcode" class="form-control input-lg" id="searchBox" maxlength="8" placeholder="Scan for barcode only!" autocomplete="off" required autofocus>
                  <span class="input-group-btn">
                      <input type="submit" value="SCAN" name="submit" id="submit" class="btn btn-danger btn-flat btn-lg">
                  </span>
	            </div>
	          </div>
	        </form>

	        <center>
	          <div id="clockdate">
	            <div class="clockdate-wrapper">
	              <div id="clock" class="h1" style="font-weight: bold;"></div>
	              <div id="date"><b><?php echo date('l, F j, Y'); ?></b></div>
	            </div>
	          </div>
	          <img src="includes/images/logo1.png" style="width: 400px;">
	        </center>

	      </div>
	    </div>

	    <div class="col-lg-6">
	    	<center>
		  		<h2 class="line anim-typewriter" style="color: black;"><b>Logs</b></h2>
		  	</center>
	    	<div class="box" style="border: 4px solid black;">
	    		<div class="modal-body">
		          <table class="table table-bordered table-striped dt-responsive nowrap" id="example1">
		            <thead>
		              <th>Date</th>
		              <th>Student Name</th>
		              <th>Course</th>
		              <th>Time</th>
		              <th>Status</th>
		            </thead>
		            <tbody>
		              <?php

		              $student = $connection->query("SELECT * FROM time_log WHERE date(`date`) = curdate() ORDER BY id DESC LIMIT 1000");

		              if ($student->num_rows < 1) {
		                ?>
		                  <tr>
		                    <td>No result(s)</td>
		                    <td>No result(s)</td>
		                    <td>No result(s)</td>
		                    <td>No result(s)</td>
		                    <td>No result(s)</td>
		                  </tr>
		                <?php
		              }else {
		                while ($studentRow = $student->fetch_array()) {

		              ?>
		              <tr>
		                <td><?=date('M d, Y', strtotime($studentRow['date']));?></td>
		                <td><?=$studentRow['fullname'];?></td>
		                <td><?=$studentRow['course'];?></td>
		                <td><?=$studentRow['time'];?></td>
		                <td>
		                  <?php  
		                if ($studentRow['status'] == 'time-in') {
		                  ?>
		                    <p style="color: green;">time-in</p>
		                  <?php
		                }else{
		                  ?>
		                  <p style="color: red;">time-out</p>
		                  <?php
		                }
		              ?>
		                </td>
		              </tr>
		              <?php
		                }
		              }
		              ?>
		            </tbody>
		          </table>
		        </div><!--closed modal-body -->
	    	</div>
	    </div>
	  </div>
	</section>

	




</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>