<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    $user_id=$_SESSION['id'];
	$sql = "SELECT it.id,it.name,it.price FROM users_items ut INNER JOIN items it ON it.id=ut.item_id WHERE ut.user_id = :user_id AND ut.purchase='1'"; 
	$result = $con->prepare($sql); 
	$result->execute(array('user_id'=>$user_id)); 
	$row_count =$result->rowCount();
    $sum=0;
    if($row_count==0){
		header('location: cart_empty.php');
    }else{
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $sum=$sum+$row['price']; 
       }
    }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>CIVIL ENGINEERING DEPARTMENT</title>
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


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your Purchased items</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">My Items</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Your items</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Item No.</th>
									<th class="product-th">Product</th>
									<th class="total-th">Price</th>
									<th class="total-th"></th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$result = $con->prepare("SELECT it.id,it.name,it.path,it.price FROM users_items ut INNER JOIN items it ON it.id=ut.item_id WHERE ut.user_id = :user_id AND ut.purchase='1'"); 
								$result->execute(array('user_id'=>$user_id));
								$counter=1;
								while($row = $result->fetch(PDO::FETCH_ASSOC)){
							?>
								<tr>
									<td><?php echo $counter ?></td>
									<td class="product-col">
										<img src="img/<?php echo $row['path'] ?>" alt="">
										<div class="pc-title">
											<h4><?php echo $row['name']?></h4>
											<p>&#x20B9;<?php echo $row['price']?></p>
										</div>
									</td>
									<td class="total-col"><h4>&#x20B9;<?php echo $row['price']?></h4></td>
									<td><button class="class" onclick="window.location.href='https://drive.google.com/uc?export=download&id=12iPbFLHRlYwNNXS3DllRL7yBVp0TpcKi'">Download</button></td>
								</tr>
								<?php $counter=$counter+1; } ?>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

	<!-- Related product section -->


	<!-- Related product section end -->



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