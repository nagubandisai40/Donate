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
/*$to=$email;
$sub='Payment Success for amount Rs.'.$amount;
$msg='We have recived your payment of Rs.'.$amount."\n".
'Payment Information:'."\n".
'Transaction Id:'.$txnid."\n".
'reference id:'.$key."\n".
'amount:'.$amount."\n".
'email:'.$email."\n".
'In case of any queries please mention the merchant id while contacting the support team.'."\n".
'Thank you';
mail($to,$sub,$msg);*/

 date_default_timezone_set('Asia/Kolkata');

  require('../fpdf181/fpdf.php');
  require ('class.phpmailer.php');
  require('class.smtp.php');
  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B','16');
  $pdf->Cell(150 ,5,'The Spark Foundation',0,0);
  $pdf->cell(59,5,'INVOICE',0,1);
  $pdf->SetFont('Arial','',12);
  $pdf->cell(160,11,'Date:',0,0,'R');
  $pdf->cell(170,11,date("d-M-Y"),0,1);
  $pdf->cell(160,2,'Customer ID:',0,0,'R');
  $pdf->cell(170,2,substr($posted_hash,0,10),0,1);
  $pdf->SetFont('Arial','',14);
  $pdf->cell(150,50,'Payment Information:',0,0);
  $pdf->cell(-117,65,'TransactionId:',0,0,'R');
  $pdf->cell(10,65,$txnid,0,1);
  $pdf->cell(20,-50,'Amount:',0,0);
  $pdf->cell(10,-50,$amount,0,1);
  $pdf->cell(18,65,'E-mail:',0,0);
  $pdf->cell(10,65,$email,0,1);
  $pdf->cell(10,-46,'In case of any queries please mention TransactionId while contacting our Support Team.',0,1);
  $pdf->cell(10,65,'Thank You.',0,0);
  
  $mail = new PHPMailer;
  $mail->Username = "firstwebsitepay@gmail.com";
  $mail->Password = "9849839175";
  $mail->setFrom('firstwebsitepay@gmail.com', 'sparkdonate');
  $mail->addAddress($email,'');     // Add a recipient
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Payment Success for amount Rs.'.$amount;
  $mail->Body = 'Payment Received and the details of your payment can be found in the document provided';
  //$mail->AddStringAttachment($doc, 'Successful Donation', 'base64', 'application/pdf');
$mail->addStringAttachment($pdf->Output("PaymentSuccess.pdf",'S'), 'PaymentSuccess.pdf', $encoding = 'base64', $type = 'application/pdf');
    
    $mail->send();
 
	
	
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
