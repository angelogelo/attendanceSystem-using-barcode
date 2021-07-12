<!DOCTYPE html>
<html>
<head>

	<title>LOG IN PAGE</title>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
		
    <!-- Custom fonts for this template-->
    <link href="ui-designs/start/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="ui-designs/start/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="includes/images/logo1.png">

    <style>

	.content {
	  padding: 0 18px;
	  display: none;
	  overflow: hidden;
	  background-color: #f1f1f1;
	}
	</style>

</head>
<body style="background: #00416A;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #E4E5E6, #00416A);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #E4E5E6, #00416A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">


	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0 border-left-success shadow h-100 py-2">
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
	                                <div class="text-center">
	                                    <img src="includes/images/logo1.png" style="width: 300px;">
	                                    <h3><b style="color: black;">Log-</b>In</h3>
	                                    <hr>
	                                    <form class="user" method="POST" action="" id="loginForm">
	                                    	<div class="form-group">
	                                            <input type="text" class="form-control form-control-user"
	                                                placeholder="Username...." name="username">
	                                        </div>

	                                        <div class="form-group">
	                                            <input type="password" class="form-control form-control-user"
	                                                placeholder="Password...." name="password">
	                                        </div>
	                                        <hr>
	                                        <div class="row">
		                                        <div class="col-lg-12">
		                                        	<button type="submit" class="btn btn-success btn-user btn-block btn-sm" id="loginButton">Login</button>
		                                        </div>
		                                    </div>
		                                    
	                                    </form>
	                                </div>
	                            </div>	                        
	                        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Bootstrap core JavaScript-->
    <script src="ui-designs/start/vendor/jquery/jquery.min.js"></script>
    <script src="ui-designs/start/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="ui-designs/start/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="ui-designs/start/js/sb-admin-2.min.js"></script>
    <script src="ui-designs/sweetalert.min.js"></script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#loginForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData($(this)[0]);

      $('#loginButton').text("Logging in");

      $.ajax({
        url: "includes/login.php",
        method: "POST",
        dataType: "TEXT",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data) {
          //console.log(data);
          $('#loginButton').text("Login");
          if (data == "No Account") {
            swal({
              title: "Account not found, please check your spelling and try again.",
              icon: "error"
            }).then(function(){
              $('#loginButton').val("Log in");
            });
          }else if (data == "Deactivated") {
            swal({
              title: "Opps, your account has been deactivated. Contact the administrator",
              icon: "warning"
            });
          }else if (data == "Pending") {
            swal({
              title: "Opps, your account is still pending. Please wait for it to be approval of the boss.",
              icon: "warning"
            });
          }else {
            if (data == "student") {
              
            }else {
              swal({
                 type: 'success',
                 title: "Welcome!",
                 icon: "includes/images/logo1.png"
               }).then(function(){
                 window.location.href = 'admin/index.php';
               });
            }
          }
        }
      });
    });
  });
</script>