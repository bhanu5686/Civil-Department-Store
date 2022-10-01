<?php
    require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
	$sql = "DELETE FROM users_items WHERE user_id = :user_id AND item_id = :item_id AND purchase='0'"; 
	$results = $con->prepare($sql); 
	$results->execute(array('user_id'=>$user_id,'item_id'=>$item_id));  
    header('location: cart.php');
?>