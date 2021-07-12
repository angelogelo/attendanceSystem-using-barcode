<?php 
    include 'header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addStudents"><i class="fa fa-plus"></i> | Add Students</button><br><br>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Number</th>
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Gender</th>
                            <th>Contact No</th>
                            <th>Address</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                          $student = $connection->query("SELECT * FROM students_info ORDER BY id DESC LIMIT 1000");

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
                            <td>
                                <?php  
                                    if ($studentRow['picture'] == "none" || $studentRow['picture'] == NULL) {
                                        ?>
                                            <img src="../includes/images/no_image.png" class="img-fluid rounded" style="width: 50px; height: 50px;">
                                        <?php
                                    }else {
                                        ?>
                                            <img src="../includes/images/<?php echo $studentRow['picture']; ?>" class="img-fluid rounded" style="width: 50px; height: 50px;">
                                        <?php
                                    }
                                ?>
                            </td>
                            
                            <td><?php echo $studentRow['last_name'].", ".$studentRow['first_name']." ".$studentRow['middle_name']; ?></td>
                            <td><?=$studentRow['course'];?></td>
                            <td><?=$studentRow['gender'];?></td>
                            <td><?=$studentRow['contact_no'];?></td>
                            <td><?=$studentRow['address'];?></td>
                            <td><?=date('M d, Y', strtotime($studentRow['created_at']));?></td>
                        </tr>
                            <?php
                            }
                          }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->

<!-- Add modal -->
<div class="modal fade" id="addStudents" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">         
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel" ><i class="fa fa-info-circle" style="color: black;"></i> Student Information</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: red;">×</button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="addStudentForm">
                <div class="modal-body">

                    <center>
                        <div class="form-group row">
                            <div class="col-md-5 mx-auto">
                                <img id="picture_display" class="img-fluid rounded-circle" style="border: 4px solid; color: green;" src="#" style="display: none;" alt="">
                            </div>
                        </div>
                    </center>


                    <div class="form-group row">
                        <div class="col-md-4">
                            <p class="h6">Picture:</p>
                                <div class="custom-file">
                                    <input type="file" name="picture" id="picture" class="custom-file-input form-control-sm" accept="image/*">
                                        <label class="custom-file-label">Choose picture</label>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <p class="h6">ID Number:</p>
                                <input type="number" name="id_number" id="id_number" class="form-control form-control-sm" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <p class="h6">Gender:</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="gender" id="gendermale" class="custom-control-input" value="Male" required>
                                        <label class="custom-control-label" for="gendermale">Male</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="gender" id="genderfemale" class="custom-control-input" value="Female" required>
                                        <label class="custom-control-label" for="genderfemale">Female</label>
                                </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <p class="h6" style="color: black;">Last Name</p>
                                <input type="text" name="last_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <p class="h6" style="color: black;">First Name</p>
                                <input type="text" name="first_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <p class="h6" style="color: black;">Middle Name</p>
                                <input type="text" name="middle_name" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <p class="h6" style="color: black;">Course Initial</p>
                                <input type="text" name="course" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <p class="h6" style="color: black;">Contact No.</p>
                                <input type="text" name="contact_no" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-4">
                            <p class="h6" style="color: black;">Address</p>
                                <input type="text" name="address" class="form-control form-control-sm" required>
                        </div>
                    </div>

                </div><!--closed modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> | Close</button>
                    <button type="submit" name="btnAdd" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> | Add Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

<script type="text/javascript">
    
    $(document).ready(function(){

        function readURL(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#picture_display').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            }
        }

        $("#picture").change(function(){
            $('#picture_display').show();
          readURL(this);
        });


        $('#addStudentForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "../includes/addStudent.php",
                method: "POST",
                dataType: "TEXT",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                    //console.log(data);
                    if (data == "Taken") {
                        swal({
                            title: "Student already exist.",
                            icon: "warning"
                        });

                    }else if (data == "Contact taken") {
            swal({
              title: "Contact number is taken. Please choose another one.",
              icon: "warning"
            });

          }else if (data == "Failed") {
                        swal({
                            title: "Failed to add new student. Please try again later.",
                            icon: "error"
                        });

                    }else {
                        swal({
                            title: "New student has been added.",
                            icon: "success"
                        }).then(function(){
                            location.reload();
                        });
                    }
                }
            })
        });

    }); //close ready function

</script>