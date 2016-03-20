<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim(filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
	$artist = trim(filter_input(INPUT_POST,"artist",FILTER_SANITIZE_SPECIAL_CHARS));
	$song = trim(filter_input(INPUT_POST,"song",FILTER_SANITIZE_SPECIAL_CHARS));
  

	if ($name == "" || $email == "" || $artist == "") {
		$error_message = "Please fill in the required fields: Name, Email, and Artist";
	}

	if ($_POST["address"] != "") {
		$error_message = "Bad form input";
	}

  date_default_timezone_set('Etc/UTC');
	require("inc/phpmailer/class.phpmailer.php");
  require("inc/phpmailer/PHPMailerAutoload.php");
  require("inc/phpmailer/class.smtp.php");

	$mail = new PHPMailer;

	if (!$mail->ValidateAddress($email)) {
	$error_message = "Invalid Email Address";
	}
  
  if (!isset($error_message)) {

    $email_body = "";
    $email_body .= "Name " . $name . "\n";
    $email_body .= "Email" . $email . "\n";
    $email_body .= "Artist/Band" . $artist . "\n";
    $email_body .= "Song(s)" . $song . "\n";
    
    
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "jaimelazich@gmail.com";
    //Password to use for SMTP authentication
    $mail->Password = "ilikemusic1";
    
    $mail->setFrom($email, $name);
    $mail->addAddress('jaimelazich@gmail.com', 'Jaime');     // Add a recipient
    
    $mail->isHTML(false);                                  // Set email format to HTML
    
    $mail->Subject = 'QPP Suggestion ' . $name;
    $mail->Body    = $email_body;
  
      if($mail->send()) {
      header("location:suggest.php?status=thanks");
      exit;
      }
      $error_message = 'Message could not be sent.';
      $error_message .= 'Mailer Error: ' . $mail->ErrorInfo;
      

  }
  
}

$pageTitle = "Suggest"; 
$section = "suggest";
?>

    <div class="section catalog random">

			<div class="wrapper">

				<h1><?php echo $pageTitle; ?></h1>
  <?php include("inc/header.php"); ?>
        <div class = "wrapper">
  				<?php if (isset($_GET["status"]) && ($_GET["status"]) == "thanks") {
  					echo "<p>Thank you for your artist / band / song recommendation. People like you keep this project going. Your input is very much appreciated!</p>";
  				} else { 
              if (isset($error_message)) {
              echo $error_message;
            } else {
              echo "<p>Know of a queer artist or band that you don&rsquo;t see already represented on the playlist? <br>
              Lemme know below. <br>
              Thanks!</p>";
            }
          
            ?>
            
  					<form method="post" action="suggest.php">
  						<table>
  							<tr>
  								<th><label for="name">Name (required):</label></th>
  								<td><input type="text" name="name" id="name" /></td>
  							</tr>
  							<tr>
  								<th><label for="email">Email (required):</label></th>
  								<td><input type="text" name="email" id="email" /></td>
  							</tr>
  							<tr>
  								<th><label for="artist">Artist/Band (required):</label></th>
  								<td><input type="text" name="artist" id="artist" /></td>
  							</tr>
  							<tr>
  								<th><label for="song">Song(s)</label></th>
  								<td><input type="text" name="song" id="song" /></td>
  							</tr>
  							<tr style="display:none">
  								<th><label for="address">Address</label></th>
  								<td><input type="text" name="address" id="address" />
  								<p>Please leave this field blank.</p></td>
  							</tr>
  						</table>
  						<input type="submit" value="Submit" />
  					</form>
            <p>
  					<?php } ?> 
  				</div>
    	    </div>

	</div>

	<! -- end content -->
<?php include("inc/footer.php"); ?>