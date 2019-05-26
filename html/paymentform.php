<?php
$MERCHANT_KEY = "Lqifgz56";
$SALT = "m9Laeld0Lg";
$amount="1";
$surl="https://localhost/summer/paymentgateway/html/success.php";
$furl="http://pay1rs.000webhostapp.com/failure.php";
// Merchant Key and Salt as provided by Payu.
$PAYU_BASE_URL = "https://sandboxsecure.payu.in";   // For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode
$action = '';
$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {
    $posted[$key] = $value;
  }
}
$formError = 0;
if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
      || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
  $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
  foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<!DOCTYPE html>
<html>
<head>
      <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
    <link rel="shortcut icon" type="image/x-icon" href="sm.ico">
	<link rel="stylesheet" type="text/css" href="../css/paymentstyle.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

<body onload="submitPayuForm()">
<body>
  <div class="wrapper">
    <div class="Payment">
<?php if($formError) { ?>
        <span style="color:red">Please fill all mandatory fields.</span>
<?php } ?>
<form action="<?php echo $action;?>" method="post" name="payuForm" autocomplete="off">
  <div class="inputfields">
  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
  <input name="surl" value="<?php echo $surl ?>"  type="hidden" size="64" />
  <input name="furl" value="<?php echo $furl ?>" size="64" type="hidden" />
  <input name="productinfo" type="hidden" value="<?php echo("Spray")?> "></input>
  <label class="input1" style="text-align: center;font-kerningsize: 20px;"> Payment Details </label>
  <input name="firstname"  class="input" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>"  type="text" placeholder="Name"/>
  <input  name="email" class="input" type="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" placeholder="E-mail" />
  <input name="amount" class="input" value="<?php echo (empty($posted['amount']))? '' : $posted['amount']; ?>" placeholder="Amount"/>
  <input name="phone" class="input" type="tel" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" placeholder="Mobile No" />
   <?php if(!$hash) { ?>
          </div class="btn">
      <center>
        <b>  <input type="submit" name="submit" value="submit" class="btn" style="font-size: 20px"></b>
        </center>
      </div>
      <?php } ?>
    </div>
</form>
</div>
</div>
</body>
</html>
