<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }  
    $old_password= $_POST['oldPassword'];
    $new_password= $_POST['newPassword'];
    $confirm_password= $_POST['retype'];
    $email=$_SESSION['email'];
	$sql = "SELECT password FROM users WHERE email = :email"; 
	$result = $con->prepare($sql); 
	$result->execute(array('email'=>$email)); 
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();
	if (password_verify($old_password, $row['password']) && $new_password==$confirm_password)
	{
		$password = password_hash($new_password, PASSWORD_BCRYPT);
		$stmt = $con->prepare("UPDATE users SET password = :password WHERE email = :email"); 
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':email', $email);
		$password = $password;
		$email = $email;
		$stmt->execute();
        echo "Your password has been updated.";
        ?>
        <meta http-equiv="refresh" content="3;url=index.php" />
        <?php
    }
	else
	{
        ?>
        <script>
            window.alert("password not matched!!");
        </script>
        <meta http-equiv="refresh" content="1;url=settings.php" />
        <?php
    }
?>