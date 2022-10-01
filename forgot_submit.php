<?php
if(isset($_POST["email"]))
{
    session_start();
	require 'connection.php';
	$email_id=$_POST["email"];
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email_id)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=forgot.php" />
        <?php
    }
	
	$sql = "SELECT id,email,password FROM users WHERE email = :email"; 
	$result = $con->prepare($sql); 
	$result->execute(array('email'=>$email_id)); 
	$row_count =$result->rowCount();
    if($row_count==0){
        ?>
        <script>
            window.alert("Email does not exist");
        </script>
        <meta http-equiv="refresh" content="1;url=forgot.php" />
        <?php
    }
	else
	{  
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();
	$token = "TOK" . mt_rand(10000,99999999);	
	
	$stmt = $con->prepare("INSERT INTO reset (email,tokenid)
	VALUES (:email,:tokenid)");
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':tokenid', $tokenid);
	$email = $email_id;
	$tokenid = $token;
	$stmt->execute();
	
    $link="<a href='http://localhost/divisima/reset.php?key=".$email_id."&reset=".$token."'>Click To Reset password</a>";
    require_once('phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;  
    $mail->Username = "cdepartment56@gmail.com";
    $mail->Password = "Hum@5686992";
    $mail->SMTPSecure = "ssl";  
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "465";
    $mail->SetFrom="cdepartment56@gmail.com";
    $mail->FromName='bb';
    $mail->AddAddress($email);
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = "open this link to reset your password ".$link."";
    if($mail->Send())
    {
      echo "Check Your Email for password ...redirecting to login page......";
    }
    else
    {
		echo "<center></h1>Check Your Internet Connection...</h1></center>";
      //echo "Mail Error - >".$mail->ErrorInfo;
    }	
	}
		?>
        <meta http-equiv="refresh" content="5;url=login.php" />
        <?php
}
else
{
	echo "Please fill the correct form...";
}
 ?>