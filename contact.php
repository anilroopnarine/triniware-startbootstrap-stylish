<?php require "home.php" ?>
<?php 
	$params = array();
	$response = "";
	if(isset($_POST)) { $params = $_POST; }
	$subject = "Contact Request";
	$body = "Contact Name: {$params['name']} \r\n";
	$body .= "Contact Email: {$params['email']} \r\n";
	$date = date('Y-m-d H:i:s');
	$body .= "When: $date \r\n";
	$body .= "Message: {$params['message']} \r\n";
	$err = '';
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LfXwUIUAAAAAJVyc6YG-44YNXJ6U-qc4qcepGPU',
		'response' => $params["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);

	if($captcha_success->success==true && $params['name'] && $params['email']){
		#myTables::doEmail('triniware@gmail.com', 'Triniware', $subject, $body);
	} else {
		$err = " No Name or Email Received or Captcha Failed. Please Try Again. ";
	}

?>

<!DOCTYPE html>
<html>
  <head>
    <META HTTP-EQUIV=Refresh Content="2;URL=index.html">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Triniware Software Development">
    <meta name="author" content="anilroopnarine">
    <link rel="icon" href="favicon.ico">

    <title>Triniware</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">
  </head>

<BODY>
  <header class="masthead d-flex">

      <div class="container text-center my-auto">
<div class="h2">
<?php if($err){
		print "<p> $err\n";
	} else {
	print "
<p> Email Successfully Submitted. Returning to Home.. \n";
	}
?>
</div>
    </header>


</BODY>
</HTML>


