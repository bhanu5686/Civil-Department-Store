<?php
    require 'connection.php';
	if(!isset($_GET["key"]) || !isset($_GET["reset"])){
        exit("<center><h1>Page not exist...</h1></center>");
    }
	$email=$_GET["key"];
	$token=$_GET["reset"];
	
	$sql = "SELECT valid FROM reset WHERE email = :email AND tokenid = :tokenid"; 
	$result = $con->prepare($sql); 
	$result->execute(array('email'=>$email,'tokenid'=>$token)); 
	$row_count =$result->rowCount(); 
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();
	if($row_count==0 || $row['valid']==1)
	{
		header("Location: notExist.php");
	}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Civil Enginnering Department</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
		<?php
            require 'header.php';
         ?>
	<!-- Header section end -->



<div class="form1">
	<div class="container">
	<div class="row">
	<div class="col-lg-6 form-info">
		<h3>Reset Password</h3>
		<form method="post" action="reset_submit.php" class="needs-validation" novalidate>
		
		<input type="hidden" class="form-control" name="email_id" value="<?php echo $email; ?>">
		<input type="hidden" class="form-control" name="token_id" value="<?php echo $token; ?>">

			<div class="form-group">
				<label for="newpass">New Password:</label>
				<input type="password" class="form-control" id="newpass" placeholder="New password" name="newPassword" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<div class="form-group">
				<label for="retypepass">Confirm Password:</label>
				<input type="password" class="form-control" id="retypepass" placeholder="New password" name="retype" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<div class="form-par">
		<p>Forgot password? <a href="forgot.php">Forgot Password</a></p>
        <p>Don't have an account yet? <a href="signup.php">Register</a></p>
		</div>
		<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
		
		
		</div>
	</div>
	</div>
</div>














	<!-- Footer section -->
		<?php
            require 'header2.php';
         ?>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>