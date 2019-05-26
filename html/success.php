<?php
$firstname="sai";
// Salt should be same Post Request
if(
    empty($_POST["status"])||
    empty($_POST["firstname"])||
    empty($_POST["amount"])||
    empty($_POST["txnid"])||
    empty($_POST["hash"])||
    empty($_POST["key"])||
    empty($_POST["productinfo"])||
    empty($_POST["email"])

){
  ?>
  <html>
  <head>
      <title>Payment</title>
      <link rel="stylesheet" type="text/css" href="css/sucessstyles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2;url=../index.php">
  </head>
  <body>
  <div class="bg-image"></div>
  <div class="bg-text">
    <h4>You are being redirected.....</h4>
  </div>
  </body>
  </html>
<?php
}
else{
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="";
// Salt should be same Post Request
$to=$email;
$sub='Payment Success for amount Rs.'.$amount;
$msg='We have recived your payment of Rs.'.$amount."\n".
'Payment Information:'."\n".
'Transaction Id:'.$txnid."\n".
'reference id:'.$key."\n".
'amount:'.$amount."\n".
'email:'.$email."\n".
'In case of any queries please mention the merchant id while contacting the support team.'."\n".
'Thank you';
mail($to,$sub,$msg);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../css/success1.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="wrapper">
      <div class="Payment">
          <div class="card">
            <div class="innercard">
              <div class="nav">
                <div class="imag">
                    <img src="../images/check-512.png" alt="">
                </div>
                <div class="text">
                <h5>Success</h5>
                </div>
              </div>
            </div>
            <div class="body">
                <div class="left">
                    <div class="left-info">
                      <ul>
                        <li>Name</li>
                        <li>Amount</li>
                        <li  style="font-size:1.9vw">Transaction-id</li>
                        <li  style="font-size:1.7vw">Email</li>
                      </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="right-info">
                      <ul>
                        <li><?php echo $firstname;?></li>
                        <li><?php echo $amount;?></li>
                        <li style="font-size:1.9vw"><?php echo $txnid;?></li>
                        <li style="font-size:1.7vw"><?php echo $email;?></li>
                      </ul>
                    </div>
                </div>
            </div>
            <div class="button">
              <a href="../index.php" style="text-decoration:none;color:#000"><center><h5>Ok</h5></center></a>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>





















<?php


/*If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
		echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";

		   } else {
			echo "Invalid Transaction. Please try again";
    }*/
  }
?>
