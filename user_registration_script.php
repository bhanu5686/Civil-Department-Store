<?php
    if(isset($_POST["name"],$_POST["email"],$_POST["password"],$_POST["contact"]))
	{
	session_start();
	require 'connection.php';
	$name_id=$_POST["name"];
	$email_id=$_POST["email"];
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email_id)){
        echo "Incorrect email. Redirecting you back to registration page...";
        ?>
        <meta http-equiv="refresh" content="2;url=signup.php" />
        <?php
    }
	$secret= $_POST['password'];
	$password_id = password_hash($secret, PASSWORD_BCRYPT);
    $contact_id=$_POST['contact'];
	$sql = "SELECT id FROM users WHERE email = :email"; 
	$result = $con->prepare($sql); 
	$result->execute(array('email'=>$email_id)); 
	$row_count =$result->rowCount(); 
    if($row_count>0){
        ?>
        <script>
            window.alert("Email already exists in our database!");
        </script>
        <meta http-equiv="refresh" content="1;url=signup.php" />
        <?php
    }else{
		
			$stmt = $con->prepare("INSERT INTO users (name,email,password,contact)
			VALUES (:name, :email,:password, :contact)");
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':contact', $contact);
			$name = $name_id;
			$email = $email_id;
			$password = $password_id;
			$contact = $contact_id;
			$stmt->execute();
			$LAST_ID = $con->lastInsertId();
			echo "User successfully registered";
			$_SESSION['email']=$email_id;
			$_SESSION['id']= $LAST_ID;
        ?>
        <meta http-equiv="refresh" content="3;url=product.php" />
        <?php
    }
    }
	else
	{
		echo "Please fill the correct form...";
	}
?>