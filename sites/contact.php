<?php
		session_start();
		require 'check_if_added.php';
	    function check_if_puchased_item($item_id)
		{
        require 'connection.php';
        $user_id=$_SESSION['id'];
		$sql = "SELECT * FROM users_items WHERE item_id = :item_id AND user_id = :user_id AND purchase='1'"; 
		$result = $con->prepare($sql); 
		$result->execute(array('item_id'=>$item_id,'user_id'=>$user_id)); 
		$row_count =$result->rowCount(); 
        if($row_count>=1)
			return 1;
        return 0;
		}
		require 'connection.php';
		$sqls = "SELECT * FROM items"; 
		$results = $con->prepare($sqls);  
		$row_counts =$results->rowCount(); 
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
			<h4>Contact</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Contact</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-info">
					<h3>Get in touch</h3>
					<p>Main Str, no 23, New York</p>
					<p>+546 990221 123</p>
					<p>hosting@contact.com</p>
					<div class="contact-social">
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-behance"></i></a>
					</div>
					<form class="contact-form">
						<input type="text" placeholder="Your name">
						<input type="text" placeholder="Your e-mail">
						<input type="text" placeholder="Subject">
						<textarea placeholder="Message"></textarea>
						<button class="site-btn">SEND NOW</button>
					</form>
				</div>
			</div>
		</div>
		<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14376.077865872314!2d-73.879277264103!3d40.757667781624285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1546528920522" style="border:0" allowfullscreen></iframe></div>
	</section>
	<!-- Contact section end -->


	<!-- Related product section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Your Favourites</h2>
			</div>
			<div class="product-slider owl-carousel">
			<?php 
				$results->execute();
				while($row = $results->fetch(PDO::FETCH_ASSOC))
				{ ?>
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/<?php echo $row['path'];?>" alt="image">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>&#x20B9;<?php echo $row['price'];?></h6>
						<p><?php echo $row['name'];?></p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>

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
