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
		$results->execute(); 
		$row_counts =$results->rowCount(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>CIVIL Worlds Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <div class="container">
                <div class="jumbotron">
                    <h1>Welcome to Civil Department Store!</h1>
                    <p>We have the best cameras, watches and shirts for you. No need to hunt around, we have all in one place.</p>
                </div>
            </div>
            <div class="container">
                <div class="row">
				<?php while($row = $results->fetch(PDO::FETCH_ASSOC))
					{ ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                                <img src="img/<?php echo $row['path'];?>" alt="image">
                            <center>
                                <div class="caption">
                                    <h3><?php echo $row['name'];?></h3>
                                    <p>Price: Rs. 36000.00</p>
                                    <?php if(!isset($_SESSION['email'])){  ?>
                                        <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        <?php
                                        }
                                        else
										{
											$ID = $row['id'];
											if(check_if_puchased_item($ID))
												echo '<a href="#" class=btn btn-block btn-success disabled>purchased</a>';
											else
											{	
												if(check_if_added_to_cart($ID))
													echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
												else
												{
                                                ?>
                                                <a href="cart_add.php?id=<?php echo $ID;?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                <?php
												}
											}
										}
                                        ?>
                                    
                                </div>
                            </center>
                        </div>
                    </div>
					<?php } ?>
                </div>				
            </div>
            <br><br><br><br><br><br><br><br>
           <footer class="footer">
               <div class="container">
                <center>
                   <p>Copyright &copy <a href="#">CIVIL ENGINEERING DEPARTMENT</a> Store. All Rights Reserved.</p>
                   <p>This website is developed by CodeNation</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
