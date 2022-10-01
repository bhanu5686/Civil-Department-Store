<?php
	session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
		exit();
    }
    $user_id=$_SESSION['id'];
	$user_email=$_SESSION['email'];
	
	$sql = "SELECT it.id,it.name,it.path,it.price FROM users_items ut INNER JOIN items it ON it.id=ut.item_id WHERE ut.user_id = :user_id AND ut.purchase<>'1'"; 
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
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="index.php"><strong>Home</strong></a> /
				<a>Your cart</a>
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
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Remove Product</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$result = $con->prepare("SELECT it.id,it.name,it.path,it.price FROM users_items ut INNER JOIN items it ON it.id=ut.item_id WHERE ut.user_id = :user_id AND ut.purchase<>'1'"); 
								$result->execute(array('user_id'=>$user_id));
								
								while($row = $result->fetch(PDO::FETCH_ASSOC))
								{
							?>
								<tr>
									<td class="product-col">
										<a href="product.php?id=<?php echo $row['id'];?>"><img src="img/<?php echo $row['path'];?>" alt="image"></a>
										<div class="pc-title">
											<h4><?php echo $row['name']?></h4>
											<p>&#x20B9;<?php echo $row['price']?></p>
										</div>
									</td>
									<td class="quy-col">
									<a href='cart_remove.php?id=<?php echo $row['id'] ?>'>Remove</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>&#x20B9;<?php echo $sum; ?></span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
				
				<form class="promo-code-form" method="post" action="pgRedirect.php"> 
										
							<input id="ORDER_ID" type="hidden" tabindex="1" maxlength="20" size="20"
							name="ORDER_ID" autocomplete="off"
							value="<?php echo  "ORD" . time() . $user_id  . mt_rand(100000,999999999)?>">
					
							<input id="CUST_ID" type="hidden" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $user_id; ?>">
							<input id="INDUSTRY_TYPE_ID" type="hidden" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
							<input id="CHANNEL_ID" type="hidden" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
							
						<input title="TXN_AMOUNT" tabindex="10" size="10" type="text" name="TXN_AMOUNT" value="<?php echo $sum; ?>" readonly>
						
						<button>Pay Now</button>
						
						 </form>
					<a href="" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

	<!-- Related product section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Continue Shopping</h2>
			</div>
			<div class="product-slider owl-carousel">
			<?php 
				$results = $con->prepare("SELECT * FROM items");  
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
