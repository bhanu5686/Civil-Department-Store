<?php
	session_cache_limiter('private_no_expire:');
    session_start();
    require 'connection.php';
        $user_id=$_GET["id"];
		$order_id=$_GET["orderid"];
	$sql = "SELECT purchased,valid FROM user_order WHERE orderid = :orderid AND userid = :userid"; 
	$result = $con->prepare($sql); 
	$result->execute(array('orderid'=>$order_id,'userid'=>$user_id)); 
	$row_count =$result->rowCount(); 
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();
		if($row_count==0 || $row['purchased']==1 || $row['valid']==1)
		{
			header("Location: notExist.php");
		}
		else
		{
		$stmt = $con->prepare("UPDATE user_order SET purchased=1,valid=1 WHERE orderid = :orderid AND userid = :userid"); 
		$stmt->bindParam(':orderid', $orderid);
		$stmt->bindParam(':userid', $userid);
		$orderid = $order_id;
		$userid = $user_id;
		$stmt->execute();
		
		$stmts = $con->prepare("UPDATE users_items SET status='Confirmed',purchase=1 WHERE user_id = :userid"); 
		$stmts->bindParam(':userid', $userid);
		$userid = $user_id;
		$stmts->execute();	
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
		<h3>Your order is confirmed. Thank you for shopping with us. <a href="product.php">Click here</a> to purchase any other item.</h3>
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