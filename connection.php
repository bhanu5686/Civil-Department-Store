<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $con = new PDO("mysql:host=$servername;dbname=store", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
if (isset($_SESSION['email'])) {
if (isset($_SESSION['last_active'])) {
    $max_time=15*60; 
    $now=microtime(date("H:i:s"));
    $diff=round(microtime(date("H:i:s"))- $_SESSION['last_active']); 
    if ($diff>=$max_time) { 
        header("location:logout.php");          
    }else {
        $time=microtime(date("H:i:s"));
    $_SESSION['last_active']=$time; 
    }
}else{
    $time=microtime(date("H:i:s"));
    $_SESSION['last_active']=$time;
}}
?>