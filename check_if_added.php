<?php
    
    function check_if_added_to_cart($item_id){  
        require 'connection.php';
        $user_id=$_SESSION['id'];
		$sqls = "SELECT * FROM users_items WHERE item_id = :item_id AND user_id = :user_id AND status='Added to cart'"; 
		$results = $con->prepare($sqls); 
		$results->execute(array('item_id'=>$item_id,'user_id'=>$user_id)); 
		$row_counts =$results->rowCount(); 
        if($row_counts>=1)return 1;
        return 0;
    }
?>