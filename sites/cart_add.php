<?php
    require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
	$stmt = $con->prepare("INSERT INTO users_items (user_id,item_id,status)
	VALUES (:user, :item,:status)");
	$stmt->bindParam(':user', $user);
	$stmt->bindParam(':item', $item);
	$stmt->bindParam(':status', $status);
	$user = $user_id;
	$item = $item_id;
	$status = 'Added to cart';
	$stmt->execute();
	if(isset($_GET["search"]))
	{
		header('location: search_result.php?search='.$_GET["search"]);
	}
	else if(isset($_GET["pid"]))
	{
		header('location: product.php?id='. $item_id);
	}
	else if(isset($_GET["cid"]))
	{
		header('location: category.php');
	}
	else
	{
     header('location: index.php');
	}
?>