<?php
if(isset($_POST["email"],$_POST["password"]))
{
	session_start();
    require 'connection.php';
	$email_id=$_POST["email"];
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email_id)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
		$password_id = $_POST['password']; 		
		$sql = "SELECT id,email,password FROM users WHERE email = :email"; 
		$result = $con->prepare($sql); 
		$result->execute(array('email'=>$email_id)); 
		$row_count =$result->rowCount(); 
		if($row_count==0)
		{
			?>
			<script>
				window.alert("Email does not exist");
			</script>
			<meta http-equiv="refresh" content="1;url=login.php" />
			<?php
		}
		else
		{
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$row = $result->fetch();
			if (password_verify($password_id, $row['password']))
			{
				$_SESSION['email']=$email_id;
				$_SESSION['id']=$row['id'];  
				header('location: index.php');
			}
			else
			{
				?>
				<script>
					window.alert("Wrong password");
				</script>
				<meta http-equiv="refresh" content="1;url=login.php" />
				<?php
			}
		}
}
else
{
	echo "Please fill the correct form...";
}
 ?>