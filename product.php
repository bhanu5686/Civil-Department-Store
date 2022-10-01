<?php
		session_start();
		if(isset($_GET["id"])){
		$itemid=$_GET["id"];
		}
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

<style>
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  transition: 0.3s;
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
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
			<h4>Category PAge</h4>
			<div class="site-pagination">
				<a href="index.php"><strong>Home</strong></a> /
				<a>Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->
<div id="myModal" class="modal">
  <div class="close"></div>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="./category.php"> &lt;&lt; Back to Category</a>
			</div>
			<div class="row">
				<?php 
				$resultts = $con->prepare("SELECT * FROM items where id='$itemid'"); 
				$resultts->execute();
				$row = $resultts->fetch(PDO::FETCH_ASSOC);
				 ?>
				<div class="col-lg-6 col-sm-6">
						
							<img id="myImg" src="img/<?php echo $row['path'];?>" alt="<?php echo $row['name'];?>" style="width:100%;object-fit:cover;">
						
						<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
						<?php
						$resullt = $con->prepare("SELECT ut.loc FROM thumbs ut INNER JOIN items it ON it.id = ut.itemid WHERE ut.itemid = :item_id"); 
						$resullt->execute(array('item_id'=>$itemid)); 
						$resullt->execute();
							while($rows = $resullt->fetch(PDO::FETCH_ASSOC))
							{ ?>
							<div class="pt" data-imgbigurl="img/thumbs/<?php echo $rows['loc'] ?>"><img src="img/thumbs/<?php echo $rows['loc'] ?>" alt=""></div>
					<?php   }
						?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?php echo $row['name'];?></h2>
					<h3 class="p-price">&#x20B9;<?php echo $row['price'];?></h3>
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o fa-fade"></i>
					</div>
					
					<?php if(!isset($_SESSION['email'])){  ?>
					<div class="pi-links">
						<a href="login.php" class="site-btn">BUY NOW</a>
					</div>
					<?php
					}
                    else
					{
						$ID = $itemid;
						if(check_if_puchased_item($ID))
						{
							echo '<a href="#" class="site-btn btn btn-primary disabled">Purchased</a>';
						}
						else
						{	
							if(check_if_added_to_cart($ID))
							{
								echo '<a href="#" class="site-btn">SHOP NOW</a>';
								echo '<a href="cart_add.php?id=<?php echo $ID;?>" class="site-btn btn btn-primary disabled">ADDED TO CART</a>';
							
							}
							else
							{ 
							?>
							<a href="#" class="site-btn">SHOP NOW</a>
							<a href="cart_add.php?id=<?php echo $ID;?>&pid=<?php echo mt_rand(100,999)?>" class="site-btn">ADD TO CART</a>
							<?php
							}
						}
						
					}
					?>
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
									<p>Approx length 66cm/26" (Based on a UK size 8 sample)</p>
									<p>Mixed fibres</p>
									<p>The Model wears a UK size 8/ EU size 36/ US size 4 and her height is 5'8"</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="./img/cards.png" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
						<div class="panel">
								<div class="panel-body">
									<h4>Non Refundable</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="social-sharing">
						<a href=""><i class="fa fa-google-plus"></i></a>
						<a href=""><i class="fa fa-pinterest"></i></a>
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>RELATED PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">
				<?php 
				$results->execute();
				while($row = $results->fetch(PDO::FETCH_ASSOC))
				{ $ID = $row['id']; ?>
				<div class="product-item">
					<div class="pi-pic">
					<a href="product.php?id=<?php echo $ID;?>"><img src="./img/<?php echo $row['path'];?>" alt="image"></a>
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
	<!-- RELATED PRODUCTS section end -->


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
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>

	</body>
</html>
