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
$output = '';  
$video_id = '';    
sleep(1);   
require 'connection.php';
$var = $_POST['item'];
$item = $_POST['last_video_id'];
$results = $con->prepare('SELECT * FROM items WHERE name LIKE :term AND id > :item_id LIMIT 8');
$results->execute(array('term'=>"%$var%",'item_id'=>$item));
$row_counts = $results->rowCount();

if($row_counts > 0)  
{  
     while($row = $results->fetch(PDO::FETCH_ASSOC))  
     {  
          $video_id = $row["id"];  
		  
		  if(!isset($_SESSION['email']))
		  {
			 $output .= ' <div class="col-lg-3 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">	
									<a href="product.php?id='. $row['id'] .'"><img src="img/'. $row['path'] .'" alt="image"></a>	
									<div class="pi-links">
									<a href="login.php" class="add-card"><i class="flaticon-bag"></i><span>Buy Now</span></a>
									<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
									</div>
							<div class="pi-text">
							<h6>&#x20B9;'. $row['price'] .'</h6>
							<a href="product.php?id='. $row['id'] .'"><p>'. $row['name'] .'</p></a>
						</div>
					</div>
				</div> ';
		  }
		  else
		  {
			 if(check_if_puchased_item($row['id']))
			 {
				$output .= '<div class="col-lg-3 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">	
									<a href="product.php?id='. $row['id'] .'"><img src="img/'. $row['path'] .'" alt="image"></a>	
									<div class="tag-sale">Purchased</div>
									</div>
						<div class="pi-text">
							<h6>&#x20B9;'. $row['price'] .'</h6>
							<a href="product.php?id='. $row['id'] .'"><p>'. $row['name'] .'</p></a>
						</div>
					</div>
				</div>';
			 }
			 else
			 {
				if(check_if_added_to_cart($row['id']))
				{
					$output .= '<div class="col-lg-3 col-sm-6"> 
								<div class="product-item">
								<div class="pi-pic">	
									<a href="product.php?id='. $row['id'] .'"><img src="img/'. $row['path'] .'" alt="image"></a>	
									<div class="tag-sale">Added to cart</div>
									</div>
							<div class="pi-text">
							<h6>&#x20B9;'. $row['price'] .'</h6>
							<a href="product.php?id='. $row['id'] .'>"><p>'. $row['name'] .'</p></a>
						</div>
					</div>
				</div>'; 
				}
				else
				{
					$output .= '<div class="col-lg-3 col-sm-6">
								<div class="product-item">
								<div class="pi-pic">	
									<a href="product.php?id='. $row['id'] .'"><img src="img/'. $row['path'] .'" alt="image"></a>	
									<div class="pi-links">
							<a href="cart_add.php?id='. $row['id'] .'&search='. $var .'" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
							</div>
						<div class="pi-text">
							<h6>&#x20B9;'. $row['price'] .'</h6>
							<a href="product.php?id='. $row['id'] .'"><p>'. $row['name'] .'</p></a>
						</div>
					</div>
				</div>'; 
				}
				 
			 }

		  }
  
     }  
          $output .= '<div id="remove_row" class="text-center w-100 pt-3">  
                    <button type="button" name="btn_more" data-vid="'. $video_id .'" id="btn_more" class="site-btn sb-line sb-dark">LOAD MORE</button> 
               </div>';  
     echo $output;
}  
?>