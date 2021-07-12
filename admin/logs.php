<?php 

    include 'header.php'; 

     

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Select Date First!</h6>
                </div>
                <form method="POST" action="logs.php">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <p class="h6">Select Date</p>
                                    <input class="form-control" type="date" name="load">
                                </div>
                                <center>
                                    <button class="btn btn-primary btn-sm" name="loadTable"><i class="fas fa-refresh fa-sm text-white-50"></i>
                                    Load Logs
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Export To Excel</h6>
                </div>
                <form method="POST" action="../includes/exportExcel.php">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <p class="h6">Select Date</p>
                                    <input class="form-control" type="date" name="export">
                                </div>
                                <center>
                                    <button class="btn btn-success btn-sm" name="export_excel"><i class="fas fa-download fa-sm text-white-50"></i> Generate Excel Report</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Time Logs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Number</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                          if (isset($_POST['loadTable'])) {
        
                          $load = $_POST['load'];
                        
                          $student = $connection->query("SELECT * FROM time_log WHERE date(`date`) = '$load' ORDER BY id");

                          if ($student->num_rows < 1) {
                            ?>
                              <tr>
                                <td>No result(s)</td>
                                <td>No result(s)</td>
                                <td>No result(s)</td>
                                <td>No result(s)</td>
                                <td>No result(s)</td>
                                <td>No result(s)</td>
                                <td>No result(s)</td>
                              </tr>
                            <?php
                          }else {
                            $number = 1;
                            while ($studentRow = $student->fetch_array()) {

                           
                          ?>
                        <tr>
                            <td><?php echo $number++; ?></td>
                            <td><?=$studentRow['id_number'];?></td>
                            <td><?=$studentRow['fullname'];?></td>
                            <td><?=$studentRow['course'];?></td>
                            <td><?=$studentRow['status'];?></td>
                            <td><?=date('M d, Y', strtotime($studentRow['date']));?></td>
                            <td><?=date('M d, Y', strtotime($studentRow['time']));?></td>
                        </tr>
                            <?php
                            }
                          }
                           }  
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->


<?php include 'footer.php'; ?>