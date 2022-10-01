<?php
		session_start();
        $item=$_GET["search"];
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
		$results = $con->prepare('SELECT * FROM items WHERE name LIKE ? LIMIT 8');
		$results->execute(array('%' . $item . '%'));
		$row_counts = $results->rowCount();            
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




	<!-- Product filter section -->
	<br><br>
	<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>SEARCH RESULTS FOR '<b><?php echo $item; ?></b>'</h2>
			</div>

			<div class="row" id="load_data_table">
			<?php 
			$results->execute();
			while($row = $results->fetch(PDO::FETCH_ASSOC))
					{ $ID = $row['id']; ?>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href="product.php?id=<?php echo $row['id'];?>"><img src="./img/<?php echo $row['path'];?>" alt="image"></a>
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
							<a href="cart_add.php?id=<?php echo $ID;?>&search=<?php echo $item ?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
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
				<?php $video_id = $row["id"]; 
				} ?>
				<div id="remove_row" class="text-center w-100 pt-3">  
                         <button type="button" name="btn_more" data-vid="<?php echo $video_id; ?>" id="btn_more" class="site-btn sb-line sb-dark">LOAD MORE</button> 
             </div> 
			</div>
		</div>
	</section>
	<!-- Product filter section end -->

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
		   var item = "<?php echo $item; ?>";
           $('#btn_more').html("Loading...");  
           $.ajax({  
                url:"fetch2.php",  
                method:"POST",  
                data:{last_video_id:last_video_id , item:item},  
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


	</body>
</html>