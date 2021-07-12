<?php 

  include 'inventory/connection.php'; 

  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['submit'])) {

    $time = date("h:i:s A");
    $idnum = $_POST['barcode'];

    $select = $connection->query("SELECT * FROM students WHERE id_number='$idnum'");
    $pictureRow = $select->fetch_array();

    if ($select->num_rows > 0) {

      $check = $connection->query("SELECT * FROM employee_info WHERE idnum='$idnum' AND status = 0");
      $studentRow = $check->fetch_array();

      if ($check->num_rows > 0) {
        
        $update = $connection->query("UPDATE employee_info SET status = 1 WHERE idnum='$idnum'");

        if ($update === TRUE) {
          
          $fullname = $studentRow['fullname'];
          $position = $studentRow['position'];

          $insertLogin = mysqli_query($connection,"INSERT INTO time_log (fullname, idnum, position, status, `time`) VALUES ('$fullname', '$idnum', '$position', 'time-in','$time')");

          $_SESSION['success'] = 'Student now Log-in!';
          
        }
        
      }else{

        $checking = $connection->query("SELECT * FROM employee_info WHERE idnum='$idnum' AND status = 1");
        $studentRows = $checking->fetch_array();

        if ($checking->num_rows > 0) {

          $updating = $connection->query("UPDATE employee_info SET status = 0 WHERE idnum='$idnum'");

          if ($updating === TRUE) {

             $fullname = $studentRows['fullname'];
             $position = $studentRows['position'];

             $insertLogout = mysqli_query($connection,"INSERT INTO time_log (fullname, idnum, position, status, `time`) VALUES ('$fullname', '$idnum', '$position', 'time-out','$time')");

             
          $_SESSION['error'] = 'Student have log-out!';
          }
        }
        
      }

      }else{

        $_SESSION['not_found'] = 'Student not Found!';

      }
            
    }

?>

<?php include 'inventory/header.php'; ?>

<!-- <style type="text/css">

 .line{

    position: relative;
    top: 50%;
    width: 16rem;
    margin: 0 auto;
    border-right: 2px solid rgba(255, 255, 255, 0.75);
    font-size: 180%;
    text-align: ;
    white-space: nowrap;
    overflow: hidden;transform: translateY(10%);
 }

 .anim-typewriter{

    animation: typewriter 4s steps(40) 1s 1 normal both, 
    blinkTextCursor 500ms steps(40) infinite normal;
 }

 @keyframes typewriter{

  from{
    width: 0;
  }
  to{
    width: 16em;
  }

 }

 @keyframes blinkTextCursor {

    from{

      border-right-color: rgba(255, 255, 255, 0.75);
    }
    to{
      border-right-color: transparent;
    }
 }

</style> -->


<body style="background: #f85032;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #e73827, #f85032);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #e73827, #f85032); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
  <div class="container"><hr>

    <?php
    if(isset($_SESSION['error'])){
      ?>
    <div class="row vertical-offset-100">
      <div class="col-md-6 col-md-offset-3">
        <div style="z-index: 1000; position: relative;">
          <div class="panel panel-danger">
            <div class="panel-heading" style="color: black;" >             
                <center>
                  <h3 class="panel-title" style="color: red;"><b>Student have Log-out!</b></h3>
                </center>
            </div>

            <div class=" panel-body">
              <div class="col-lg-4">
                <img src="images/students/<?php echo $pictureRow['picture']; ?>" style="height: 100px; width: 100px;">
              </div>
              <div class="col-lg-8">
                <h4>Name : <?php echo $fullname; ?></h4>
                <h4>Course : <?php echo $position; ?></h4>
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
                  <img src="images/students/<?php echo $pictureRow['picture']; ?>" style="height: 100px; width: 100px;">
                </div>
                <div class="col-lg-8">
                  <h4>Name : <?php echo $fullname; ?></h4>
                  <h4>Course : <?php echo $position; ?></h4>
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
        <div class="col-lg-12">
          <div class="box" style="border: 4px solid black;">
            <form method="POST" action="attendance.php" id="inventForm">
              <div class="box-header with-border">  
                <div class="input-group">
                      <input type="text" name="barcode" class="form-control input-lg" id="searchBox" maxlength="8" placeholder="Scan for barcode only. No typing!" autocomplete="off" required autofocus>
                      <span class="input-group-btn">
                          <input type="submit" value="SCAN" name="submit" id="submit" class="btn btn-danger btn-flat btn-lg">
                      </span>
                  </div>
              </div>
            </form>

            <!-- <div class="box-body">

            </div> -->
          </div>
        </div>
      </div>
    </section>
    
    <section class="content" style="margin-top: -150px;">
      <div class="box" style="border: 4px solid black;">

        <center>
          <h2 class="line anim-typewriter"><b>URDANETA CITY UNIVERSITY- PEDRO T. ORATA LIBRARY</b></h2>

          <div id="clockdate">
            <div class="clockdate-wrapper">
              <div id="clock" class="h1" style="font-weight: bold;"></div>
              <div id="date"><b><?php echo date('l, F j, Y'); ?></b></div>
            </div>
          </div>

        </center>

        <div class="box-body">
          <center>
            <div class="col-lg-6">
              <img src="images/ucu-rotate100.gif" style="width: 200px;">
            </div>

            <div class="col-lg-6">
              <img src="images/orata-logo.jpg" style="width: 200px;">
            </div>
          </center>
        </div>

        <center>
            <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#checkLogs" style="color: black;"><i class="fa fa-print" style="color: black;"></i> | Check Logs</button>
        </center>

        <br>
      </div>
    </section>



<div class="modal fade" id="checkLogs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">         
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red;">
        <h4 class="modal-title" id="myLargeModalLabel" style="color: white;"><i class="fa fa-info-circle"></i> | Logs for Today</h4>
      </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped dt-responsive nowrap" id="booklist">
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
                <td><?=$studentRow['position'];?></td>
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

        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> | Close</button>
          <a href="print.php" type="button" class="btn btn-success btn-sm"><i class="fa fa-print"></i> | Print</a>
        </div>
    </div>
  </div>
</div>


  </div>
<?php include 'inventory/scripts.php'; ?>

<script>
  $('#searchBox').keyup(function(){
      if(this.value.length ==8){
      $('#submit').click();
      }
  });
</script>​


<script type="text/javascript">
  /* Navbar ClockDate */

setInterval(startTime, 500);

function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>



</body>
</html>
