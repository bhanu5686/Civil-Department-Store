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
		$sqls = "SELECT * FROM items LIMIT 9"; 
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
			<h4>CAtegory PAge</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="#">Shop</a> /
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>

					</div>
					<div class="filter-widget mb-0">
						<h2 class="fw-title">refine by</h2>
						<div class="price-range-wrap">
							<h4>Price</h4>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="5" data-max="60">
								<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;">
								</span>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;">
								</span>
							</div>
							<div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
					</div>

				</div>

			<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
				<?php 
					$results->execute();
					?>
				<div class="row" id="load_data_table">
					<?php
			while($row = $results->fetch(PDO::FETCH_ASSOC))
			{ $ID = $row['id']; ?>
				<div class="col-lg-4 col-sm-6" id="tabledata">
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
							<a href="cart_add.php?id=<?php echo $ID;?>&cid=<?php echo mt_rand(100,999)?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
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
			</div>
		</div>
	</section>
	<!-- Category section end -->
	
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
	var rangeSlider = $(".price-range"),
		minamount = $("#minamount"),
		maxamount = $("#maxamount"),
		minPrice = rangeSlider.data('min'),
		maxPrice = rangeSlider.data('max');
		minPrice1 = rangeSlider.data('min'),
		maxPrice1 = rangeSlider.data('max');
		$(document).ready(function(){
	rangeSlider.slider({
		range: true,
		min: minPrice,
		max: maxPrice,
		values: [minPrice, maxPrice],
		slide: function (event, ui) {
			minPrice1 = ui.values[0];
			maxPrice1 = ui.values[1];
			
			 $.ajax({
                        url: 'fetch4.php',
                        type: 'post',
                        data: {min:minPrice1,max:maxPrice1},
                        success: function(response){
							$('#load_data_table #tabledata,#remove_row,h4').remove();
                            $('#load_data_table').append(response);    
                        }      
                    });
					minamount.val(ui.values[0]);
			maxamount.val(ui.values[1]);
		}
	});
	      $(document).on('click', '#btn_more', function(){  
           var last_video_id = $(this).data("vid");  
           $('#btn_more').html("Loading...");  
           $.ajax({  
                url:"fetch4.php",  
                method:"POST",  
                data:{last_video_id:last_video_id,min:minPrice1,max:maxPrice1},  
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
	minamount.val(rangeSlider.slider("values", 0));
	maxamount.val(rangeSlider.slider("values", 1));
 }); 
 
  $(document).ready(function(){  
 
 });  
 
</script>


	</body>
</html>
