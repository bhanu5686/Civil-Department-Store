<?php
session_cache_limiter('private_no_expire:');
session_start();
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
require 'connection.php';
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; 

$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


	if($isValidChecksum == "TRUE") 
	{
		if ($_POST["STATUS"] == "TXN_SUCCESS")
		{
			echo "<center><h1>Transaction is <strong>successful</strong></h1></center>";
			echo "<center><h3>redirecting back to the site.....</h3></center>";
		}
		else 
		{
			echo "<center><h1>Transaction is <strong>failed !</strong></h1></center>";
			echo "<center><h3>redirecting back to the site.....</h3></center>";
		}

		if (isset($_POST) && count($_POST)>0 )
		{ 
		
			if ($_POST["STATUS"] == "TXN_FAILURE")
			{
				date_default_timezone_set("Asia/Calcutta");
				$_POST['PAYMENTMODE']=NULL;
				$_POST['TXNDATE']=date('Y-m-d H:i:s');
				$_POST['GATEWAYNAME']=NULL;
				$_POST['BANKNAME']=NULL;
			}
			
			$stmt = $con->prepare("INSERT INTO transaction (ORDERID,MID,TXNID,TXNAMOUNT,PAYMENTMODE,CURRENCY,TXNDATE,STATUS,RESPCODE,RESPMSG,GATEWAYNAME,BANKTXNID,BANKNAME,CHECKSUMHASH)
			VALUES (:ORDERID,:MID,:TXNID,:TXNAMOUNT,:PAYMENTMODE,:CURRENCY,:TXNDATE,:STATUS,:RESPCODE,:RESPMSG,:GATEWAYNAME,:BANKTXNID,:BANKNAME,:CHECKSUMHASH)");
			$stmt->bindParam(':ORDERID', $orderid);
			$stmt->bindParam(':MID', $mid);
			$stmt->bindParam(':TXNID', $txnid);
			$stmt->bindParam(':TXNAMOUNT', $txnamount);
			$stmt->bindParam(':PAYMENTMODE', $payment);
			$stmt->bindParam(':CURRENCY', $currency);
			$stmt->bindParam(':TXNDATE', $txndate);
			$stmt->bindParam(':STATUS', $status);
			$stmt->bindParam(':RESPCODE', $respcode);
			$stmt->bindParam(':RESPMSG', $respmsg);
			$stmt->bindParam(':GATEWAYNAME', $gateway);
			$stmt->bindParam(':BANKTXNID', $banktxn);
			$stmt->bindParam(':BANKNAME', $bankname);
			$stmt->bindParam(':CHECKSUMHASH', $checksum);
			$orderid = $_POST['ORDERID'];
			$mid = $_POST['MID'];
			$txnid = $_POST['TXNID'];
			$txnamount = $_POST['TXNAMOUNT'];
			$payment = $_POST['PAYMENTMODE'];
			$currency = $_POST['CURRENCY'];
			$txndate = $_POST['TXNDATE'];
			$status = $_POST['STATUS'];
			$respcode = $_POST['RESPCODE'];
			$respmsg = $_POST['RESPMSG'];
			$gateway = $_POST['GATEWAYNAME'];
			$banktxn = $_POST['BANKTXNID'];
			$bankname = $_POST['BANKNAME'];
			$checksum = $_POST['CHECKSUMHASH'];
			$stmt->execute();
			$status= $_POST["STATUS"];
			$token= $_POST["ORDERID"];
			$sqll = "SELECT userid FROM user_order WHERE orderid = :orderid"; 
			$results = $con->prepare($sqll); 
			$results->execute(array('orderid'=>$token)); 
			$row_count =$results->rowCount(); 
			$results->setFetchMode(PDO::FETCH_ASSOC);
			$row = $results->fetch();
			$userid=$row['userid'];
			if($status=="TXN_FAILURE")
			{	
				$stmts = $con->prepare("UPDATE user_order SET valid=1 WHERE orderid = :orderid AND userid = :userid");	
				$stmts->bindParam(':orderid', $orderid);
				$stmts->bindParam(':userid', $userid);
				$orderid = $token;
				$userid = $userid;
				$stmts->execute();
				?>
				<meta http-equiv="refresh" content="3;url=cart.php" />
				<?php
			}
			else
			{
				if($row_count>0)
				{
					?>
					<meta http-equiv="refresh" content="3;url=success.php?id=<?php echo $userid?>&orderid=<?php echo $token?>" />
					<?php   
				} 
			}	
		}
	}
	else
	{
		echo "<center><h1>Checksum mismatched...</h1></center>";
		?>
        <meta http-equiv="refresh" content="3;url=cart.php" />
        <?php
	}
?>
