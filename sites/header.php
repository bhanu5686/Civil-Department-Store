<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.php" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
					
					<link rel="stylesheet" href="css/style1.css" type="text/css">
					<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
	$(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
		document.f2.submit();
    });
	
	$('.search-box input[type="text"]').click(function(e){
		$(".result").show();
		e.stopPropagation();
	});

	$(document).click(function(){
    $(".result").hide();
	});
	
});
</script>
					
					
					
					<div class="search-box">
						<form class="header-search-form" method="get" action="search_result.php" name="f2">
							<input type="text" name="search" autocomplete="off" placeholder="Search our products ...." required>
							<button type="submit"><i class="flaticon-search"></i></button>
							<div class="result"></div>
						</form>
					</div>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
						<a href="cart.php">
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>
									<?php
									    if(!isset($_SESSION['email'])){
											echo '0';
										}
										else{
									 $user_id=$_SESSION['id'];
									$user_email=$_SESSION['email'];
	
	$sql = "SELECT it.id,it.name,it.price FROM users_items ut INNER JOIN items it ON it.id=ut.item_id WHERE ut.user_id = :user_id AND ut.purchase<>'1'"; 
	$result = $con->prepare($sql); 
	$result->execute(array('user_id'=>$user_id)); 
	$row_count =$result->rowCount();
	echo $row_count;
	}
	?> </span>
								</div>
								Cart
							</div></a>
						 <?php
                           if(isset($_SESSION['email'])){
                           ?>
						   <a href="purchased.php">
						   <div class="up-item">
								<i class="flaticon-profile"></i>My Items
							</div></a>
							<a href="settings.php">
							<div class="up-item">
								<i class="flaticon-profile"></i>Setting
							</div></a>
							<a href="logout.php">
							<div class="up-item">
								<i class="flaticon-logout"></i>Logout
							</div></a>
							<?php
                           }else{
                            ?>
							<a href="login.php">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								Sign In
							</div></a>
							<a href="signup.php">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								Create Account
							</div></a>
							<?php
                           }
                           ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="category.php">Browse</a></li>
					<li><a href="edit.php">Request-PDF</a></li>
					<li><a href="edit.php">New Arrivals
						<span class="new">New</span>
					</a></li>
					<li><a href="edit.php">Bestsellers</a>
					</li>
					<li><a href="edit.php">Blog</a></li>
				</ul>
			</div>
		</nav>
	</header>