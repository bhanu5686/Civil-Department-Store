<?php
    
    function check_if_puchased_item($item_id){   
        require 'connection.php';
        $user_id=$_SESSION['id'];
		$sqlls = "SELECT * FROM users_items WHERE item_id = :item_id AND user_id = :user_id AND purchase='0'"; 
		$resullts = $con->prepare($sqlls); 
		$resullts->execute(array('item_id'=>$item_id,'user_id'=>$user_id)); 
		$row_countts =$resullts->rowCount(); 
        if($row_countts>=1)return 1;
        return 0;
    }
?>