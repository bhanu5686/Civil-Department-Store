<?php
    require 'connection.php';
	   if(!isset($_POST['email_id'])){
        exit("<center><h1>page not exists...</h1></center>");
    }
	$email=$_POST["email_id"];
	$token=$_POST["token_id"];
	
	$sql = "SELECT valid FROM reset WHERE email = :email AND tokenid = :tokenid"; 
	$result = $con->prepare($sql); 
	$result->execute(array('email'=>$email,'tokenid'=>$token)); 
	$row_count =$result->rowCount(); 
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();
	if($row_count==0 || $row['valid']==1)
	{
		header("Location: notExist.php");
	}
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=forgot.php" />
        <?php
    }	
    $new_password= $_POST['newPassword'];
    $confirm_password= $_POST['retype'];

	if ($new_password==$confirm_password)
	{
		$stmt = $con->prepare("UPDATE reset SET valid=1 WHERE email = :email AND tokenid = :tokenid"); 
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':tokenid', $tokenid);
		$email = $email;
		$tokenid = $token;
		$stmt->execute();	
		
		$password = password_hash($new_password, PASSWORD_BCRYPT);
		
		$stmts = $con->prepare("UPDATE users SET password = :password WHERE email = :email"); 
		$stmts->bindParam(':password', $pass);
		$stmts->bindParam(':email', $email);
		$pass = $password;
		$email = $email;
		$stmts->execute();
        echo "Your password has been updated.";
        ?>
        <meta http-equiv="refresh" content="3;url=login.php" />
        <?php
    }
	else
	{
        ?>
        <script>
            window.alert("password not matched!!");
        </script>
        <meta http-equiv="refresh" content="1;url=reset.php?key=<?php echo $email?>&reset=<?php echo $token?>" />
        <?php
    } 
?>