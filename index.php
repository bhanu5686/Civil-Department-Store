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
		$sqls = "SELECT * FROM items LIMIT 8"; 
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
	<a id="backbutton"></a>
	<!-- Header section -->
		<?php
            require 'header.php';
         ?>
	<!-- Header section end -->



	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/bg.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<h3>CIVIL ENGINEERING DEPARTMENT</h3>
							<p>To offer world-class undergraduate and post-graduate education, research guidance, professional consultancy, outreach and manpower training as well as leadership in Civil Engineering. </p>
							<a href="category.php" class="site-btn sb-white">DISCOVER</a>
						</div>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="img/bg-2.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<h3>CIVIL ENGINEERING DEPARTMENT</h3>
							<p>To offer world-class undergraduate and post-graduate education, research guidance, professional consultancy, outreach and manpower training as well as leadership in Civil Engineering. </p>
						<a href="category.php" class="site-btn sb-white">DISCOVER</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->



	<!-- Features section -->
	<section class="features-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/1.png" alt="#">
						</div>
						<h2>Fast Secure Payments</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/2.png" alt="#">
						</div>
						<h2>Premium Products</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/3.png" alt="#">
						</div>
						<h2>Fast & secure Downloading</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->


	<!-- letest product section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>LATEST PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">
				<?php 
				$results->execute();
				while($row = $results->fetch(PDO::FETCH_ASSOC))
				{ $ID = $row['id']; ?>
				<div class="product-item">
					<div class="pi-pic">
					<a href="product.php?id=<?php echo $ID;?>"><img class="lozad" data-src="./img/<?php echo $row['path'];?>" alt="image"></a>
					<?php if(!isset($_SESSION['email'])){  ?>
					<div class="pi-links">
						<a href="login.php" class="add-card"><i class="flaticon-bag"></i><span>Buy Now</span></a>
						<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
					</div>
					<?php
					}
                    else
					{
						if(check_if_puchased_item($ID))
						{
							echo '<div class="tag-sale">Purchased</div>';
						}
						else
						{	
							if(check_if_added_to_cart($ID))
							{
								echo '<div class="tag-sale">Added to cart</div>';
							
							}
							else
							{ 
							?>
							<div class="pi-links">
							<a href="cart_add.php?id=<?php echo $ID;?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="product.php?id=<?php echo $ID;?>" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
							<?php
							}
						}
						
					}
					?>	
					</div>
					<div class="pi-text">
						<h6>&#x20B9;<?php echo $row['price'];?></h6>
						<a href="product.php?id=<?php echo $ID;?>"><p><?php echo $row['name'];?></p></a>
					</div>
				</div>
				<?php 
				}
				?>

			</div>
		</div>
	</section>
	<!-- letest product section end -->



	<!-- Product filter section -->
	<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>BROWSE TOP SELLING PRODUCTS</h2>
			</div>
			<ul class="product-filter-menu">
				<li><a href="#">TOPS</a></li>
				<li><a href="#">JUMPSUITS</a></li>
				<li><a href="#">LINGERIE</a></li>
				<li><a href="#">JEANS</a></li>
				<li><a href="#">DRESSES</a></li>
				<li><a href="#">COATS</a></li>
				<li><a href="#">JUMPERS</a></li>
				<li><a href="#">LEGGINGS</a></li>
			</ul>
			<?php 
			$results->execute(); 
			?>
			<div class="row" id="load_data_table">
			<?php
			while($row = $results->fetch(PDO::FETCH_ASSOC))
			{ $ID = $row['id']; ?>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href="product.php?id=<?php echo $row['id'];?>"><img class="lozad" data-src="./img/<?php echo $row['path'];?>" alt="image"></a>
					<?php if(!isset($_SESSION['email'])){  ?>
					<div class="pi-links">
						<a href="login.php" class="add-card"><i class="flaticon-bag"></i><span>Buy Now</span></a>
						<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
					</div>
					<?php
					}
                    else
					{
						if(check_if_puchased_item($ID))
						{
							echo '<div class="tag-sale">Purchased</div>';
						}
						else
						{	
							if(check_if_added_to_cart($ID))
							{
								echo '<div class="tag-sale">Added to cart</div>';
							
							}
							else
							{ 
							?>
							<div class="pi-links">
							<a href="cart_add.php?id=<?php echo $ID;?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
							<?php
							}
						}
						
					}
					?>
						</div>
						<div class="pi-text">
							<h6>&#x20B9;<?php echo $row['price'];?></h6>
							<a href="product.php?id=<?php echo $ID;?>"><p><?php echo $row['name'];?></p></a>
						</div>
					</div>
				</div>
				<?php 
				$video_id = $row["id"];
			} ?>
			<div id="remove_row" class="text-center w-100 pt-3">  
                         <button type="button" name="btn_more" data-vid="<?php echo $video_id; ?>" id="btn_more" class="site-btn sb-line sb-dark">LOAD MORE</button> 
             </div> 
		</div>

			
		</div>
	</section>
	<!-- Product filter section end -->


	<!-- Banner section -->
	<section class="banner-section">
		<div class="container">
			<div class="banner set-bg" data-setbg="img/architect.jpg">
				<a href="category.php" class="site-btn">SHOP NOW</a>
			</div>
		</div>
	</section>
	<!-- Banner section end  -->


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

<script>  
 $(document).ready(function(){  
      $(document).on('click', '#btn_more', function(){  
           var last_video_id = $(this).data("vid");  
           $('#btn_more').html("Loading...");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{last_video_id:last_video_id},  
                dataType:"text",  
                success:function(data)  
                {  
                     if(data != '')  
                     {  
                          $('#remove_row').remove();  
                          $('#load_data_table').append(data);  
                     }  
                     else  
                     {  
                          $('#btn_more').html("No Data");  
                     }  
                }  
           });  
      });  
 });  
 </script>
 
     <script crossorigin="anonymous"
        src="https://polyfill.io/v3/polyfill.min.js?flags=gated&features=Object.assign%2CIntersectionObserver"></script>
    <!-- Toastr resources for Notifications -->
	<script src="js/lozad.min.js"></script>
    <script type="text/javascript">
 
    var observer = lozad('.lozad', {
        threshold: 0.1
    })

    // Background observer
    // with default `load` method
 

    observer.observe()
    backgroundObserver.observe()

    </script>


	</body>
</html>
